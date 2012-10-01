<?
function save_settings($in)
 {
 global $sql,$profile;
 $error = array();
 $error['status'] = 1;
 if(strlen($in['name']) > 100)
  {
  $error['status'] = 2;
  $error['name'] = "Please shorten this to 100 characters";
  }
 elseif(strlen($in['name']) < 1 && $in['name'] != " ")
  {
  $error['status'] = 2;
  $error['name'] = "Please provide your name";
  }
 if(strlen($in['about']) > 300)
  {
  $error['status'] = 2;
  $error['about'] = "Please keep this under 300 characters";
  }
  if(strlen($in['contact']) > 300)
  {
  $error['status'] = 2;
  $error['contact'] = "Please keep this under 300 characters";
  }
 if(strlen($in['favorite-profs']) > 300)
  {
  $error['status'] = 2;
  $error['favorite-profs'] = "Please keep this under 300 characters";
  }
 if(strlen($in['favorite-foods']) > 300)
  {
  $error['status'] = 2;
  $error['favorite-foods'] = "Please keep this under 300 characters";
  }
 if(strlen($in['favorite-music']) > 300)
  {
  $error['status'] = 2;
  $error['favorite-music'] = "Please keep this under 300 characters";
  }
 if(strlen($in['howiseeit']) > 500)
  {
  $error['status'] = 2;
  $error['howiseeit'] = "Please keep this under 500 characters";
  }
 if($error['status'] == 1)
  {
  $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
  $update = $db->prepare("UPDATE `".$sql['db']."`.`users` SET `aboutme` = ?, `contact` = ?, `favorite-profs` = ?, `favorite-foods` = ?, `favorite-music` = ?, `howiseeit` = ? WHERE `users`.`id` = ?");
  $update->bind_param("ssssssi",$in['about'],$in['contact'],$in['favorite-profs'],$in['favorite-foods'],$in['favorite-music'],$in['howiseeit'], $profile[$_SESSION['user']]['id']);
  if(!$update->execute())
      {die("Executing SQL failed: (" . $db->errno . ") " . $db->error);}
  $update->close();
  $db->close();
  }
 unset($profile[$_SESSION['user']]);
 profile($_SESSION['user']);
 return $error;
 }
