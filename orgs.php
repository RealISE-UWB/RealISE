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

		        
		        <h1>Volunteer!</h1>
		        <p>If you see an organization that interests you, click on the banner to learn more about it. If you would like to submit your profile to the organization, click the "Submit" button on their home page.</p>
			    
			</div><!-- End hero unit -->
			
			<div class="row">
				<!--=========LEFT COLUMN=========-->
				<div class="span9">
					<div class="">
						<a href="orgs/boysandgirls.php"><h2>Boys & Girls Club</h2><img class="thumbnail" src="/img/boysAndGirls.jpg"></a>
					</div>
					<br>
					
					<div class="">
						<a href="orgs/ymca.php"><h2>YMCA</h2><img class="thumbnail" src="/img/ymca.jpg"></a>
					</div>	
					<br>
					
					<div class="">
						<a href="orgs/habitat.php"><h2>Habitat for Humanity</h2><img class="thumbnail" src="/img/habitat.jpg"></a>
					</div>	
					<br>
					
					<div class="">
						<a href="orgs/salvation.php"><h2>Salvation Army</h2><img class="thumbnail" src="/img/salvation.jpg"></a>
					</div>	
				</div>
				
				<!--=========RIGHT COLUMN=========-->
				<div class="span3">
					
				</div>
			</div>			
				    
	</div><!-- /container -->
	
	
	
	    <? require_once("$base/footer.inc.php");?>
