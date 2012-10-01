<?
include("/var/www/inc/sqlcredentials.php");

$mysqli = new mysqli($sqlhost, $sqluser, $sqlpass, $sqldb);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Translate a twitter handle to an amplify UID
function lookupuser($from,$user,$db) {
    $out = "noap";
    if(!$res = $db->query("SELECT * FROM users WHERE `".$from."` = \"".$user->id."\"")) {
        die("Error: ".$mysqli->error);
    }
    if($res->num_rows == 1) {
        $res->data_seek(0);
        $row = $res->fetch_row();
        $out = $row[0];
    } elseif($res->num_rows == 0) {
        $result = $db->query("INSERT INTO users(`readname`,`created`,`facebook`) VALUES (\"".$user->name."\",NOW(),\"".$user->id."\")");
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
$facespace = json_decode(file_get_contents("https://graph.facebook.com/search?q=amplifyuwb"));
$user = null;
$text = null;
$source = null;
$sourcelink = null;
$time = null;

$add->bind_param("issss", $user, $text, $source, $sourcelink, $time);
foreach($facespace->data as $post) {
 $user = lookupuser("facebook",$post->from,$mysqli);
 $text = $post->message;
 $source = "twitter";
 $story_fbid=explode("_",$post->id,1);
 $sourcelink = "https://www.facebook.com/permalink.php?story_fbid=".$story_fbid[0]."&id=".$post->from->id;
 $time = date('Y-m-d H:i:s', strtotime($post->created_time));
 if(!postexists($source,$sourcelink,$mysqli)) {
     $add->execute();
    }
 }
$add->close();


