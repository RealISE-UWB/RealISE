<?
/*
JOSH/OTHER FRONT END DEV:
See this? Don't fuck with it. It's a magical spell I cast upon the server.
Try inc/userpage.php, unless you're looking for the "can't find user" page,
in which case try inc/nosuchuser.php.
*/
require_once("inc/settings.php");
require_once("$base/inc/session.php");
$path = explode("/",$_SERVER['PATH_INFO']);
include("$base/inc/userfunctions.php");
if($_SERVER['PATH_INFO'] == "/" || $_SERVER['PATH_INFO'] == "") {
  header("Location: /");
 } elseif(!isuser($path[1])) {
  require("$base/inc/nosuchuser.php");
 } else {
  require("$base/inc/userpage.php");
 }
