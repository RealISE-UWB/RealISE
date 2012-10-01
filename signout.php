<?
require "inc/settings.php";
require "$base/inc/session.php";
$_SESSION['user'] = null;
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>AmplifyUW</title>
     <? include("inc/header.php"); ?>
  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">


    <? require "$base/inc/navbar.php"; ?>


    <div class="container">

<!-- Masthead
================================================== -->
<header class="jumbotron masthead">
  <div class="inner">
    <h1>Signed out</h1>
    <p>come back soon!</p>
  </div>

  
</header>
<? require "$base/footer.inc.php"; ?>
