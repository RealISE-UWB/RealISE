<!--Works on laptops, iPad -->
<?
require_once("settings.inc.php");

require_once("$base/inc/pics.inc.php");
require_once("$base/inc/resize.inc.php");
global $profile;
global $thisuser;
$thisuser = $path[1];
profile($thisuser);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Amplify<? echo $profile[$thisuser]['firstname']; ?></title>
    <?
      require_once("$base/inc/header.inc.php");
    ?>
  </head>
    <? require_once("$base/inc/navbar.inc.php"); ?>
    
   <!--
	    <div class="alert alert-success" style="text-align:center">
		    <button class="close" data-dismiss="alert alert-success">X</button>
		    This page is being worked on by Josh.
		</div>
   -->
	
 
    <div class="container container-fluid">
		  <div class="row-fluid">
		  
		  
		    <div class="span3"> <!--begin span3 section-->
		    
		    <!--TO BE ADDED -->
		    <!--EDIT USER PAGE MODAL-->
		    <!--
			<div class="modal hide" id="myModal">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal">×</button>
			    <h3>Modal header</h3>
			  </div>
			  <div class="modal-body">
			    <p>One fine body?</p>
			  </div>
			  <div class="modal-footer">
			    <a href="#" class="btn" data-dismiss="modal">Close</a>
			    <a href="#" class="btn btn-primary">Save changes</a>
			  </div>
			</div>
			-->

		    
		    
		    
		    
		      <!--Sidebar content-->
		      
		      	<a href="#" class="thumbnail"><img src="<? echo PathToPic($profile[$thisuser]["profilepic"]); ?>"></a>
		      	
		        <h1 class="lead"> <b><? echo $profile[$thisuser]["fullname"]; ?></b></h1>
		        
		        <!-- I dont think we should leave this in here:
		        <h3><small>All the best about UW Bothell, according to <? echo $profile[$thisuser]['firstname']; ?>.</small></h3></h1>
		        -->
		      	
	            <!--ABOUT-->
	            <section id="#about" class="well">
	            
		            <strong>About</strong>
		            <p> <? echo $profile[$thisuser]['about']; ?></p>
		           
		            <strong>Social reach:  </strong> <br><span class="badge badge-warning"><? echo round(getKloutScore($thisuser)); ?> </span><small> &nbsp  via <a href="http://klout.com/home">Klout</a></small></p> 
		            <p><strong>Age: </strong>18</p>
		            <p><strong>Contact info: </strong> <br><? echo $profile[$thisuser]['contact']; ?></p>
		            <a href="/options#personal" type="edit" class="btn"><i class="icon-edit"></i> Edit</a>
		   
		    			
		            <!--<a class="btn" data-toggle="modal" href="#myModal" ><i class="icon-edit"></i> Edit</a>-->
		        
		        </section>
	            
	            <!--Favorites-->
	            <section id="#favorites" class="well">
		            <h2>Favorite</h2>
		            <strong>Professors</strong>
					<p><? echo $profile[$thisuser]['favorite-profs']; ?></p>
		            <strong>Food</strong>
					<p><? echo $profile[$thisuser]['favorite-foods']; ?></p>
					<strong>Music</strong>
					<p><? echo $profile[$thisuser]['favorite-music']; ?></p>
					<strong>Application</strong>
					<p><? echo $profile[$thisuser]['favorite-app']; ?></p>

					<a href="/options#favorites" type="edit" class="btn"><i class="icon-edit"></i> Edit</a>
	            </section>
	             
				<!--HOW I SEE IT-->
				<section id="#howISeeIt" class="well">
					<h2>How I see it...</h2>
		            <strong>Price of tuition</strong>
					<p><? echo $profile[$thisuser]['howiseeit']; ?></p>
					<a href="/options#howISeeIt" type="edit" class="btn"><i class="icon-edit"></i> Edit</a>
				</section>
				
				<!--CALENDAR-->
				<section id="#calendar" class="well">
					<h2>My schedule...</h2>
					<small>Click to see my personal calendar</small>
					<a href="/calendar"> <img src="/img/calendar.png"></a>
				</section>
	            
	            
		    </div> <!-- ends span3 section -->
		    
		    <div class="span9"> <!--Referenced span9 begin -->
		      <!--Body content-->
		     			
	  			<!--RECENT POSTS BAR -->
		  		
		          <div class="navbar navbar-static ">
		            <div class="navbar-inner ">
		              <div class="container-fluid"> <!--container keeps the whole area black -->
		                <a class="brand" href="#">Recent posts</a>
		              </div>
		            </div>
		          </div>
				  
				  <!--TEXT POSTS-->
				  <div class="span4">
				  
				  			<!--POST BUTTON-->
				  			
					  			<form action="/post" method="POST" class="">
							       	<? $_SESSION['posttoken'] = uniqid(); echo "<input type=\"hidden\" name=\"token\" value=\"".$_SESSION['posttoken']."\" />\n"; ?>
							       	<textarea type="text" id="textarea" class="span4" rows="3" placeholder="What's new?" name="text" data-provide="typeahead" data-source='["#AmplifyUWB","#AmplifyUW","#FreeFood","University of Washington Bothell","University of Washington","Washington","Bothell"]'></textarea>
							       	
							       		<button type="submit" class="btn btn-primary" ><i class="icon-edit"></i> Amplify</button>
							       
						       	</form>
				  			
				  			
					       	<!--RECENT POSTS-->
					       	<br>
					       	<div class="well">
						       	<? foreach(postsfrom(profile($thisuser),0,10) as $post) { ?>
				          		<p><id="tweet1"><a href="/user/<? echo $profile[$thisuser]['username']; ?>"><? echo $profile[$thisuser]['fullname']; ?></a>
				          			<small>@<a href="/user/<? echo $profile[$thisuser]['username']; ?>"></a>
				                <? echo $profile[$thisuser]['username']; ?></small><br>
				            	
				 			 	<p> <id="tweet1"><? echo linkify($post['text']); ?> <br>
				            	<i><small>View this post on </i> <a href="<? echo $post['sourcelink']."\">".$post['source'] ?></a> <b> - </b> <? echo $post['time']; ?></small><hr></p><br> <? } ?>
			            	</div>
				  </div> <!--end TEXT POSTS -->
				  
				  
							  <!-- PICTURE POSTS -->
							  <div class="span4 well">
							  	  <p class="lead"><? echo $profile[$thisuser]['firstname']; ?>'s latest photos</p>
							  	  
							  	  
			
			<form action="/photos" method="post" enctype="multipart/form-data">
			Want to share a new picture? <br><input type="file" name="pictures[]" multiple="true" id="uploadbox" title="Just a tip..." data-content="Pressing <b>ctrl</b> (PC) or <b>command</b> (Mac) will allow you to select multiple images to upload."/>
			<button class="btn btn-success" type="submit"><i class="icon-upload"></i> Upload</button>
			<hr>
			</form>				  	  
							  	  <div id="recentPics"> <!--id must be here for it to move to next photo-->
			       

						     <!--RECENT PICTURES -->
				 
						     
							     <ul class="thumbnails">


                                                                    <?
                                                                      foreach(picsfromuser($thisuser,3) as $picture) {?>
							              <li class="span2"><a href="javascript: void(0);" class="thumbnail">
                                                                           <img src="<? echo resize("/userdata/".$picture['uploader']."/photos/".$picture['filename'],array("scale"=>true,"w"=>400)); ?>">
                                                                          </a>
                                                                      </li><? } ?>
							      </ul>
						    
						      
						      <a class="pull-right" href="/photos" > View all </a>
	  		
						     
				  </div> <!--end picture posts -->			       
			       
		    </div> <!--ends span9 -->
		    
		  </div> <!--Ends row fluid-->
	 </div> <!--ends container fluid -->
	  
	           
    
    <? require_once("$base/footer.inc.php");?>
    
    
    
    <!-- OLD LEGACY STUFF
    						  	
	  	<!--CAROUSEL DISPLAY
	  <p class="lead">Latest photos</p>
      <div id="recentPics" class="carousel slide"> <!--id must be here for it to move to next photo
       
            <div class="carousel-inner">
	              <? $active = TRUE; foreach(picsfromuser($thisuser,3) as $picture) {?>
	              <div class="item<? if($active) {$active = FALSE; echo " active";} ?>">
	                <center><img src="<? echo resize("/userdata/".$picture['uploader']."/photos/".$picture['filename'],array("scale"=>true,"w"=>400)); ?>" width="300" class="hoverZoomLink"></center></div><? } ?>
            </div>
           
            <a class="left carousel-control" href="#recentPics" data-slide="prev">‹</a>
            <a class="right carousel-control" href="#recentPics" data-slide="next">›</a>
      </div>
      --> 

