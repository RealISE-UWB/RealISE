<?
require_once("settings.php");
require_once("$base/inc/userfunctions.php");
function savepics()
 {
 global $sql,$base,$profile;
 $out = array();
 if(!isset($_SESSION['user']))
  {die("You must be logged in to upload photos.");}
 else
  {
  if(!is_dir("$base/userdata/".$profile[$_SESSION['user']]['id']."/"))
   {
   mkdir("$base/userdata/".$profile[$_SESSION['user']]['id']."/");
   }
  if(!is_dir("$base/userdata/".$profile[$_SESSION['user']]['id']."/photos/"))
   {mkdir("$base/userdata/".$profile[$_SESSION['user']]['id']."/photos");}
  $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
  if(is_array($_FILES["pictures"]["error"]))
   {
   if($_FILES["pictures"]["error"] == UPLOAD_ERR_OK)
    {$out[] = copyandsave($_FILES["pictures"],$db);}
   else
    {  // Multiple files uploaded
    foreach($_FILES["pictures"]["tmp_name"] as $key => $value)
     {
     $file = array("tmp_name"=>$_FILES["pictures"]["tmp_name"][$key],"type"=>$_FILES["pictures"]["type"][$key]);
     $out[] = copyandsave($file,$db);
     }
    }
  $db->close();
  }
  return $out;
  }
 }

function copyandsave($file,$db)
 {
 error_log("Saving $file...",3,"/tmp/php.error.log");
 global $sql,$base,$profile;
 list($type,$extension) = explode("/",$file['type']);
 if($type == "image")
  {
  $filename = microtime().".".$extension;
  $filepath = "/userdata/".$profile[$_SESSION['user']]['id']."/photos/".$filename;
  move_uploaded_file($file["tmp_name"],"$base".$filepath);
  $out['size'] = getimagesize("$base/".$filepath);
  $user = profile($_SESSION['user']);
  if(!$db->query("INSERT INTO `".$sql['db']."`.`pictures`(`filename`,`uploader`) VALUES (\"$filename\",".$user['id'].")")){die($db->errno . " - " . $db->error);}
  if(!$result = $db->query("SELECT * FROM `".$sql['db']."`.`pictures` WHERE `filename` = \"$filename\";")){die($db->errno . " - " . $db->error);}
  $out = $result->fetch_assoc();
  $out['url'] = $filepath;
  }
 return $out;
 }

function picsfromuser($user,$limit=0)
 {
 global $sql,$profile;
 $query = "SELECT * FROM `".$sql['db']."`.`pictures` ORDER BY  `pictures`.`uploaded` DESC";
 if($user != null)
  {
  $userid = $user;
  if(gettype($user) == "string")
   {
   profile($user);
   $userid = $profile[$user]['id'];
   }
  $query = "SELECT * FROM `".$sql['db']."`.`pictures` WHERE `uploader` = $userid ORDER BY  `pictures`.`uploaded` DESC";
 }
 $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
 if(!$result = $db->query($query)) {die($db->errno . " - " . $db->error);}
 $out = array();
 while($row = $result->fetch_assoc()) {$out[] = $row;}
 $db->close();
 return $out;
 }
 
function pic($id)
 {
 global $sql,$profile;
 $query = "SELECT * FROM `".$sql['db']."`.`pictures` WHERE `id` = $id";
 $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
 if(!$result = $db->query($query)) {die($db->errno . " - " . $db->error);}
 $row = $result->fetch_assoc();
 $out = $row;
 $db->close();
 return $out;
 }

function PathToPic($id)
 {
 $out = "/userdata/default.png";
 global $sql,$profile;
 $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
 if(!$result = $db->query("SELECT * FROM `".$sql['db']."`.`pictures` WHERE `id` = $id;")) {die($db->errno . " - " . $db->error);}
 $row = $result->fetch_assoc();
 if($row)
  {
  $user = intval($row['uploader']);
  profile($user);
  $out = "/userdata/".$profile[$user]['id']."/photos/".$row['filename'];
  }
 $db->close();
 return $out;
 }
