<?
session_start();
include("inc/settings.php");
if(!isset($_SESSION['user'])) {die("You must be logged in to contribute to Amplify.");}
if(!isset($_REQUEST['token']))
 {die("At least *set* a token...");}
else
 {
 if($_REQUEST['token'] != $_SESSION['posttoken']) {die("Please try again");}
 else
  {
  include("$base/inc/sqlcredentials.php");
  include("$base/inc/userfunctions.php");
  profile($_SESSION['user']);
  $db = new mysqli($sqlhost, $sqluser, $sqlpass, $sqldb);
  $source = "Amplify";
  $stmt = $db->prepare("INSERT INTO `$sqldb`.`posts` (`user`,`text`,`source`) VALUES(?,?,?)");
  $stmt->bind_param("iss",$profile[$_SESSION['user']]['id'], $_REQUEST['text'],$source);
  if($stmt->execute()) {header("Location: ".$_SERVER['HTTP_REFERER']);} else {echo $stmt->error;}
  $stmt->close();
  $db->close();
  }
 }
?>
