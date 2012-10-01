<?
require_once "settings.php";
function isuser($username) {
  global $sql,$school,$base,$static,$twitter,$recaptcha;
  $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
  $check = $db->prepare("SELECT * FROM `".$sql['db']."`.`users` WHERE `username` = ?");
  $check->bind_param("s",$username);
  $check->execute();
  $out = $check->fetch();
  $check->close();
  $db->close();
  return $out;
 }

function profile($user) {
  global $sql,$school,$base,$static,$twitter,$recaptcha,$profile;
  if(!isset($profile[$user]))
   {
   $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
   $check;
   if(gettype($user) == "string")
    {
    $check = $db->prepare("SELECT * FROM `".$sql['db']."`.`users` WHERE `username` = ?");
    $check->bind_param("s",$user);
    }
   elseif(gettype($user) == "integer")
    {
    $check = $db->prepare("SELECT * FROM `".$sql['db']."`.`users` WHERE `id` = ?");
    $check->bind_param("i",$user);
    }
   else {die("Please input $user as a string or an int, not a ".gettype($user));}
   $check->execute();
   $pass = null;
   $out = array("id"=>null,"username"=>null,"fullname"=>null,"firstname"=>null,"gender"=>null,"email"=>null,"created"=>null,"profilepic"=>null,"twitter"=>null,"facebook"=>null,"googleplus"=>null,"kloutid"=>null,"about"=>null,"contact"=>null,"favorite-profs"=>null,"favorite-foods"=>null,"favorite-music"=>null,"howiseeit"=>null);
   $check->bind_result($out['id'],$out['username'],$pass, $out['fullname'],$out['gender'],$out['email'],$out['created'],$out['profilepic'],$out['twitter'],$out['facebook'],$out['googleplus'],$out['kloutid'],$out['about'],$out['contact'],$out['favorite-profs'],$out['favorite-foods'],$out['favorite-music'],$out['howiseeit']);
   $check->fetch();
   $check->close();
   $db->close();
   $tmp = explode(" ",$out['fullname']);
   $out['firstname'] = $tmp[0];
   $profile[$user] = $out;
  }
  return $profile[$user];
 }

function postsfrom($user,$startat=0, $endat=10) {
  global $sqluser,$sqlpass,$sqldb,$sqlhost,$school,$base,$static,$twitter,$recaptcha;
  $db = new mysqli($sqlhost, $sqluser, $sqlpass, $sqldb);
  $sql = "SELECT * FROM `$sqldb`.`posts` WHERE `user` = ".$user['id']." ORDER BY `time` DESC LIMIT ".$startat.",".$endat;
  if(!$query = $db->query($sql)) {
        die("Error: ". $db->error);
    }
//  $res = $query->get_results();
  $out = array();
  while($row = $query->fetch_array(MYSQLI_ASSOC)) {
   $out[] = $row;
  }
  $query->close();
  $db->close();
  return $out;
}


function posts() {
  global $sqluser,$sqlpass,$sqldb,$sqlhost,$school,$base,$static,$twitter,$recaptcha;
  $db = new mysqli($sqlhost, $sqluser, $sqlpass, $sqldb);
  $sql = "SELECT * FROM `$sqldb`.`posts` ORDER BY `time` DESC";
  if(!$query = $db->query($sql)) {
        die("Error: ". $db->error);
    }
  $out = array();
  while($row = $query->fetch_array(MYSQLI_ASSOC)) {
   $out[] = $row;
  }
  $query->close();
  $db->close();
  return $out;
 }


function someposts($startat=0, $endat=10) {
  global $sqluser,$sqlpass,$sqldb,$sqlhost,$school,$base,$static,$twitter,$recaptcha;
  $db = new mysqli($sqlhost, $sqluser, $sqlpass, $sqldb);
  $sql = "SELECT * FROM `$sqldb`.`posts` ORDER BY `time` DESC LIMIT ".$startat.",".$endat;
  if(!$query = $db->query($sql)) {
        die("Error: ". $db->error);
    }
  $out = array();
  while($row = $query->fetch_array(MYSQLI_ASSOC)) {
   $out[] = $row;
  }
  $query->close();
  $db->close();
  return $out;
 }

function updateprofile($aspect, $value, $user=null)
 {
 global $sqluser,$sqlpass,$sqldb,$sqlhost,$school,$base,$static,$twitter,$recaptcha;
 if($user == null) {$user = $_SESSION['user'];}
 $db = new mysqli($sqlhost, $sqluser, $sqlpass, $sqldb);
 $stmt = $db->prepare("UPDATE `$sqldb`.`users` SET `$aspect` = ? WHERE `username` = ?");
 $stmt->bind_param("ss",$value,$user);
 $stmt->execute();
 $stmt->close();
 $db->close();
 }

function linkify($in,$source="amplify")
 {
 global $profile;
 $linkified = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\" rel=\"nofollow\">\\0</a>", $in);# http://www.liamdelahunty.com/tips/php_convert_url_to_link.php
 // Really ought to use https://github.com/iamcal/lib_autolink

 // Search for @tags and replace with Amplify names and links
 $words = explode(" ", $linkified);
 $out = array();
 foreach($words as $word)
  {
  if(strlen($word) > 1)
   {
   if($word[0] == "@")
    {
    $user = substr($word, 1);
    if(isuser($user))
     {
     profile($user);
     $name = $profile[$user]['fullname'];
     if($profile[$user]['firstname'] != "") {$name = $profile[$user]['firstname'];}
     $out[] = "<a href=\"/user/$user\">$name</a>";
     }
    elseif($source == "twitter")
     {$out[] = "<a href=\"https://www.twitter.com/".substr($word,1)."\" target=\"_BLANK\">$word</a>";}
   else
     {$out[] = $word;}
    }
   elseif($word[0] == "#")
    {$out[] = "<a href=\"/search/".substr($word, 1)."\">$word</a>";}
   else
    {$out[] = $word;}
   }
  else
   {$out[] = $word;}
  }
 return implode($out," ");
 }

function getKloutScore($user)
 {
 global $sql,$profile,$kloutkey;
 profile($user);
 $out = "N/A";
 if($profile[$user]['kloutid'] != 0)
  {
  $fetch = json_decode(file_get_contents("http://api.klout.com/v2/user.json/".$profile[$user]['kloutid']."/score?key=".$kloutkey));
  $out = $fetch->score;
  }
 elseif($profile[$user]['twitter'] != "")
  {
  $lookup = json_decode(file_get_contents("http://api.klout.com/v2/identity.json/twitter?screenName=".$profile[$user]['twitter']."&key=".$kloutkey));
  $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
  if($db->connect_errno) {
    die("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
   }
  if(!$db->query("UPDATE `".$sql['db']."`.`users` SET `kloutid` = \"".$lookup->id."\" WHERE `id` = ".$profile[$user]['id']))
   {die($db->error);}
  $db->close();
  $out = getKloutScore($user);
  }
 return $out;
 }
