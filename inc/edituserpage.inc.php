<?
global $profile;
global $thisuser;
$thisuser = $path[1];
if($thisuser != $_SESSION['user'])
 {
 header("Location: /user/".$_SESSION['user']."/edit");
 }
$profile = array($thisuser => profile($thisuser), $_SESSION['user'] => profile($_SESSION['user']));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Edit Profile - Amplify<? echo $profile[$thisuser]['firstname']; ?></title>
    <? include("inc/header.php"); ?>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">


   <? include("/var/amplify/inc/navbar.php"); ?>


    <div class="container">

      <!-- Masthead
      ================================================== -->
      <header class="jumbotron subhead" id="overview">
        <h1>Amplify<? echo $profile[$thisuser]['firstname']; ?></h1>
        <small><i>I'm editing your life away...</i>
        <p class="lead">This is where <? echo $profile[$thisuser]['fullname']; ?> goes to manage his/her user profile.</p>
        <div class="subnav">
          <ul class="nav nav-pills">
            <li><a href="#aboutMe">About me</a></li>
            <li><a href="#photos">Photos</a></li>
            <li><a href="#calendar">Calendar</a></li>
            <li><a href="#howISeeIt">How I see it</a></li>
            <li><a href="#questions">Questions</a></li>
            <li><a href="#iWantToKnow">I want to know</a></li>
          </ul>
        </div>
      </header>



 <!-- ScrollSpy
    ================================================== -->
    <section id="scrollspy">
      <div class="page-header">
      <!-- make into "firstname" -->
        <h1>id: <? echo $profile[$thisuser]["username"]; ?> <small>(the good stuff)</small>      
        <span class="edit" >    
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button class="btn">Cancel</button></span></h1> 
            
      </div>
      <div class="row">
        <div class="span3 columns">
          <p><strong>About  <? echo $profile[$thisuser]["firstname"]; ?>  </strong>
          <div class="control-group">
            <div class="controls">
              <textarea name="aboutme" class="input-xlarge edit" id="textarea" rows="3" >Make the user's previous data show up in these areas...</textarea>
            </div>
          </div></p>
          <p><strong>Social reach:  </strong> <br> <!-- get Klout score --> 57 <small> via <a href="http://klout.com/home">Klout</a></small></p> 
          <p><strong>Age  </strong>
          <div class="control-group">
            <div class="controls">
              <input class="input-xlarge focused edit" id="focusedInput" type="text" value="18">
            </div>
          </div>	
          <p><strong>Contact info  </strong>
          <div class="control-group">
            <div class="controls">
              <input class="input-xlarge focused edit" id="focusedInput" type="text" value="(808) 854-6996">
            </div>
          </div>
          <p><strong>Checked in  </strong> 
          <br><div class="control-group">
            <div class="controls">
              <input class="input-xlarge focused edit" id="focusedInput" type="text" value="Bothell, WA">
            </div>
          </div><br>
          <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;q=uw+bothell&amp;aq=&amp;sll=47.75857,-122.190306&amp;sspn=0.01017,0.022724&amp;t=h&amp;ie=UTF8&amp;st=113382090880839597407&amp;rq=1&amp;ev=zi&amp;split=1&amp;radius=0.63&amp;hq=uw+bothell&amp;hnear=&amp;ll=47.542262,-122.057394&amp;spn=0.010169,0.022724&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;q=uw+bothell&amp;aq=&amp;sll=47.75857,-122.190306&amp;sspn=0.01017,0.022724&amp;t=h&amp;ie=UTF8&amp;st=113382090880839597407&amp;rq=1&amp;ev=zi&amp;split=1&amp;radius=0.63&amp;hq=uw+bothell&amp;hnear=&amp;ll=47.542262,-122.057394&amp;spn=0.010169,0.022724" style="color:#0000FF;text-align:left">View Larger Map</a></small></p> <!-- pull location from FB and display on map-->
          
         
        </div>
        <div class="span9 columns">
          <h2><? echo $profile[$thisuser]["username"]; ?>'s impact on the world</h2>
          <p>Where exactly is <? echo $profile[$thisuser]["firstname"]; ?> posting?</p>
          <div id="navbarExample" class="navbar navbar-static">
            <div class="navbar-inner">
              <div class="container" style="width: auto;">
                <a class="brand" href="#">Recent tags</a>
                <ul class="nav">
                <li><a href="#idk">Most recent</a></li>
                  <li><a href="#tweet1">@tweet1</a></li>
                  <li><a href="#tweet2">@tweet2</a></li>
                  <li><a href="#tweet3">@tweet3</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#tweet4">@tweet4</a></li>
                      <li><a href="#tweet6">@tweet5</a></li>
                     
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example">
            <h4 id="tweet1">@tweet1</h4>
            <p>
		    This is tweet 1.            	
            </p>
            <h4 id="tweet2">@tweet2</h4>
            <p>
		    This is tweet 2.            	
            </p>
            <h4 id="tweet3">@tweet3</h4>
            <p>
		    This is tweet 3.            	
            </p>
            <h4 id="tweet4">@tweet4</h4>
            <p>
		    This is tweet 4.            	
            </p>
            <h4 id="tweet5">@tweet5</h4>
            <p>
		    This is tweet 5.            	
			</p>
            
          </div>
          <hr>
          
          <h3>Favorites </h3> 
          <table class="table table-bordered table-striped">
            <thead>
             <tr>
               <th style="width: 100px;">Professor</th>
               <th style="width: 100px;">Food</th>
               <th style="width: 50px;">Music</th>
               <th>Future goals</th>
             </tr>
            </thead>
            <tbody>
             <tr>
               <td>Prof. Smith</td> <!-- number of posts -->
               <td>Sushi</td>
               <td>Skrillex</td>
               <td>[this will have the person's future goals.]</td>
             </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>



<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/google-code-prettify/prettify.js"></script>
<script src="/assets/js/bootstrap-transition.js"></script>
<script src="/assets/js/bootstrap-alert.js"></script>
<script src="/assets/js/bootstrap-modal.js"></script>
<script src="/assets/js/bootstrap-dropdown.js"></script>
<script src="/assets/js/bootstrap-scrollspy.js"></script>
<script src="/assets/js/bootstrap-tab.js"></script>
<script src="/assets/js/bootstrap-tooltip.js"></script>
<script src="/assets/js/bootstrap-popover.js"></script>
<script src="/assets/js/bootstrap-button.js"></script>
<script src="/assets/js/bootstrap-collapse.js"></script>
<script src="/assets/js/bootstrap-carousel.js"></script>
<script src="/assets/js/bootstrap-typeahead.js"></script>
<script src="/assets/js/application.js"></script>

<? include("/var/amplify/analytics.php"); ?>
  </body>
</html>
