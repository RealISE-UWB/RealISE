<?
include("inc/settings.inc.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>RealISE <? echo $school["acronym"]; ?></title>
    <? require_once("$base/inc/header.inc.php"); ?>  
  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">


<? require_once("$base/inc/navbar.inc.php"); ?>

    <div class="container">
	
		<!-- Masthead
		================================================== -->
			<div class="hero-unit">
			    <h1><img src="/img/long-logo-v2.png" alt=""></h1> 
			    <p class="lead"><b>RealISE</b> is the tool for students to support each other by sharing what they know about their campus and its surrounding communities.	</p>
	
			<!-- Body
			================================================== -->
				<center>
					<a class="btn btn-uw" href="form.php"><h1w>GO BEYOND!</h1w></a>
				</center>

		    </div><!-- End hero unit -->
	    
	</div><!-- /container -->
	
	
	
	    <? require_once("$base/footer.inc.php");?>
