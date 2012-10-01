<?
session_start();
require "inc/settings.php";
require "$base/inc/twitter-async/EpiCurl.php";
require "$base/inc/twitter-async/EpiOAuth.php";
require "$base/inc/twitter-async/EpiTwitter.php";
require "$base/inc/userfunctions.php";

function twitter()
 {
 global $sql,$twitter;
 if(!isset($_GET['oauth_token']) && !isset($_GET['oauth_verifier']))
  {
  $t = new EpiTwitter($twitter['consumerKey'], $twitter['consumerSecret']);
  header("Location: ".$t->getAuthenticateUrl());
  }
 else
  {
  $t = new EpiTwitter($twitter['consumerKey'], $twitter['consumerSecret']);
  $t->setToken($_GET['oauth_token']);  
  $token = $t->getAccessToken();
  $t->setToken($token->oauth_token, $token->oauth_token_secret);
  $creds = $t->get('/account/verify_credentials.json');
  $_SESSION['twitter_oauth_token'] = $token->oauth_token;
  $_SESSION['twitter_oauth_token_secret'] = $token->oauth_token_secret;
  $_SESSION['signedinwith'] = "twitter";
  $_SESSION['twitter_name'] = $creds['screen_name'];
  $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
  $query = $db->prepare("SELECT * FROM `".$sql['db']."`.`users` WHERE `twitter` = ?");
  $query->bind_param("s",$creds['screen_name']);
  $query->execute();
  $out = array("id"=>null,"username"=>null,"fullname"=>null,"firstname"=>null,"gender"=>null,"email"=>null,"created"=>null,"profilepic"=>null,"twitter"=>null,"facebook"=>null,"googleplus"=>null,"kloutid"=>null);
  $query->bind_result($out['id'],$out['username'],$pass, $out['fullname'],$out['gender'],$out['email'],$out['created'],$out['profilepic'],$out['twitter'],$out['facebook'],$out['googleplus'],$out['kloutid']);
  if($query->fetch())
   {
   $_SESSION['user'] = $out['username'];
   header("Location: /user/".$_SESSION['user']);
   } else {
    require "inc/finishsignup.php";
   }
  $query->close();
  $db->close();
  }
 }

function facebook()
 {
 global $sql,$facebook;
 if(!isset($_GET['state'])) {
  $uniq = md5(uniqid(rand(), TRUE));;
  $_SESSION['fb_uniq'] = $uniq;
  header("Location: https://www.facebook.com/dialog/oauth?client_id=".$facebook['appid']."&redirect_uri=".$facebook['redirect_url']."&scope=user_about_me,email&state=$uniq");
 } else {
  if(isset($_GET['error_reason'])) {header("Location: /signin");}
  elseif($_GET['state'] == $_SESSION['fb_uniq']) {
   $tokenz = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=".$facebook['appid']."&redirect_uri=".$facebook['redirect_url']."&client_secret=".$facebook['secret']."&code=".$_GET['code']);
   $_SESSION['facebook_token'] = $tokenz;
   $_SESSION['signedinwith'] = "facebook";
   $fbuser = json_decode(file_get_contents("https://graph.facebook.com/me?".$_SESSION['facebook_token']));
   $_SESSION['facebook_id'] = $fbuser->id;
   $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
   $query = $db->prepare("SELECT * FROM `".$sql['db']."`.`users` WHERE `facebook` = ?");
   $query->bind_param("s",$fbuser->id);
   $query->execute();
   $out = array("id"=>null,"username"=>null,"fullname"=>null,"firstname"=>null,"gender"=>null,"email"=>null,"created"=>null,"profilepic"=>null,"twitter"=>null,"facebook"=>null,"googleplus"=>null,"kloutid"=>null);
   $query->bind_result($out['id'],$out['username'],$pass, $out['fullname'],$out['gender'],$out['email'],$out['created'],$out['profilepic'],$out['twitter'],$out['facebook'],$out['googleplus'],$out['kloutid']);
   if($query->fetch())
    {
    $_SESSION['user'] = $out['username'];
    header("Location: /user/".$_SESSION['user']);
    } else {
     require "inc/finishsignup.php";
    }
   $query->close();
   $db->close();
  } else { header("/signin"); }
 }
}

 if(!isset($_SERVER['PATH_INFO'])) {header("Location: /signin");}
 elseif($_SERVER['PATH_INFO'] == "/" || $_SERVER['PATH_INFO'] == "") {header("Location: /signin");}
 else
  {
  $path = explode("/",$_SERVER['PATH_INFO']);
  if($path[1] == "twitter") {twitter();}
  elseif($path[1] == "facebook") {facebook();}
  elseif($path[1] == "google") {google();}
  elseif($path[1] == "netid") {netid();}
  else {header("Location: /signin");}
  }
?>
