<?
require_once("$base/inc/userfunctions.inc.php");
if(isset($_SESSION['user'])) {profile($_SESSION['user']);}
?>

	
		
<div class="container">

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">       
        	<a class="brand" href="/">RealISE:UWB</b></a>
        </div>
      </div>
		<? if(!isset($_COOKIE['hidetesterbox'])) { ?>
              <!-- Commented just until we are deploying our beta stuff ...getting annoying -->
      			<div class="alert alert-success pull-right offset8" style="text-align:center">
				    <button class="close" data-dismiss="alert" onclick="void(document.cookie='hidetesterbox=true')">x</button>This site is still in beta. If you see anything that is wrong or missing, please <a href="mailto:support@realiseuwb.com">let us know</a>
			    </div>
		<? } ?>			   
    </div>
  </div>
    
       

