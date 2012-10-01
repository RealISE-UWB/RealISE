<?
session_start();
require_once("inc/settings.inc.php");
require_once("$base/inc/pics.inc.php");
require_once("$base/inc/resize.inc.php");
require_once("$base/inc/nohax.inc.php");


$uploaded = 0;

if(isset($_FILES["pictures"])) {
 if(checktoken("photo-upload",$_POST['token'])) {
  $uploaded = 1;
 } else {
  $uploaded = 2;
 }
}
 
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Photo Wall</title>
     <? require "$base/inc/header.php"; ?>
  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">
   <? require "$base/inc/navbar.php"; ?>
    <div class="container">
    <?
    $singlePhoto = false;
    if(isset($_SERVER['PATH_INFO']))
     {
      $path = explode("/",$_SERVER['PATH_INFO']);
      if(count($path) > 2)
       {
       $singlePhoto = true;
       }
     }
     if(!$singlePhoto)
      {
    ?>
<!--In the event of a set of photos -->
<!-- Masthead
================================================== -->
<header class="jumbotron subhead page-header" id="overview">
  <h1>Photo Wall</h1>
  <p class="lead">Where everyone's photos come together</p>
</header>
<?
$user = null;
if(!isset($_SERVER['PATH_INFO']) && isset($_SESSION['user']))
 {
?>
<form action="/photos" method="post" enctype="multipart/form-data" class="well">
<? maketoken("photo-upload"); ?>

Upload a picture: <input type="file" name="pictures[]" multiple="true" id="uploadbox" title="Protip" data-content="Press ctrl to select multiple files"/></br>
<button class="btn btn-success" type="submit"><i class="icon-upload"></i> Upload</button>
</form>

<!-- Reports photos uploaded -->
	
		<ul><? 
		if($uploaded = 1) {
         $uploaded = savepics();
         $s = "";
         if(count($uploaded) > 1) {
          $s = "s";
         }
         echo "<div class=\"alert alert-success\">Uploaded ".count($uploaded)." picture".$s."!</div>";
         } elseif($uploaded = 2) {
           echo "<div class=\"alert alert-error\">Failed to upload, please try again</div>";
         }
		 ?></ul>

<? } elseif(isset($_SESSION['PATH_INFO'])) {
 $path = explode("/",$_SERVER['PATH_INFO']); $user = $path[1];} ?>
<table class="well">
<tr>
<?
$picsthisrow = 0;
foreach(picsfromuser($user) as $picture)
 {
 profile(intval($picture['uploader']));
 $path = resize("/userdata/".$picture['uploader']."/photos/".$picture['filename'],array("scale"=>true,"thumbnail"=>true,"h"=>0,"w"=>250));
 echo "<td class=\"span3\"><a href=\"/photos/".$profile[intval($picture['uploader'])]['username']."/".$picture['id']."\"><img src=\"$path\"/></a>";
// if(isset($_SESSION['user']))
//  {echo "<a href=\"/updateprofile?newpic=".$picture['id']."\" class=\"btn\"><i class=\"icon-user\"></i> Set </a> ";}
// echo "<b>".$profile[intval($picture['uploader'])]['fullname']."</b></td>";
 $picsthisrow++;
 if($picsthisrow > 5) {$picsthisrow = 0; echo "</tr>\n<tr>";}
 }
?>
</tr>
</table>
<?} else {
$picture = pic($path[2]);
$imgsrc = "/userdata/".$picture['uploader']."/photos/".$picture['filename'];
?>
<!-- A single photo is to be displayed -->
<img src="<? echo $imgsrc; ?>" width="90%"><br />
<table>
<? foreach($picture as $key=>$value)
 {
 echo "<tr><td>$key</td><td>$value</td></tr>";
 }
?>
</table>



<? }
require_once("$base/footer.inc.php");?>
