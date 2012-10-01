<?
session_start();
require_once("inc/settings.inc.php");
require_once("$base/inc/userfunctions.inc.php");
require_once("$base/inc/pics.inc.php");
require_once("$base/inc/resize.inc.php");
?>
<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="utf-8">
    <title>the Feed</title>
     <? require("inc/header.inc.php"); ?>
  </head>

  <body>
  <div id="fb-root"></div>

    <? require("$base/inc/navbar.inc.php"); ?>
    
      
    <!--
    	<div class="alert alert-error" style="text-align:center">
		    <button class="close" data-dismiss="alert alert-error">X</button>
		    This page is being worked on by Josh. I will get back to it later today...
		</div>
    -->
    
    
    
    <div class="container container-fluid">
    
    	<header class="jumbotron subhead page-header">
		 	<h1>the Feed</h1>
		 	<p class="lead">The latest about UW Bothell, according to you.</p>
		 </header>

    
      <div class="row-fluid">
        <div class="span3">
        
        	<!--POST BUTTON-->
  			<form action="/post" method="POST" class="">
  				<div class="lead">
  				Share something.
  				
			       	<? $_SESSION['posttoken'] = uniqid(); echo "<input type=\"hidden\" name=\"token\" value=\"".$_SESSION['posttoken']."\" />\n"; ?>
			       	<textarea type="text" id="textarea" rows="3" class="span3" placeholder="What's new?" name="text" data-provide="typeahead" data-source='["#AmplifyUWB","#AmplifyUW","#FreeFood","University of Washington Bothell","University of Washington","Washington","Bothell"]'></textarea>
			       	
			       		<button type="submit" class="btn btn-primary" ><i class="icon-edit"></i> Amplify</button>
  				</div>
		       
	       	</form>
        
        
          <div class="well sidebar-nav">
            <ul class="nav nav-list jumbotron subhead">
            <? if(isset($_SESSION['user'])) { ?>
            <!--<h2>hello <? echo $profile[$_SESSION['user']]['firstname']; ?>.</h2>-->
            <!--This will be added to out "how Amplify works" page
            <p>Everything with a <b>#AmplifyUWB</b> will show up here. So go ahead, post anything anywhere. Amplify is about giving you a voice, Amplify<strong>YOU</strong>. </p> -->
            <? } else { ?>
                <h2><a href="/signin">Sign in or Sign Up</a></h2>
                <p>to join the conversation</p>
            <? } ?>
              <br>
              <li class="nav-header">Trending Topics</li>
              <li><a href="#freefood">#freefood</a></li>
              <li><a href="#ihatefinals">#ihatefinals</a></li>
              <li><a href="#springbreak">#springbreak</a></li>
    		  <li><a href="#css162ishard">#css162ishard</a></li>
              <li class="nav-header">Most Active Users</li>
              <li><a href="/user/brunnerjosh">@brunnerjosh</a></li>
              <li><a href="/user/thefinn93">@thefinn93</a></li>
              <li><a href="/user/drewstone">@drewstone</a></li>
              <li><a href="/user/jappleseed">@jappleseed</a></li>
              <li><a href="/user/frankstutevoss">@frankstutevoss</a></li>
              <li><a href="/user/cchan">@cchan</a></li>

            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
        <div class="span4">
		
        <div class="hero">
		          
         <!--RECENT POSTS -->
          
			<div class="well" data-spy="scroll" data-target="#navbarExample" data-offset="0" >
				<p class="lead page-header"><b>Recent posts</b></p>

					
			
          		<? foreach(posts() as $post) { profile(intval($post['user'])); ?>
          		
          		<p><id="tweet1"><?
                          if($profile[intval($post['user'])]['fullname'] == "") { ?>Anonymous<?
                           } else { ?><a href="/user/<? echo $profile[intval($post['user'])]['username']; ?>"><? echo $profile[intval($post['user'])]['fullname']; ?></a><? } ?>
          			<small>@<a href="/user/<? echo $profile[intval($post['user'])]['username']; ?>"></a>
                                 <? echo $profile[intval($post['user'])]['username']; ?></small><br>
            	<id="tweet1"><? echo linkify($post['text'],$post['source']); ?> <br>
            	<i><small><? if($post['source'] != "Amplify") { ?>View this post on </i> <a href="<? echo $post['sourcelink']."\">".$post['source'] ?></a> <b> - </b> <? } echo $post['time']; ?>  </small><hr class="soften">
            
            	<!-- Twitter post button   
            	<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://makeapageforeachlinktopostto.com" data-via="brunnerjosh">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				
				<!-- Facebook Like button 
				<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.google.com&amp;send=false&amp;layout=button_count&amp;width=300&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=168382456576167" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:21px;" allowTransparency="true"></iframe> -->
				
				
           		<? } ?>
           
          	</div>
          
          </div>
         
        </div><!--/span-->
    	         
    	         
            <!-- PHOTOS -->
    <div class="row">
    <div class="span4 well">
      <p class="lead page-header"><b>Latest photos</b></p>
      
      <form action="/photos" method="post" enctype="multipart/form-data">
		Want to share a new picture? <br><input type="file" name="pictures[]" multiple="true" id="uploadbox" title="Just a tip..." data-content="Pressing <b>ctrl</b> (PC) or <b>command</b> (Mac) will allow you to select multiple images to upload."/>
		<button class="btn btn-success" type="submit"><i class="icon-upload"></i> Upload</button>
		<hr>
	</form>	
      
      <ul class="thumbnails">
      <?
       foreach(picsfromuser("") as $picture)
        {
         profile(intval($picture['uploader']));
         $path = resize("/userdata/".$picture['uploader']."/photos/".$picture['filename'],array("scale"=>true,"w"=>250, "h"=>90));
         echo "<li class=\"span2\">\n<a href=\"/photos/".$profile[intval($picture['uploader'])]['username']."/".$picture['id']."\" class=\"thumbnail\"><img src=\"$path\"/>\n</a>\n</li>";
 }
      ?>
    
      </ul>
       <a class="pull-right" href="/photos" > View all </a>

      
    </div>
    </div>
           

    </div><!--/.fluid-container-->
    
    
    
        	<!-- <i><img src="/img/feed_logo_v2.png" alt=""></i> -->

    
    <!-- LEGACY STUFF
    
    
     <!-- OLD BLACK BAR
          <div id="navbarExample" class="navbar navbar-static">
            <div class="navbar-inner">
              <div class="container-fluid">
                <a class="brand" href="#">#AmplifyUWB</a>
                	<ul class="nav">
                	<li><a href="#freefood">#freefood</a></li>
                  	<li><a href="#ihatefinals">#ihatefinals</a></li>
                  	<li><a href="##springbreak">#springbreak</a></li>
                  	<li><a href="#css162ishard">#css162ishard</a></li>
                	</ul>
              	</div>
            	</div>
         	 </div> 
         	 
       		<!-- RECENT POSTS BAR
				<div class="columns">          
		          <div id="navbarExample" class="navbar navbar-static">
		            <div class="navbar-inner">
		              <div class="container" style="width: auto;">
		                <a class="brand" href="#">Recent posts</a>
		                
		                  </li>
		                </ul>
		              </div>
		            </div>
		          </div>
		       </div>  	 
         	 
         	 -->
    <? require_once("$base/footer.inc.php");?>

