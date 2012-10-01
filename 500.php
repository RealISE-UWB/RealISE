<?
include("/var/www/inc/settings.inc.php");
session_start()
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Error - 500</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<? echo $static; ?>/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<? echo $static; ?>/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<? echo $static; ?>/assets/css/docs.css" rel="stylesheet">
    <link href="<? echo $static; ?>/assets/js/google-code-prettify/prettify.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<? echo $static; ?>/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<? echo $static; ?>/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<? echo $static; ?>/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<? echo $static; ?>/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">


    <? include("$base/inc/navbar.inc.php"); ?>


    <div class="container">

<!-- Masthead
================================================== -->
<header class="hero-unit">
  <div class="inner">
    <h1>Well this is embarrassing...</h1>
    <p>It seems that a husky dog has gotten into our server room and went haywire! If you wouldn't mind <a href="mailto:support@amplifyuwb.com?subject=Server%20Error%20on%20<? echo $_SERVER['REQUEST_URI']; ?>">letting us know</a> what you were doing previously, we will do our best fix this as soon as possible.</p>
     </div>

  
</header>
<? include("$base/footer.inc.php"); ?>
