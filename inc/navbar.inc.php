<!-- REGULAR Navbar
    ================================================== -->
<?
require_once("$base/inc/userfunctions.inc.php");
if(isset($_SESSION['user'])) {profile($_SESSION['user']);}
?>

	
		
<div class="container">

    <div class="navbar navbar-fixed-top"> <!-- replace with     <div class="navbar navbar-fixed-top"> for fix navbar -->
      <div class="navbar-inner">
        <div class="container">
          <!--<a class="btn btn-navbar" data-target=".nav-collapse">-->
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <!--<a class="brand" href="/"><img src="/img/AmplifyLogo_b3_small.png" alt=""></a> -->
        
        
        <a class="brand" href="/">Amplify<b>UWB</b></a>
          <div class="nav-collapse">
            <ul class="nav">
            
              <li class="<? if($_SERVER['SCRIPT_NAME'] == "/feed") {echo "active";} ?>">
                <a href="/feed">the Feed</a>
              </li>
             
             <!-- I feel like this isn't nessessary in the navbar, talk to me if you think otherwise
              <li class="<? if($_SERVER['SCRIPT_NAME'] == "/user") {echo "active";} ?>">
                <? if(array_key_exists('user', $_SESSION)) {?><a href="/user/<? echo $_SESSION['user']; ?>">Amplify<? echo $profile[$_SESSION['user']]['firstname']; ?></a><? } else { ?><a href="/signin?dest=<? echo $_SERVER['SCRIPT_NAME']; ?>">AmplifyYou</a><? } ?>
              </li>
              -->
              
              <li class="<? if($_SERVER['SCRIPT_NAME'] == "/hub") {echo "active";} ?>">
                <a href="/hub">the Hub</a>
              </li>
              
              <li class="<? if($_SERVER['SCRIPT_NAME'] == "/photos") {echo "active";} ?>">
                <a href="/photos">Photo Wall</a>
              </li>
             <!--To Be voted on 
              <li class="<? if($_SERVER['SCRIPT_NAME'] == "/events") {echo "active";} ?>">
                <a href="/events">Calendar</a>
              </li>
            -->
              <li class="<? if($_SERVER['SCRIPT_NAME'] == "/about") {echo "active";} ?>">
                <a href="/about">About Us</a>
              </li>
             
              <!-- TAKEN OUT UNTIL FURTHER NOTICE - TO BE VOTED ON
              <li class="<? if($_SERVER['SCRIPT_NAME'] == "https://www.surveymonkey.com/s/9YNGMWM") {echo "active";} ?>">
                <a href="https://www.surveymonkey.com/s/9YNGMWM"  target="_blank">Beyond Walls</a>
              </li>
              -->
         
             
            </ul>
            
            <p class="navbar-text pull-right"><? if(isset($_SESSION['user'])) {?>Logged in as <a href="/user/<? echo $_SESSION['user']; ?>"><? echo $_SESSION['user']; ?></a> [<a href="/signout">sign out</a>]<? } else { ?><a href="/signin?dest=<? echo $_SERVER['SCRIPT_NAME']; ?>">Sign in or sign up</a><? } ?></p>
          </div>
          
        </div>
        <? if(!isset($_COOKIE['hidebetabox'])) { ?>
        <!-- Commented just until we are deploying our beta stuff ...getting annoying -->
        	<div class="alert" style="text-align:center">
			    <button class="close" data-dismiss="alert" onclick="void(document.cookie='hidebetabox=true')">x</button>
			    This site is still in beta. If you see anything that is wrong or missing, please <a href="mailto:support@amplifyuwb.com">let us know</a>.
			</div>
           <? } ?>

			
      </div>
		<? if(!isset($_COOKIE['hidetesterbox'])) { ?>
              <!-- Commented just until we are deploying our beta stuff ...getting annoying -->
      			<div class="alert alert-success pull-right offset8" style="text-align:center">
				    <button class="close" data-dismiss="alert" onclick="void(document.cookie='hidetesterbox=true')">x</button>
				    If you are interested in <b>testing</b> new features, send an email to <a href="mailto:support@amplifyuwb.com?subject=Beta%20Request<? if(isset($_SESSION['user'])) {echo ":%20".$profile[$_SESSION['user']]['fullname'];} ?>&body=I would like to be added to the beta testers group. My username is: <? if(isset($_SESSION['user'])) {echo $profile[$_SESSION['user']]['username']; ?>. Thank you, <? echo $profile[$_SESSION['user']]['firstname']; } ?>">support@amplifyuwb.com</a> and we will add you to the group. 
			    </div><? } ?>
			   
    </div>
  </div>
    
       

