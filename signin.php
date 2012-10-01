<?
require_once("inc/settings.inc.php");
session_start(); 
require_once("$base/inc/login.inc.php");
require_once("$base/inc/nohax.inc.php");
global $result;
 if(isset($_POST['action'])) {
  if($_POST['action'] == "signin") {
   $result = login($_POST);
   if($result == "success") {
    if(!isset($_POST['dest'])) {
     header("Location: /");
    } else {
     header("Location: ".$_POST['dest']);
    }
   }   
  } elseif($_POST['action'] == "signup") {
   $result = signup($_POST);
   if($result == "success") {
    if(!$_POST['dest']) {
     header("Location: /");
    } else {
     header("Location: ".$_POST['dest']);
    }
   }
  }
 }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign In or Sign Up</title>
    <? include("$base/inc/header.inc.php"); ?>
  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">


    <? include("$base/inc/navbar.inc.php"); ?>


    <div class="container">

<!-- Masthead
================================================== -->
<header class="jumbotron subhead offset1" id="overview">
  <h1>Welcome back!</h1>
  <p class="lead">We've missed you!</p>
  <br>
</header>
<div class="row">

<div>

<div class="well offset1 span4">
	<h3 class="lead">Sign in</h3>
	<form action="/signin" method="POST">
	<? if(isset($result['signin'])) { ?><div class="alert alert-error"><? echo $result['signin']; ?></div><? } ?>
	<input type="hidden" name="action" value="signin" />
    <? maketoken("login"); ?>
	<input type="text" name="user" placeholder="Username" class="input-small span2"/>
	<input type="password" name="pass" placeholder="Password" class="input-small span2"/><br />
	<label class="checkbox">
	<input type="checkbox"> Remember me
	</label>
	<hr class="soften">
	<input type="submit" value="Log me in!" class="btn btn-large btn-info pull-right" />
	<? if(isset($result['signin-dbg'])) { ?><div class="alert alert-block"><pre><? print_r($result['signin-dbg']); ?></pre></div><? } ?>
	</form>
	</div>
</div>



<div class="well span4 pull-right">
<p class="lead">Sign up using </p>

<div class="btn-group">

  <button class="btn" ><a href="/oauth/twitter"> <img src="/img/twitter_t_logo_small.png" alt=""> </a></button>
  <button class="btn"><a a href="/oauth/facebook"><img src="/img/f_logo_small.png" alt=""> </a> </button>
  <button class="btn"><a href="/oauth/google"><img src="/img/google_small.png" alt=""></a></button>
  <button class="btn"><a href="/oauth/netid"><img src="/img/myuw.png" alt=""></a></button>
 
</div>

 <hr class="soften">
 
 <p class="lead">or create an account below </p>

<form action="/signin" method="POST">
<input type="hidden" name="dest" value="<? if(isset($_REQUEST['dest'])) {echo $_REQUEST['dest'];} else {echo "/";} ?>" />
<input type="hidden" name="action" value="signup" />
<input type="text" name="user" placeholder="Username" class="input-small" <? if(isset($result['signup-user'])) {echo "value=\"".$result['signup-user']."\"";} ?> /><br />
<? if(isset($result['signup-user-error'])) { ?><div class="alert alert-error"><? echo $result['signup-user-error']; ?></div><? } ?>
<input type="password" name="pass" placeholder="Password" class="input-small" <? if(isset($result['signup-pass'])) {echo "value=\"".$result['signup-pass']."\"";} ?>/><br />
<? if(isset($result['signup-pass-error'])) { ?><div class="alert alert-error"><? echo $result['signup-pass-error']; ?></div><? } ?>
<input type="password" name="confirm" placeholder="Confirm" class="input-small" <? if(isset($result['signup-confirm'])) {echo "value=\"".$result['signup-confirm']."\"";} ?>/><br />
<? if(isset($result['signup-confirm-error'])) { ?><div class="alert alert-error"><? echo $result['signup-confirm-error']; ?></div><? } ?>
<input type="text" name="name" placeholder="Full Name" class="input-small" <? if(isset($result['signup-name'])) {echo "value=\"".$result['signup-name']."\"";} ?> /><br />
<? if(isset($result['signup-name-error'])) { ?><div class="alert alert-error"><? echo $result['signup-name-error']; ?></div><? } ?>
<input type="text" name="email" placeholder="Email" class="input-small" <? if(isset($result['signup-email'])) {echo "value=\"".$result['signup-email']."\"";} ?> /><br />
<? if(isset($result['signup-email-error'])) { ?><div class="alert alert-error"><? echo $result['signup-email-error']; ?></div><? } ?>
<? maketoken("signup"); ?>
<?
require_once("$base/inc/recaptchalib.inc.php");
$error = null;
if(isset($result['signup-captcha-error'])) {$error = $result['signup-captcha-error'];}
echo recaptcha_get_html($recaptcha['public'],$error,true);
?>

<label class="checkbox">
<br>
	<input type="checkbox"> You agree to our <a href="/toc">terms of service</a>.
	</label>
<input type="submit" value="Get started!" class="btn btn-large btn-success pull-right" />
</form>
</div>
</div>
</div>
</div>
<? require_once("$base/footer.inc.php");?>
