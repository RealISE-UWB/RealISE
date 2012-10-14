<!-- Regular about page -->
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
	    <h1><img src="/img/realise_main_logo.png" alt=""></h1> 
	    <p class="lead"><b>RealISE</b> is a tool for students to support each other by sharing what they know about their campus and its surrounding communities.</p>	   
	</div>

		<div class="tabbable"> 
		<h1 class="lead"><b>Upcoming Features</b></h1>
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab1" data-toggle="tab">Relevance</a></li>
		    <li><a href="#community" data-toggle="tab">Community</a></li>
		    <li><a href="#calendar" data-toggle="tab">Calendar</a></li>
		    <li><a href="#suggestions" data-toggle="tab">User Suggestions</a></li>
		    <li><a href="#gps" data-toggle="tab">GPS sourcing</a></li>
		    <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
		    <li><a href="#prof-ratings" data-toggle="tab">Professor ratings</a></li>
		    <li><a href="#bitchables" data-toggle="tab">"Bitchables"</a></li>
		    <li><a href="#gamebox" data-toggle="tab">Gamebox</a></li>
		  </ul>
		  
		  <div class="tab-content">
		    <div class="tab-pane active" id="tab1">
		      <p class="lead">A recap of what you find useful, based upon how often you and your friends found it useful.</p>
		      <p>What you are into on campus; activities, favorite places to study or socialize.  This is a place where you can show where you spend your time and what grabs your attention. Browse the pages of others to find out things you might have missed on your own campus.</p>
		    </div>
		    <div class="tab-pane" id="community">
		      <p class="lead">What’s around your area, according to categories you choose, and the places you’ve Amplified.</p>
		      <p>What’s around your area, by categories you choose, and the places you’ve heard.</p>
		    </div>
		    <div class="tab-pane" id="calendar">
		      <p class="lead">What’s the what - and when, finally all in one place.</p>
		      <p>Browse the calendar of events at your school, community, local events, and more. Easily add what you find to your Google calendar, ICal or Outlook. Feel free to share your favorite upcoming events to our calendar at RealISE!</p>
		    </div>
		    <div class="tab-pane" id="suggestions">
		      <p class="lead">Have you got a better idea?! That’s what RealISE is all about; give us an earful of your best ideas!</p>
		      <p>We built RealISE knowing that there’s more knowledge in the student collective than there is anywhere else on campus. We welcome new ideas to improve RealISE as often as possible- especially if your idea is really weird, share it! Deviation from the norm is how progress is made.</p>
		    </div>
		    <div class="tab-pane" id="gps">
		      <p class="lead">The shortest distance between you and what you want is RealISE’s GPS feature.</p> 
		      <p>Our GPS feature uses the Wi-Fi nodes in each classroom across the campus to direct you to where you want to go. Type in a classroom number, event space, or staff or faculty name - your mobile device will direct you to the class they are teaching or their office hours, whichever is happening now.</p> 
		    </div>
		    <div class="tab-pane" id="reviews">
		      <p class="lead">Aren’t we all picky and opinionated?</p>
		      <p>Let us know what you thought of books, food, coffee and other services offered on the campus area.
		    </div>
		    <div class="tab-pane" id="prof-ratings">
		      <p class="lead">Prepare your papers to be perfectly palatable for these perfectionist professors (list).</p>
		      <p>Share what worked or didn’t work for your learning style in a particular class by providing constructive criticism about what your takeaway, so that others can learn from your experience. Some professors are very particular; please share your tips on how to stay on the upper end of the curve.</p>
		    </div>
		    <div class="tab-pane" id="bitchables">
		      <p class="lead">The dog ate my laptop! (It wasn’t my fault, but it happened to me anyway, FML.)</p>
		      <p>This is the place for you to get what’s bothering you off your chest so you can focus on the good things. Tell your story of what went wrong, and just move on. The names of all parties will be changed to protect the use of this space. Trolling and over-use of this area is monitored by the RealISE community, so keep it real.</p>
		    </div>
		    <div class="tab-pane" id="gamebox">
		      <p class="lead">Gamer, meet Game maker - Homework, meet back burner.</p>
		      <p>We already know that all work and no play makes Jack a dull boy. Every day new games are developed by students on their own time. Post and play them here, and provide suggestions to the game developers to help make their games even better.</p>
		    </div>
		  </div>
		</div>
	
	  
	    </div><!-- /container -->
	
	
	
	    <? require_once("$base/footer.inc.php");?>
