<?
include("/var/www/inc/sqlcredentials.php");

$mysqli = new mysqli($sqlhost, $sqluser, $sqlpass, $sqldb);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Translate a twitter handle to an amplify UID
function lookupuser($from,$user,$db) {
    $out = "noap";
    if(!$res = $db->query("SELECT * FROM users WHERE `".$from."` = \"".$user."\"")) {
        die("Error: ".$mysqli->error);
    }
    if($res->num_rows == 1) {
        $res->data_seek(0);
        $row = $res->fetch_row();
        $out = $row[0];
    } elseif($res->num_rows == 0) {
        $result = $db->query("INSERT INTO users(`username`,`created`,`twitter`) VALUES (\"".$user."\",NOW(),\"".$user."\")");
        $out = lookupuser($from,$user,$db);
    } else {
        die("Oh fuck, ".$res->num_rows." users with ".$from." id ".$user);
    }
    return $out;
}

// a function to check if an external post is already in the database
function postexists($source, $sourcelink,$db) {
    $out = false;
    if(!$res = $db->query("SELECT * FROM posts WHERE `source` = \"".$source."\" AND `sourcelink` = \"".$sourcelink."\"")) {
        die("Error: ".$db->error);
    }
    if($res->num_rows > 0) {
        $out = true;
    }
    return $out;
}

// prepare the add statement

$add = $mysqli->prepare("INSERT INTO posts(`user`, `text`, `source`, `sourcelink`, `time`) VALUES (?,?,?,?,?)");
$data = json_decode(file_get_contents("https://search.twitter.com/search.json?q=amplifyuw"));
$user = null;
$text = null;
$source = null;
$sourcelink = null;
$time = null;

$add->bind_param("issss", $user, $text, $source, $sourcelink, $time);
foreach($data->results as $tweet) {
 $user = lookupuser("twitter",$tweet->from_user,$mysqli);
 $text = $tweet->text;
 $source = "twitter";
 $sourcelink = "https://twitter.com/".$tweet->from_user."/status/".$tweet->id_str;
 $time = date('Y-m-d H:i:s', strtotime($tweet->created_at));
 if(!postexists($source,$sourcelink,$mysqli)) {
     $add->execute();
    }
 }
$add->close();

$add = $mysqli->prepare("INSERT INTO posts(`user`, `text`, `source`, `sourcelink`, `time`) VALUES (?,?,?,?,?)");
$data = json_decode(file_get_contents("https://search.twitter.com/search.json?q=amplifyuwb"));
$user = null;
$text = null;
$source = null;
$sourcelink = null;
$time = null;

$add->bind_param("issss", $user, $text, $source, $sourcelink, $time);
foreach($data->results as $tweet) {
 $user = lookupuser("twitter",$tweet->from_user,$mysqli);
 $text = $tweet->text;
 $source = "twitter";
 $sourcelink = "https://twitter.com/".$tweet->from_user."/status/".$tweet->id_str;
 $time = date('Y-m-d H:i:s', strtotime($tweet->created_at));
 if(!postexists($source,$sourcelink,$mysqli)) {
     $add->execute();
    }
 }
$add->close();


