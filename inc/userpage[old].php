<!--BEFORE CHANGES WERE MADE -->
<?
require_once("settings.php");
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
      require_once("$base/inc/header.php");
      require_once("$base/inc/pics.php");
    ?>
  </head>
    <? require_once("$base/inc/navbar.php"); ?>
    
    <div class="container-fluid">
		  <div class="row-fluid">
		    <div class="span2 well">
		      <!--Sidebar content-->
		    </div>
		    <div class="span10 well">
		      <!--Body content-->
		    </div>
		  </div>
	 </div>
    
    
    
    
    
    <div class="container-fluid">
      <div class="row">
        <div class="span3">
          <a href="#" class="thumbnail">
            <img src="<? echo PathToPic($profile[$thisuser]["profilepic"]); ?>" alt="">
          </a>
          <p>
          <h1><? echo $profile[$thisuser]["fullname"]; ?></h1>
          <h1 class="lead pull-right">All the best about UW Bothell, according to <? echo $profile[$thisuser]['firstname']; ?>.</h1>
          </p>
          <!--ABOUT USER -->
          <div class="control-group">
            <div class="controls">
              <strong>About</strong>
              <p> <? echo $profile[$thisuser]['about']; ?>

I will be majoring in Computer Science at the University of Washington. I am pursuing a career in the tech world not only becuase I love technology, but because that is where I believe I can impact the most people. While I thrive in projects that require teamwork and technique, I also know how to work alone.
 </p>
              <strong>Social reach:  </strong> <br><span class="badge badge-warning"><? echo round(getKloutScore($thisuser)); ?> </span><small> &nbsp  via <a href="http://klout.com/home">Klout</a></small></p> 
			  <p><strong>Age: </strong>18</p>
			  <p><strong>Contact info: </strong> <br><? echo $profile[$thisuser]['contact']; ?></p>
            <a href="/options#personal" type="edit" class="btn"><i class="icon-edit"></i> Edit</a>
            </div>
          </div></p></p>
          <hr>
          <!-- FAVORITES -->
          <div class="control-group">
            <div class="controls well">
              <h2>Favorites</h2>
              <strong>Professors</strong>
			  <p><? echo $profile[$thisuser]['favorites-profs']; ?></p>
              <strong>Food</strong>
			  <p><? echo $profile[$thisuser]['favorite-food']; ?></p>
			  <strong>Music</strong>
			  <p><? echo $profile[$thisuser]['favorite-music']; ?></p>
			  <a href="/options#favorites" type="edit" class="btn"><i class="icon-edit"></i> Edit</a>
            </div>
          </div></p></p>
          <hr>
          <!-- HOW I SEE IT -->
          <div class="control-group">
            <div class="controls well">
              <h2>How I see it...</h2>
              <strong>Price of tuition</strong>
			  <p><? echo $profile[$thisuser]['howISeeIt']; ?>
I think the price fo tuition at UW is going up way too much, way too quickly. I don't see how they can possibly charge so much for education. I mean sure, it IS education but how can they just assume that we can come up with 100 grand? I think that's rediculous! #thewayiseeit </p>
			  <a href="/options#howISeeIt" type="edit" class="btn"><i class="icon-edit"></i> Edit</a>
            </div>
          </div></p></p>
          <hr>
           <div class="control-group">
            <div class="controls well">
            <h2>My schedule...</h2>
            <small>Click to see my personal calendar</small>
              <a href="/calendar"> <img src="/img/calendar.png"></a>
            </div>
          </div></p></p>
         
          </div> <!-- end left column -->
          


        <div class="span9 columns">
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
       <div>
      
          
          <div class="well span4" data-spy="scroll" data-target="#navbarExample" data-offset="0" >
          <form action="/post" method="POST">
            <? $_SESSION['posttoken'] = uniqid(); echo "<input type=\"hidden\" name=\"token\" value=\"".$_SESSION['posttoken']."\" />\n"; ?>
            <input type="text" class="span3" id="textarea" style="margin: 0 auto;" placeholder="What do you want to amplify?" name="text" data-provide="typeahead" data-items="4" data-source='["#AmplifyUWB","#AmplifyUW","#FreeFood","University of Washington Bothell","University of Washington","Washington","Bothell"]'>
         	<button type="submit" class="btn btn-primary"><i class="icon-edit"></i> Amplify</button>
         	</form>
          		<? foreach(postsfrom(profile($thisuser),0,10) as $post) { ?>
          		<p><id="tweet1"><a href="/user/<? echo $profile[$thisuser]['username']; ?>"><? echo $profile[$thisuser]['fullname']; ?></a>
          			<small>@<a href="/user/<? echo $profile[$thisuser]['username']; ?>"></a>
                <? echo $profile[$thisuser]['username']; ?></small><br>
            	
 			 	<p> <id="tweet1"><? echo linkify($post['text']); ?> <br>
            	<i><small>View this post on </i> <a href="<? echo $post['sourcelink']."\">".$post['source'] ?></a> <b> - </b> <? echo $post['time']; ?></small><hr></p><br>
           		<? } ?>
          	</div>
          	
       
         <!-- PHOTOS -->
    <div class="row">
    <div class="span4 well">
      <p class="lead">Latest photos</p>
      <div id="recentPics" class="carousel slide">
            <div class="carousel-inner">
              <? $active = TRUE; foreach(picsfromuser($thisuser,3) as $picture) {?>
              <div class="item<? if($active) {$active = FALSE; echo " active";} ?>">
                <center><img src="/userdata/<? echo $picture['uploader']."/photos/".$picture['filename']; ?>" width="300" alt="" class="hoverZoomLink"></center>
              </div><? } ?>
            </div>
            <a class="left carousel-control" href="#recentPics" data-slide="prev">‹</a>
            <a class="right carousel-control" href="#recentPics" data-slide="next">›</a>
        </div>
        

      <ul class="thumbnails">
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/img/image-1.jpg" alt="">
          </a>
        </li>
		<li class="span2">
          <a href="#" class="thumbnail">
            <img src="/img/image-2.jpg" alt="">
          </a>
        </li>
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/img/image-3.jpg" alt="">
          </a>
        </li>
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/img/image-4.jpg" alt="">
          </a>
        </li>
		<li class="span2">
          <a href="#" class="thumbnail">
            <img src="/img/image-5.jpg" alt="">
          </a>
        </li>
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/img/image-6.jpg" alt="">
          </a>
        </li><li class="span2">
          <a href="#" class="thumbnail">
            <img src="/img/image-7.jpg" alt="">
          </a>
        </li>
		<li class="span2">
          <a href="#" class="thumbnail">
            <img src="/img/image-8.jpg" alt="">
          </a>
        </li>
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/img/image-9.jpg" alt="">
          </a>
        </li>
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/img/image-10.jpg" alt="">
          </a>
        </li>
      </ul>
       <a class="pull-right" href="/photos" > View all </a>

      
  
    </div>
    
    </div>
	
           
    
    <? require_once("$base/footer.php");?>

