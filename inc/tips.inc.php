<?
require_once("$base/inc/userfunctions.inc.php");
function save($category, $title, $body)
 {
 global $profile,$sql;
 $out = array("status"=>1);
 if(!isset($_SESSION['user']))
  {
  $out['status'] = 3;
  }
 if($category < 0 || $category > 7)
  {
  $out['status'] = 2;
  $out['category-error'] = "Invalid category";
  }
 if(strlen($title) > 100)
  {
  $out['status'] = 2;
  $out['title-error'] = "Please keep this under 100 characters";
  }
 if(strlen($body) > 500)
  {
  $out['status'] = 2;
  $out['body-error'] = "Please keep this under 500 characters";
  }
 if($out['status'] == 1)
  {
  profile($_SESSION['user']);
  $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
  $query = $db->prepare("INSERT INTO `".$sql['db']."`.`tips`(`user`,`category`,`title`,`body`) VALUES (?,?,?,?)");
  $query->bind_param("iiss",$profile[$_SESSION['user']]['id'],$category,$title,$body);
  $query->execute();
  $query->close();
  $db->close();
  }
 return $out;
 }

function displayTips($category=0,$startat=0,$limit=10)
 {
 global $sql,$profile;
 $categories = array("All","Food & Drink","Classroom","Living","Commuting","Tech Tips","El Cheapo");
 echo "<ul>";
 $query = "SELECT * FROM `".$sql['db']."`.`tips` ORDER BY  `tips`.`added` DESC  LIMIT $startat, ". ($startat + $limit);
 if($category != 0) {$query = "SELECT * FROM `".$sql['db']."`.`tips` WHERE `category` = ".strval($category)." ORDER BY  `tips`.`added` DESC  LIMIT $startat,".($startat + $limit);}
 $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
 $results = $db->query($query);
 while($row = $results->fetch_array(MYSQLI_ASSOC)) {
  $id = $row['id'];
  profile(intval($row['user']));
  $user = $profile[intval($row['user'])];
  $time = $row['added'];
  $category = $categories[$row['category']];
  $title = $row['title'];
  $body = linkify($row['body']);
  print "<div class=\"span6\">\n<h3>$title</h3>by <a href=\"/user/".$user['username']."\">".$user['fullname']."</a> on <small>".$time."</small><br />\n<p>$body</p>\n</div>";
 }
 $results->close();
 $db->close(); 
 echo "</ul>";
 }
