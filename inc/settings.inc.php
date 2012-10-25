<?
// Sample config file, using our uni for examples of how to fill in the names.
global $sqluser,$sqlpass,$sqldb,$sqlhost,$school,$base,$static,$twitter,$recaptcha,$facebook,$sql,$kloutkey;
$school = array("name" => "University of Washington | Bothell", "short" => "UW Bothell", "acronym" => "UWB");
$static = ""; # the path to static content, eventually should be it's own domain or subdomain, so we can CDN it

$base = "/Users/brunnerjosh/RealISE/";    // Path on disk to the www root that RealISE is hosted at.

$sql = array("user" => "realise",   // SQL username
    "password" => "hunter11",       // SQL password
    "db" => "realise",              // SQL database name
    "host" => "localhost");         // SQL host

// Make a Twitter app at https://dev.twitter.com/apps
$twitter = array("consumerKey" => "4lBcuM5VdB9F6aVGtdwoiA","consumerSecret" => "vjTp4eSCe29RfjNa1Q3Gzb3PJqWTMahA6mdwpJjCO44");

// Get a set of API keys from 
$recaptcha = array("public" => "6LfWgNESAAAAANLYtb90MtaUScCkCrzINQ_-00mX", "private" => "6LfWgNESAAAAAMOi9KLdz6Yna-scAnWhLb5K5JKh");

// Get a set of API keys from 
$facebook = array("redirect_url"=>"https://www.amplifyuwb.com/oauth/facebook", "appid"=>"327422427294227","secret"=>"5e907b7494c505ac3ff69daf013e421c");

// Get an API key from 
$kloutkey = "kum387kt989s3xc59tmuxs5t";
