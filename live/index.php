<?
include("/var/amplify/analytics.php");
$data = json_decode(file_get_contents("https://search.twitter.com/search.json?q=amplifyuw&q=uw"));
foreach($data->results as $tweet) {
 echo "<a href=\"https://twitter.com/".$tweet->from_user."\">@".$tweet->from_user."</a>: ".$tweet->text."<br />\n";
}
?>
<pre>
<? print_r($data); ?>
</pre>
