<?
require_once("settings.inc.php");

// The following was ruthlessly stolen from http://davidwalsh.name/php-calendar
function draw_month($month,$year) {
  global $sql;
  /* draw table */
  $calendar = '<table class="table table-striped table-bordered table-condensed"">';

  /* table headings */
  $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
  $calendar.= "<thead>";
  $calendar.= '<tr class="calendar-row"><td class="calendar-day-head span2"><center>'.implode('</center></td><td class="calendar-day-head span2"><center>',$headings).'</td></tr>';
  $calendar.= "</thead>";
  
  $calendar.= "<tbody>";

  /* days and weeks vars now ... */
  $running_day = date('w',mktime(0,0,0,$month,1,$year));
  $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();

  /* row for week one */
  $calendar.= '<tr class="calendar-row">';

  /* print "blank" days until the first of the current week */
  for($x = 0; $x < $running_day; $x++):
    $calendar.= '<td class="calendar-day-np">&nbsp;</td>';
    $days_in_this_week++;
  endfor;

  /* keep going with days.... */
  for($list_day = 1; $list_day <= $days_in_month; $list_day++)
  {
      $calendar.= '<td class="calendar-day">';
      /* add in the day number */
      $calendar.= '<div class="day-number">'.$list_day.'</div>';
      $calendar.= "<ul>";
      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/

      $db = new mysqli($sql['host'], $sql['user'], $sql['password'], $sql['db']);
      $sql = "SELECT * FROM `".$sql['db']."`.`calendar` WHERE `year` = $year AND `month` = $month and `date` = $list_day";
      if(!$query = $db->query($sql)) {
          die("Error: ". $db->error);
      }
//    $res = $query->get_results();
      $out = array();
      while($row = $query->fetch_array(MYSQLI_ASSOC)) {
       $out[] = $row;
      }
      $query->close();
      $db->close();
      foreach($out as $value)
        {
        $calendar.= "<li />".$out['title'];
        }
      $calendar.="</ul>";




      $calendar.= str_repeat("<p>&nbsp</p>",2);
      
    $calendar.= '</td>';
    if($running_day == 6)
      {
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month)
        {
        $calendar.= '<tr class="calendar-row">';
        }
      $running_day = -1;
      $days_in_this_week = 0;
    }
    $days_in_this_week++; $running_day++; $day_counter++;
  }
  /* finish the rest of the days in the week */
  if($days_in_this_week < 8 && $days_in_this_week > 1)
   {
    for($x = 1; $x <= (8 - $days_in_this_week); $x++)
      {
      $calendar.= "<td class=\"calendar-day-np\">&nbsp</td>";
      }
  }
  /* final row */
  $calendar.= '</tr>';
  
  $calendar.= "</tbody>";

  /* end the table */
  $calendar.= '</table>';
  
  /* all done, return result */
  return $calendar;
}


?>
