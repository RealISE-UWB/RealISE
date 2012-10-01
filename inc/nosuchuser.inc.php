<?
session_start();
require_once("settings.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>No such user | AmplifyUW</title>
    <? require("$base/inc/header.inc.php"); ?>
  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">


   <? require("$base/inc/navbar.inc.php"); ?>


    <div class="container">

      <!-- Masthead
      ================================================== -->
      <header class="jumbotron subhead" id="overview">
        <h1>User not found</h1>
        <p class="lead">Sorry about that. Maybe try <a href="/search">searching</a>?.</p>
      </header>
<? require("$base/footer.inc.php"); ?>
