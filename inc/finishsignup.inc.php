<?
require "inc/settings.inc.php";
require "$base/inc/login.inc.php";
require_once("$base/inc/nohax.inc.php");
$creds = "";
$username = "";
$name = "";
$email = "";
if($_SESSION['signedinwith'] == "twitter")
 {
 $t = new EpiTwitter($twitter['consumerKey'], $twitter['consumerSecret'], $_SESSION['twitter_oauth_token'],$_SESSION['twitter_oauth_token_secret']);
 $creds = $t->get('/account/verify_credentials.json');
 $username = $creds['screen_name'];
 $name = $creds['name'];
 }
elseif($_SESSION['signedinwith'] == "facebook")
 {
 $creds = json_decode(file_get_contents("https://graph.facebook.com/me?".$_SESSION['facebook_token']));
 $username = $creds->username;
 $name = $creds->name;
 $email = $creds->email;
 }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Complete Signup</title>
    <? require "$base/inc/header.inc.php"; ?>
  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">


    <? require "$base/inc/navbar.inc.php"; ?>


    <div class="container">

<!-- Masthead
================================================== -->
<header class="jumbotron subhead" id="overview">
<h1>Almost done signin up!</h1>
<p class="lead">Just confirm a couple of things and set a password (if you want to)</p>
</header>
<div class="row">
<div class="span4">
<form action="/signin.php" method="POST">
<input type="hidden" name="dest" value="<? if(isset($_REQUEST['dest'])) {echo $_REQUEST['dest'];} else {echo "/";} ?>" />
<input type="hidden" name="action" value="signup" />
<input type="text" name="user" placeholder="Username" class="input-small" value="<? echo $username; ?>" /><br />
<? if(isset($result['signup-user-error'])) { ?><div class="alert alert-error"><? echo $result['signup-user-error']; ?></div><? } ?>
<input type="password" name="pass" placeholder="Password" class="input-small" <? if(isset($result['signup-pass'])) {echo "value=\"".$result['signup-pass']."\"";} ?>/> (optional)<br />
<? if(isset($result['signup-pass-error'])) { ?><div class="alert alert-error"><? echo $result['signup-pass-error']; ?></div><? } ?>
<input type="password" name="confirm" placeholder="Confirm" class="input-small" <? if(isset($result['signup-confirm'])) {echo "value=\"".$result['signup-confirm']."\"";} ?>/> (only if you put one in above)<br />
<? if(isset($result['signup-confirm-error'])) { ?><div class="alert alert-error"><? echo $result['signup-confirm-error']; ?></div><? } ?>
<hr />
<input type="text" name="name" placeholder="Full Name" class="input-small" value="<? echo $name;?>" /><br />
<? if(isset($result['signup-name-error'])) { ?><div class="alert alert-error"><? echo $result['signup-name-error']; ?></div><? } ?>
<input type="text" name="email" placeholder="Email" class="input-small" value="<? echo $email; ?>" /><br />
<? if(isset($result['signup-email-error'])) { ?><div class="alert alert-error"><? echo $result['signup-email-error']; ?></div><? } ?>
<?
require_once("$base/inc/recaptchalib.inc.php");
$error = null;
if(isset($result['signup-captcha-error'])) {$error = $result['signup-captcha-error'];}
echo recaptcha_get_html($recaptcha['public'],$error,true);
?><br />
<? maketoken("signup"); ?>
<input type="submit" value="Do it" class="btn btn-primary" />
</form>
</div>
<div class="span6 offset2"><pre><? print_r($creds); ?></pre></div>
</div>
<? require "$base/footer.php"; ?>
