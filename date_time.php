<?php function date_list(){ 
global $wpdb;

$table1 = $wpdb->prefix . 'iggamelist';	

  if(!empty($_REQUEST['edit_id'])):	
    $edit_rec= $wpdb->get_results(
	  "SELECT * FROM $table1 where id='".$_REQUEST['edit_id']."'"
	 );
	  $exp_date = explode("-",$edit_rec[0]->date); 
  endif;
   
 ?>
<select name="day">
	<?php for($day=1; $day <= 31; ++$day):?>
		<?php 
                
		if($day < 10)
		{
			$day = "0".$day;
		}
	
	    if($exp_date[0]==$day) {

			 $sel="selected=selected";
	    }
		else {
			
			$sel="";
		}
		
		?>
		<option value="<?php echo $day?>" <?php echo  $sel;?>><?php echo $day?></option>
	<?php endfor;?>
</select>
<select name="month">
	<?php for($month=1; $month <= 12; ++$month):?>
		<?php 
                
		if($month < 10)
		{
			$month = "0".$month;
		}
		
		if($exp_date[1]==$month) {

			 $sel="selected=selected";
	    }
		else {
			
			$sel="";
		}
		
		?>
		<option value="<?php echo $month?>" <?php echo  $sel;?>><?php echo $month?></option>
	<?php endfor;?>
</select>
<select name="year">
	<?php 

	$year = date("Y");
       
	for ($i = 0; $i <= 60; ++$i)
	{
		if($exp_date[2]==$year) {

			 $sel="selected=selected";
	    }
		else {
			
			$sel="";
		}
		
		echo "<option  value=".$year." ".$sel." >$year</option>"; ++$year;
	}
	?>
</select>

<?php }?>
<?php function time_list(){

global $wpdb;
$table1 = $wpdb->prefix . 'iggamelist';	

  if(!empty($_REQUEST['edit_id'])):	
    $edit_rec= $wpdb->get_results(
	  "SELECT * FROM $table1 where id='".$_REQUEST['edit_id']."'"
	 );
   $exp_time = explode("-",$edit_rec[0]->time); 		 
  endif;

	?>
	
<select name="gamehour">
	<?php for($hour=0; $hour <= 12; ++$hour):?>
	<?php if($hour < 10)
		{
			$hour = "0".$hour;
		}
	
      if($exp_time[0]==$hour) {

			 $sel="selected=selected";
	    }
		else {
			
			$sel="";
		}	
		
     ?>		
			<option value="<?php echo $hour?>" <?php echo $sel;?> ><?php echo $hour?></option>
	<?php endfor;?>
</select>
<select name="gamemin">
	<?php for($min=0; $min <= 59; ++$min):?>
	<?php if($min < 10)
		{
			$min = "0".$min;
		}
		
		if($exp_time[1]==$min) {

			 $sel="selected=selected";
	    }
		else {
			
			$sel="";
		}	
		
		
     ?>		
			<option value="<?php echo $min?>" <?php echo $sel;?>><?php echo $min?></option>
	<?php endfor;?>
</select>

<?php
        if(!empty($exp_time[2]) && $exp_time[2]=='am') {$sel="selected=selected";} else  { $sel=""; }	
	    if(!empty($exp_time[2]) && $exp_time[2]=='pm') {$sel1="selected=selected";} else { $sel1=""; }	
?>
<select name="ampm">
	<option value="am" <?php echo $sel;?>>AM</option>
	<option value="pm" <?php echo $sel1;?>>PM</option>
</select>	
	
	
<?php }?>

<?php
function tz_list() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['zone'] = $zone;
    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}
?>

<?php
function timezone_drop(){
global $wpdb;
$table1 = $wpdb->prefix . 'iggamelist';	

  if(!empty($_REQUEST['edit_id'])):	
    $edit_rec= $wpdb->get_results(
	  "SELECT * FROM $table1 where id='".$_REQUEST['edit_id']."'"
	 );
	 $exp_timezone = $edit_rec[0]->timezone;  
  endif;

		
	?>
	<select name="timezone">
    <option value="0">Please, select timezone</option>
    <?php foreach(tz_list() as $t) { 
	    if($exp_timezone==$t['zone']) {
			 $sel="selected=selected";
	    }
		else {
         	$sel="";
		}	
	?>
      <option value="<?php print $t['zone'] ?>" <?php echo $sel;?>>
        <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
      </option>
    <?php } ?>
	
     </select>			

<?php }?>		


<?php function game_duration(){

global $wpdb;
$table1 = $wpdb->prefix . 'iggamelist';	

  if(!empty($_REQUEST['edit_id'])):	
    $edit_rec= $wpdb->get_results(
	  "SELECT * FROM $table1 where id='".$_REQUEST['edit_id']."'"
	 );
   $exp_time = explode("-",$edit_rec[0]->gameduration); 		 
  endif;
	?>
	
<select name="gd_hour">
	<?php for($hour=0; $hour <= 12; ++$hour):?>
	<?php if($hour < 10)
		{
			$hour = "0".$hour;
		}
	
      if($exp_time[0]==$hour) {

			 $sel="selected=selected";
	    }
		else {
			
			$sel="";
		}	
		
     ?>		
			<option value="<?php echo $hour?>" <?php echo $sel;?> ><?php echo $hour?></option>
	<?php endfor;?>
</select>
<select name="gd_min">
	<?php for($min=0; $min <= 59; ++$min):?>
	<?php if($min < 10)
		{
			$min = "0".$min;
		}
		
		if($exp_time[1]==$min) {
			$sel="selected=selected";
	    }
		else {
			$sel="";
		}	
		
		
     ?>		
			<option value="<?php echo $min?>" <?php echo $sel;?>><?php echo $min?></option>
	<?php endfor;?>
</select>
	
<?php }?>
	