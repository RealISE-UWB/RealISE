<?
session_start();
require_once("inc/settings.php");
require_once("$base/inc/userfunctions.php");
require_once("$base/inc/options.inc.php");
if(!isset($_SESSION['user']))
 {
 header("Location: /signin");
 die("Please sign in first");
 }

$thisuser = $_SESSION['user']; 
profile($thisuser);
$error = array("status"=>0);
if(isset($_POST['name'])) 
 {
 $error = save_settings($_POST);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Edit Profile</title>
<? require_once("$base/inc/header.php"); ?>
</head>
<? require_once("$base/inc/navbar.php"); ?>

<!-- DONE -->
<? if($error['status'] == 1) { //Settings were saved, all is well?><div class="alert alert-success">Settings saved</div><? }
elseif($error['status'] == 2) { //Some settings were saved, some were invalid?><div class="alert">Please check some of these (the rest were saved):</div><? } ?>

<!-- Begin Page formatting -->
	<div class="container">
	
		<header class="jumbotron subhead">
			<h1>Edit Profile</h1>
		</header>
			<div class="span6"> <!-- Begin Edit Sections -->
				<form action="/options" method="POST">
					<section id="personal">
						<div class="page-header">
							<h1>Personal Info</h1>
						</div>
						
						<div class="well"> <!-- Personal Info -->
						
							
							<? if(isset($error['name'])) { ?><span class="badge badge-warning"><? echo $error['name']; ?></span><br /><? } ?>
							Full Name: <input type="text" name="name" placeholder="Your Full Name" maxlength="100" value="<? echo $profile[$thisuser]['fullname']; ?>"><br />
							
							<? if(isset($error['about'])) { ?><span class="badge badge-warning"><? echo $error['about']; ?></span><br /><? } ?>
							About me: 
	<br><textarea class="span5" name="about" rows="9" placeholder="Want to share something about yourself? Try doing it in 300 character or less." maxlength="300"><? echo $profile[$thisuser]['about']; ?></textarea><br />
							
							<? if(isset($error['contact'])) { ?><span class="badge badge-warning"><? echo $error['contact']; ?></span><br /><? } ?>
							Contact info: 
	<br><textarea class="span5" name="contact" rows="5" placeholder="Let everyone know how you'd like to be reached. You can list anything here." maxlength="300"><? echo $profile[$thisuser]['contact']; ?></textarea><br />
						
						</div> <!-- End Personal Info -->
					</section>
					
					<section id="favorites">
						<div class="page-header">
							<h1>Favorites <small>let us know what you like </small></h1> <p class="lead">Who knows...you might be suprised one day.</p>
							
						</div>
						
						<div class="well"> <!-- Begin Favorite Info -->
						
							<p>	
									
							<? if(isset($error['favorite-profs'])) { ?><span class="badge badge-warning"><? echo $error['favorite-profs']; ?></span><br /><? } ?>
							Professors: 
	<br><textarea class="span5" type="text" name="favorite-profs" rows="5" placeholder="List some of your favorite profs" maxlength="300"><? echo $profile[$thisuser]['favorite-profs']; ?></textarea><br />
							
							<? if(isset($error['favorite-foods'])) { ?><span class="badge badge-warning"><? echo $error['favorite-foods']; ?></span><br /><? } ?>
							Food: 
	<br><textarea class="span5" type="text" name="favorite-foods" rows="5" placeholder="List some of your favorite foods" maxlength="300"><? echo $profile[$thisuser]['favorite-foods']; ?></textarea><br />
							
							<? if(isset($error['favorite-music'])) { ?><span class="badge badge-warning"><? echo $error['favorite-music']; ?></span><br /><? } ?>
							Music: 
	<br><textarea class="span5" type="text" name="favorite-music" rows="5" placeholder="What music do you listen to?" maxlength="300"><? echo $profile[$thisuser]['favorite-music']; ?></textarea><br />
							
							<? if(isset($error['favorite-app'])) { ?><span class="badge badge-warning"><? echo $error['favorite-app']; ?></span><br /><? } ?>
							Application: 
	<br><textarea class="span5" type="text" name="favorite-music" rows="5" placeholder="What app do you find yourself using most on your smartphone?" maxlength="300"><? echo $profile[$thisuser]['favorite-app']; ?></textarea><br />
							
							</p>
						</div> <!-- End Favorite Info -->
					</section>
					
					<section id="howISeeIt">
					<div class="page-header"> <!--Begin How I See It -->
						<h1>How I See It</h1>
					</div>
					<div class="well">
						<p>How I See It: 
                                                 <? if(isset($error['howiseeit'])) { ?><span class="badge badge-warning"><? echo $error['howiseeit']; ?></span><br /><? } ?>
						<br><textarea class="span5" type="text" name="howiseeit" rows="9" placeholder="What's your opinion on a topic?" maxlength="500"><? echo $profile[$thisuser]['howiseeit']; ?></textarea><br />
						</p>
					</div> <!-- End How I See It-->
					</section>
					
					
					
					<section id="socialMedia">
					<div class="page-header">	
						<h1>Other social media</h1>
					</div>
					
					<div class="well"> <!-- Begin Social Media Section -->
						<a href="javascript: void(0);" class="btn">Link with Twitter</a> <a href="javascript: void(0);" class="btn">Link with Facebook</a>
					</div> <!-- End Social Media Section -->
					</section>
					
					<a href="/user/<? echo $profile[$thisuser]['username']; ?>" class="btn" type="cancel">Cancel</a>
					<button type="submit" class="btn btn-primary">Save</button>
					
				</form>
			</div>
	</div>
	
<? require_once("$base/footer.inc.php");?>
