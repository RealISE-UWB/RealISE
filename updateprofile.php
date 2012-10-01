<?
require_once("inc/settings.php");
session_start();
require_once("$base/inc/userfunctions.php");
if(isset($_REQUEST['newpic']))
 {updateprofile("profilepic",intval($_REQUEST['newpic']));}
header("Location: /user/".$_SESSION["user"]);
