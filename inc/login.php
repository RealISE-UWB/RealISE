<?
require_once("settings.php");
require_once("$base/inc/nohax.php");
function login($credentials) {
  global $sqlhost, $sqluser, $sqlpass, $sqldb, $sql;
  if($credentials['user'] != "" && $credentials['pass'] != "" && checktoken("login",$credentials['token'])) {
      $db = new mysqli($sqlhost, $sqluser, $sqlpass, $sqldb);
      if($db->connect_errno) {
         die("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
      }
      if(!$query = $db->prepare("SELECT * FROM `amplifyuw`.`users` WHERE `username` = ? AND `pass` = ?")) {
         die("Binding parameters failed: (" . $db->errno . ") " . $db->error);
      }
      if(!$query->bind_param("ss",$credentials['user'], sha1($credentials['pass']))) {
         die("Binding parameters failed: (" . $db->errno . ") " . $db->error);
      }
      if(!$query->execute()) {
         die("Binding parameters failed: (" . $db->errno . ") " . $db->error);
      }
      if($query->fetch()) {
         $_SESSION['user'] = $credentials['user'];
         return "success";
      } else {
         return array("signin" => "Check these again...");
      }
      $query->close();
      $db->close();
 } else {
 return array("signin" => "You have to put stuff in both of the boxes...");
 }
}

function signup($in) {
 global $sql,$recaptcha,$base;
 $out = array("signup-user"=>$in['user'],"signup-pass"=>$in['pass'],"signup-confirm"=>$in['confirm'],"signup-name"=>$in['name'],"signup-email",$in['email']);
 $success = true;
 require_once("$base/inc/userfunctions.php");
 require "$base/inc/recaptchalib.php";
 if(checktoken("signup",$in['token'])) {
  $success = false
  $out['signup-user-error'] = "Oops! Try that again!";
 }
 if(!preg_match('/^[a-z\d_]{1,20}$/i', $in['user'])) {
  $success = false;
  $out['signup-user-error'] = "Username may consist of letters, numbers and underscores and must be under 20 characters";
 } elseif(isuser("/".$in['user'])) {
  $success = false;
  $out['signup-user-error'] = "That username has already been taken";
 }
 if(strlen($in['pass']) < 5) {
  $success = false;
  $out['signup-pass-error'] = "Password must be at least 6 characters long";
 }
 if($in['pass'] != $in['confirm']) {
  $success = false;
  $out['signup-confirm-error'] = "Passwords don't match";
 }
 if(strlen($in['name']) > 100) {
  $success = false;
  $out['signup-name-error'] = "Sorry, we are not equipped to accept names over 100 characters at this time.";
 }
 if(!filter_var($in['email'], FILTER_VALIDATE_EMAIL) && $in['email'] != "") {
  $success = false;
  $out['signup-email-error'] = "Please provide a valid email address or none at all";
 } elseif(strlen($in['email'] > 100)) {
  $success = false;
  $out['signup-email-error'] = "Sorry, we are not equipped to accept emails over 100 characters at this time.";  
 }
 $captcha = recaptcha_check_answer ($recaptcha['private'], $_SERVER["REMOTE_ADDR"], $in["recaptcha_challenge_field"], $in["recaptcha_response_field"]);
 if(!$captcha->is_valid) {
  $success = false;
  $out['signup-captcha-error'] = $captcha->error;
 }
 $facebook = null;
 $twitter = null;
 $googleplus = null;
 $UWNetID = null;
 if($_SESSION['signedinwith'])
  {
  if($_SESSION['signedinwith'] == "facebook")
   {$_SESSION['facebook_id'];}
  elseif($_SESSION['signedinwith'] == "twitter")
   {$twitter = $_SESSION['twitter_name'];}
  }
 if($success) {
  $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
  if(!($add = $db->prepare("INSERT INTO `amplifyuw`.`users`(`username`,`pass`,`realname`,`email`,`twitter`,`facebook`,`googleplus`) VALUES (?,?,?,?)")))
   {die("Prepare failed: (" . $db->errno . ") " . $db->error);}
  $add->bind_param("ssss",$in['user'],sha1($in['pass']),$in['name'],$in['email'],$twitter,$facebook,$googleplus);
  $add->execute();
  $add->close();
  $db->close();
  $_SESSION['user'] = $in['user'];
  return "success";
 } else {
  return $out;
 }
}
?>
