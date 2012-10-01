<?
require_once("inc/settings.inc.php");
require_once("$base/inc/session.inc.php");
require_once("$base/inc/userfunctions.inc.php");
require_once("$base/inc/tips.inc.php");
require_once("$base/inc/nohax.inc.php");
$saved = array("status"=>0);
if(isset($_POST['token']))
 {
 if(checktoken("hub",$_POST['token']))
  { $saved = save(intval($_POST['category']), $_POST['title'], $_POST['body']); }
 }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>The Hub</title>
    <? require_once("$base/inc/header.inc.php"); ?>   
  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">


<? require_once("$base/inc/navbar.inc.php"); ?>

   		<!--
	    <div class="alert" style="text-align:center">
		    <button class="close" data-dismiss="alert">X</button>
		    This page is being worked on by Josh.
		</div>
		-->
		
	<!-- BEGIN PAGE CONSTRUCTION -->

  
  <div class="container">
  			<header class="jumbotron subhead page-header">
			 	<h1>the Hub<!--<small>{your guide to making your experience in college the best it can be}</small>--></h1>
			 	<p class="lead">A centralized, community-driven resource for finding out the unadvertised but useful parts about your campus.</p> 	  
			</header>
			
	
		  <div class="row-fluid">
                <? 
                if(isset($_SESSION['user'])) { // If the user is logged in 
                ?>
                		      
		    <div class="span3 well"> <!--begin span3 section-->
		      <!--Sidebar content-->
		      		      
		      <h3 class="lead">Have something to share?</h3>
		      
		      <? if($saved['status'] == 1) {?><div class="alert alert-success"><button class="close" data-dismiss="alert">X</button> <center>Tip posted!</center></div><? } ?>
		      <? if($saved['status'] == 2) {?><div class="alert alert-error"><button class="close" data-dismiss="alert">X</button> <center>Please make sure to fill out all fields and select the right category for your post.</center></div><? } ?>
		      <? if($saved['status'] == 3) {?><div class="alert alert-error"><button class="close" data-dismiss="alert">X</button> <center>You will need to <a href="/signin">login</a> before you can do that.</div><? } ?>

		      
		      <form action="/hub" method="post">
              <? maketoken("hub"); ?>
	      		<label class="control-label">Category</label>
			      <div class="controls">
		              <select class="span3" name="category">
		              	<option value="1">Food & Drink</option>
		                <option value="2">Classroom</option>
		                <option value="3">Living</option>
		                <option value="4">Commuting</option>
		                <option value="5">Tech Tips</option>
		                <option value="6">El Cheapo</option>
		              </select>
	              </div>
	              
		        <div class="control-group">
		            <label class="control-label">Title</label>
		            <div class="controls">
		              <input type="text" name="title" placeholder="$2 Large Drip Coffee" class="span3">
		            </div>
		         </div> 
		         
		         <div class="controls">
			         <label class="control-label">Body</label>
				         <textarea type="text"class="input-xlarge span3" name="body" placeholder="I found out that on the third floor in the Cascadia building, there is a coffee shop that sells a large coffee for $2.07. It's not burnt and it really helped me get my day going! #CheapFood" rows="6"></textarea>
				          <button type="submit" class="btn btn-primary">Submit</button>  <!--upon resize, change the button to go to size of device --> 

			     </div>  
               </form>
               
			  

			     		    
		    </div> <!-- ends span3 section -->
		    
		  <? } else { // User is not logged in ?>
		    <div class="span3 well"> <!--begin span3 section-->
		      <!--Sidebar content-->
		      <h3 class="lead">Have something to share?</h3>
                      <center><i>You will need to <a href="/signin">login</a> to post</i></center>
		    </div> <!-- ends span3 section -->

          <? } ?>                 
          	
          	
          	<!--TEXT POSTS-->
			<div class="tabbable span8"> <!--span8 applies to all divs in this section-->
			  <ul class="nav nav-tabs">
			    <li class="active"><a href="#foodanddrink" data-toggle="tab">Food & Drink</a></li>
			    <li><a href="#classroom" data-toggle="tab">Classroom</a></li>
			    <li><a href="#living" data-toggle="tab">Living</a></li>
			    <li><a href="#commuting" data-toggle="tab">Commuting</a></li>
			    <li><a href="#techtips" data-toggle="tab">Tech Tips</a></li>
			    <li><a href="#elcheapo" data-toggle="tab">El Cheapo</a></li>
			    
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Are we missing a category? <b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="mailto:support@amplifyuwb.com?subject=Category%20Suggestion" >Send a suggestion</a></li>
					</ul>
				</li>
			    
			  </ul>
				  <div class="tab-content">
				    <div class="tab-pane active" id="foodanddrink">
						<div class="page-header">
							<h1>Food & Drink <small class="lead">Hungry or thirsty? Fix that for less.</small></h1>
							
						</div>
	                        <? displayTips(1); ?>				
				    </div>
				    <div class="tab-pane" id="classroom">
						<div class="page-header">
							<h1>Classroom <small class="lead">Some whitty comment</small></h1>
						</div>
						 	<? displayTips(2); ?>		
				    </div>
				    <div class="tab-pane" id="living">
						<div class="page-header">
							<h1>Living <small class="lead">Some whitty comment</small></h1>
						</div>
	                        <? displayTips(3); ?>
				    </div>
				    <div class="tab-pane" id="commuting">
						<div class="page-header">
							<h1>Commuting <small class="lead">How do you get from A to B?</small></h1>
							<p>Need an <a href="http://www.orcacard.com/ERG-Seattle/p1_001.do">Orca Card</a>? Where is your bus? <a href="http://www.onebusaway.org/">Find out now</a>! Trying to <a href="http://www.zipcar.com/?redirect_p=0">get somewhere</a>?</p>
						</div>
						 	<? displayTips(4); ?>		
				    </div>
				    <div class="tab-pane" id="techtips">
						<div class="page-header">
							<h1>Tech Tips <small class="lead">How is one person expected to know it all?</small></h1>
						</div>
						 	<? displayTips(5); ?>		
				    </div>
				    <div class="tab-pane" id="elcheapo">
						<div class="page-header">
							<h1>El Cheapo <small class="lead">Your guide to doing things. Cheaply.</small></h1>
						</div>
							<? displayTips(6); ?>	
					</div>
				</div> <!.tab content -->
   		       
		    </div> <!--ends span8 -->
		    
		  </div> <!--Ends row fluid-->
	 </div> <!--ends container fluid -->
		

	
<? require_once("$base/footer.inc.php");?>


<!--TO BE IMPLEMENTED

<!--SEARCH BAR:
            		  		
			<div class="container-fluid">
				<h2 class="lead">Looking for something?</h2>
				<input type="text" class="search-query">
				<a class="brand btn btn-success" href="#">Search</a> 
			</div>
 -->   
