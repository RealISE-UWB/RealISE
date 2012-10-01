<?
require_once("inc/settings.php");
require_once("$base/inc/session.php");
require_once("$base/inc/pics.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Search</title>
    <? require("$base/inc/header.php"); ?>
  </head>

<body data-spy="scroll" data-target=".subnav" data-offset="50">
<? include("$base/inc/navbar.php");
$query = "";
if(isset($_SERVER['PATH_INFO']))
 {$query = substr($_SERVER['PATH_INFO'],1);}
if($query != "")
 {
/////////////////////////////////
/// IN THE EVENT OF A QUERY//////
/////////////////////////////////
?>
 Searching for <? echo $query; ?>

<?
/// Begin insane SQL bullshit
 $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
 $search = $db->prepare("SELECT * FROM `".$sql['db']."`.`posts` WHERE MATCH (`text`) AGAINST (?)");
 $search->bind_param("s",$query);
 $search->execute();
 $results = array();
 $row = array("id"=>null,"user"=>null,"text"=>null,"source"=>null,"sourcelink"=>null,"sourceid"=>null,"time"=>null,"lat"=>null,"lon"=>null);
 $search->bind_result($row['id'], $row['user'], $row['text'], $row['source'], $row['sourcelink'], $row['sourceid'], $row['time'], $row['lat'], $row['lon']);
 while($row = $search->fetch()) {$results[] = $row;}
 $search->close();
 $db->close();

//Conclude insane SQL bullshit

foreach($results as $post)
 {
 echo "<pre>";
 print_r($post);
 echo "</pre>";
 }
} else {

////////////////////////////
//////NO QUERY//////////////
////////////////////////////


?><div class="container">
<header class="jumbotron subhead" id="overview">
<h1>Search</h1>
<p class="lead">Search for anything right here:</p>
</header>
<form action="/photos" method="post" enctype="multipart/form-data">
<input type="file" name="pictures" multiple="true" id="uploadbox" title="Protip" data-content="Press ctrl to select multiple files"/><br />
<button type="submit"><i class="icon-upload"></i> Upload</button>
</form>
<ul>
<?
if(isset($_FILES["pictures"]))
 {
 $uploaded = savepics();
 ?><a href="/updateprofile/?newpic=<? echo $uploaded['url']; ?>" class="btn btn-primary"><i class="icon-user"></i> Set as profile picture</a><br /><br />
 <img src="<? echo $uploaded['url']; ?>" />
<? } ?>
</ul>
<? } ?>
<? require("$base/footer.inc.php"); ?>
