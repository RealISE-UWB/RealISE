<?
function maketoken($name)
 {
 $token = uniqid();
 $_SESSION[$name + "_token"] = $token;
 echo "<input type=\"hidden\" name=\"token\" value=\"$token\" />";
 }

function checktoken($name, $token)
 {
 if($_SESSION[$name + "_token"] == $token) {return true;}
 else {return false;}
 }
