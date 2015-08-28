<?php
function searchfilter(){
?>

<?php
global $wpdb;
$table_list = $wpdb->prefix . 'iggamelist';
$table_game = $wpdb->prefix . 'iggame';
$table_tour = $wpdb->prefix . 'igtour';	
$table_team = $wpdb->prefix . 'igteam';	

  $game_rec_s= $wpdb->get_results("SELECT * FROM $table_game");	
  $tour_rec_s= $wpdb->get_results("SELECT * FROM $table_tour");	
  $team_rec_s= $wpdb->get_results("SELECT * FROM $table_team");	

  
?>

<div class='match_container'>
<div class='match-title'><h1>Matches</h1></div>
<div class='search_match_options onerow'>
	<h2 class='search_title'>Reﬁne Search:</h2>

 <form name='searchform' action='#' method='post' enctype="multipart/form-data">	
 	<div class='myselect'>
	<select name='gamename'>
	<option value='blank'>Select Game</option>
	   <?php
   		for($i=0;$i<count($game_rec_s);$i++):
		?>
		<option value='<?php echo $game_rec_s[$i]->id;?>'><?php echo $game_rec_s[$i]->name;?>
		</option><?php endfor;?>
	</select>
	</div>		
	<div class='myselect'>
   <select name='tourname'>
	<option value='blank'>Select Tournament</option>
   <?php
  
		for($i=0;$i<count($tour_rec_s);$i++):
		?><option value='<?php echo $tour_rec_s[$i]->id;?>'><?php echo $tour_rec_s[$i]->name;?></option>
  <?php endfor;?>
   </select>
	</div>
	<div class='myselect'>
	
	<select name='teamname'>
	<option value='blank'>Select Team</option>
	 <?php
  		for($i=0;$i<count($team_rec_s);$i++):
		?><option value='<?php echo $team_rec_s[$i]->id;?>'><?php echo $team_rec_s[$i]->name;?></option><?php
		endfor;
	 ?>
	</select>
	</div>
	
	<div class='myselect'>

	<select name='monthname'>
	<option value='blank'>Select Month</option>
	<?php
	$months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
  		for($i=1;$i<=count($months);$i++):
		?><option value='<?php echo $i?>'><?php echo $months[$i]?></option><?php
		endfor;
	 ?>
	</select>
	</div>
	<div>
<input type='submit' name='sub' value='search'>
<input type='submit' name='showall' value='showall'>
</form>	
	</div>
</div>

<?php }
$all_in_one=array();
function esmatches($out) {
global $wpdb;
$filt="";
$table1 = $wpdb->prefix . 'iggamelist';
$table_game = $wpdb->prefix . 'iggame';
$table_tour = $wpdb->prefix . 'igtour';	
$table_team = $wpdb->prefix . 'igteam';	
$diff_time="";
$team_rec="";
  
if(!empty($_POST['gamename']) && $_POST['gamename']!='blank')
{

$team_rec= $wpdb->get_results(
  "SELECT * FROM $table1  where
       gamename=".$_POST['gamename']." 
       "
 );
 }
else if(!empty($_POST['tourname']) && $_POST['tourname']!='blank'){

$team_rec = $wpdb->get_results(
  "SELECT * FROM $table1  where
       tournamentname=".$_POST['tourname']." 
       "
 );	
 
}
else if(!empty($_POST['teamname']) && $_POST['teamname']!='blank'){

$team_rec = $wpdb->get_results(
  "SELECT * FROM $table1  where
	   FIND_IN_SET(".$_POST['teamname'].",teamvs);
       "
 );	
}

else if(!empty($_POST['monthname']) && $_POST['monthname']!='blank'){
	
$team_rec = $wpdb->get_results(
  "SELECT * FROM $table1  where
	   FIND_IN_SET(".$_POST['monthname'].",date);
       "
 );	
}

else if(is_user_logged_in()){
    $usid=get_current_user_id();
	$key = 'gamebox';
    $key_time = 'estimezone';
    $single = true;
    $user_last = get_user_meta( $usid, $key, $single );
	$user_timzone = get_user_meta( $usid,  $key_time, $single );

if($user_last!=""){
	
 $team_rec= $wpdb->get_results(
   
   "SELECT * FROM $table1  ORDER BY FIELD(gamename,".$user_last.") DESC"
 );

 
}
else{
$team_rec= $wpdb->get_results(
   "SELECT * FROM $table1  Order By STR_TO_DATE(`date`,'%d-%m-%Y'),STR_TO_DATE(`time`, '%h-%i-%p') ASC" 
	//"SELECT * FROM $table1"
 );	
	
}

}

else if(!empty($_POST['showall']) && $_POST['showall']!='blank'){
$team_rec= $wpdb->get_results(
  "SELECT * FROM $table1"
 );
}

else{
$team_rec= $wpdb->get_results(
	"SELECT * FROM $table1  Order By STR_TO_DATE(`date`,'%d-%m-%Y'),STR_TO_DATE(`time`, '%h-%i-%p') ASC"
	//"SELECT * FROM $table1"
 );
	
}
$out .=searchfilter();
$out .="
<table class='match_wrap_table'><tbody>";

$out .="<tr><th class='game_list'>Game</th><th class='tournament_list'>Tournament</th><th class='team_list'>Teams</th><th class='cnt_list'>Countdown</th><th class='matchlink_list'>Match Link</th></tr>";
echo "<pre>";
for($i=0;$i<count($team_rec);$i++):

     $expld_team[$i]= explode(",",$team_rec[$i]->teamvs);
     $date = new DateTime("now", new DateTimeZone($team_rec[$i]->timezone) );
	 //$date = new DateTime("now", new DateTimeZone('Asia/kolkata') );
	 //print_r($date);
	 $exp_time=explode("-",$team_rec[$i]->time);
	 $convert_time= $exp_time[0].":".$exp_time[1].$exp_time[2];
	 $merge_date=$team_rec[$i]->date." ".$convert_time;
	$currettime = strtotime($date->format('Y-m-d h.i.s A'));
	$compte_time = strtotime($merge_date);
	$match_duration=explode("-",$team_rec[$i]->gameduration);
	$md_cnt_time=$match_duration[0].":".$match_duration[1];
	$finish_hour=$exp_time[0]+$match_duration[0];
	$finish_minute=$exp_time[1]+$match_duration[1];
	$finish_time= $finish_hour.":".$finish_minute.$exp_time[2];
	//$finish_game=$team_rec[$i]->date." ".$finish_time;
	$finish_game=(strtotime($merge_date))+(60*60*$match_duration[0])+(60*$match_duration[1]);
	echo '<br>'.$finish_game.'<br>';
	echo strtotime($date->format('d-m-Y h.i.s A'));
	
	//print_r($match_duration);
	if($finish_game < strtotime($date->format('d-m-Y h.i.s A'))){
		
		 $diff_time="Passed"; 
	}
   else{	

   if(floatval($currettime - $compte_time) > 0){
			 $diff_time="live"; 
	  }
	  else{
	
	$diff_time= round(abs($currettime  - $compte_time) / 60,2);
	$ord_time=$diff_time;
	if($diff_time < 60 ){
			   $diff_time=$diff_time." minutes";
			}
	
	else if($diff_time > 60 && $diff_time < 1440){
	
			$hr=0;
     		$min=$diff_time;
			$hr=intval($min/60);
			$min=$min%60;
   			
				$diff_time= $hr.".".$min." hours";
			}
			else {
	
			$hr=0;
     		$min=$diff_time;
			$hr=intval($min/60);
			$min=$min%60;
   			
				$diff_time= round(($hr/24))." days";
			}
	  }
       
} 
	$game_rec= $wpdb->get_results(
	   "SELECT * FROM $table_game where id=".$team_rec[$i]->gamename.""
	 );
	 
	 $tour_rec= $wpdb->get_results(
	   "SELECT * FROM $table_tour where id=".$team_rec[$i]->tournamentname.""
	 );
 
	 $tem_rec1= $wpdb->get_results(
       "SELECT * FROM $table_team where id=".$expld_team[$i][0].""
	 );
	 $tem_rec2= $wpdb->get_results(
       "SELECT * FROM $table_team where id=".$expld_team[$i][1].""
	 );
	 $final_records=array_merge($game_rec,$tour_rec,$tem_rec1,$tem_rec2);
	 
	if($ord_time=="")
	{
		$final_records['cnt_dwn']=$diff_time;
	}
	else{
		$final_records['cnt_dwn']=$ord_time;
	}
	$final_records['game_link']=$team_rec[$i]->urlkey;
    print_r($final_records);
    
	//$final_records['game_url']=$team_rec[$i]->urlkey;
	//$final_records['game_rec']=$game_rec[0];
	//$final_records['tour_rec']=$tour_rec[0];
	//$final_records['tem_rec1']=$tem_rec1[0];
	//$final_records['tem_rec2']=$tem_rec2[0];
	//$final_rec[i]=$final_records;
	//print_r($final_records);
	//print_r($final_rec);
	
	$all_in_one[$i]=$final_records;
	//if($diff_time !== 'Passed')
	
endfor;



function sort_by_order($a,$b)
{
    return $a['cnt_dwn'] - $b['cnt_dwn'];
}
usort($all_in_one,'sort_by_order');
$j=0;
foreach($all_in_one as $one_record)
{
	$ord_time_status=$one_record['cnt_dwn'];
	if($ord_time_status < 60 ){
			   $ord_time_status=$ord_time_status." minutes";
			}
	
	else if($ord_time_status > 60 && $ord_time_status < 1440){
	
			$hr=0;
     		$min=$ord_time_status;
			$hr=intval($min/60);
			$min=$min%60;
   			
				$ord_time_status= $hr.".".$min." hours";
			}
			else {
	
			$hr=0;
     		$min=$ord_time_status;
			$hr=intval($min/60);
			$min=$min%60;
   			
				$ord_time_status= round(($hr/24))." days";
			}
	  if($one_record['cnt_dwn']=="live")
		{
			$ord_time_status='live';
		}
		elseif($one_record['cnt_dwn']=="Passed")
		{
			$ord_time_status='Passed';
		}
		
	if($ord_time_status!=='Passed')
	$out.="<tr class=".$one_record['cnt_dwn'].">
 	<td><img src=".$one_record[0]->image." style='max-width:50px; float:left;'>".$one_record[0]->name."</td>
	<td>".$one_record[1]->name."</td>
	<td>
    	<img src=".$one_record[2]->image." style='max-width:50px;float:left;'>".
     	$one_record[2]->name.' Vs '.$one_record[3]->name.
	  "<img src=".$one_record[3]->image." style='max-width:50px;float:right;'>
	</td>
	 <td>".$ord_time_status
	."</td>
	<td>
	<a href=".$one_record['game_link']." target='_blank'>
	  ".$one_record['game_link']."</td>
	
	</tr>";
	$j++;
}
$out .="</tbody></table>";
		
return $out;
}
add_shortcode( 'esmatches', 'esmatches' ); 

?>