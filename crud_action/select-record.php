<?php

function  active_tab($title){
if($title=$_REQUEST['link']){	
  echo "class=active-tab";	
}
}

function select_tour () {
global $wpdb;
$sel="";
$table1 = $wpdb->prefix . 'igtour';	
$tableedit = $wpdb->prefix . 'iggamelist';	
	global $wpdb;
	  $team_rec= $wpdb->get_results(
	 "SELECT * FROM $table1"
	);
	
  if(!empty($_REQUEST['edit_id'])):	
   $edit_rec= $wpdb->get_results(
	 "SELECT * FROM $tableedit where id='".$_REQUEST['edit_id']."'"
	);
  endif;
	
	
for($i=0;$i<count($team_rec);$i++):

 if(!empty($_REQUEST['edit_id'])):

    	if($edit_rec[0]->tournamentname==$team_rec[$i]->id) {

			 $sel="selected=selected";
	    }
		else {
			
			$sel="";
		}
	
  endif;	
	
  echo '<option value="'.$team_rec[$i]->id.'" '.$sel.'>'.$team_rec[$i]->name.'</option>';

endfor;

}

function select_game() {
global $wpdb;
$sel="";
$table1 = $wpdb->prefix . 'iggame';	
$tableedit = $wpdb->prefix . 'iggamelist';	
	global $wpdb;
	  $team_rec= $wpdb->get_results(
	 "SELECT * FROM $table1"
	);
  if(!empty($_REQUEST['edit_id'])):	
   $edit_rec= $wpdb->get_results(
	 "SELECT * FROM $tableedit where id='".$_REQUEST['edit_id']."'"
	);
  endif;

for($i=0;$i<count($team_rec);$i++):

     if(!empty($_REQUEST['edit_id'])):
    	if($edit_rec[0]->gamename==$team_rec[$i]->id) {

			 $sel="selected=selected";
	    }
		else {
			
			$sel="";
		}
	
   endif;
	
  echo '<option value="'.$team_rec[$i]->id.'" '.$sel.' >'.$team_rec[$i]->name.'</option>';

endfor;

}

function select_team ($teamName) {	
global $wpdb;
	$sel="";
	$sel2="";
	$table1 = $wpdb->prefix . 'igteam';	
	$tableedit = $wpdb->prefix . 'iggamelist';
	
	global $wpdb;
	$team_rec= $wpdb->get_results(
	"SELECT * FROM $table1"
	);
  
  if(!empty($_REQUEST['edit_id'])):	
   $edit_rec= $wpdb->get_results(
	 "SELECT * FROM $tableedit where id='".$_REQUEST['edit_id']."'"
	);
  endif;

	 
	if(!empty($edit_rec)){
	 $exp_st=explode(",",$edit_rec[0]->teamvs);
	}

for($i=0;$i<count($team_rec);$i++):
     if(!empty($_REQUEST['edit_id'])):
	    if($exp_st[0]==$team_rec[$i]->id){
			 $sel="selected=selected";
	    }
		else {
			$sel="";
		}
		if($exp_st[1]==$team_rec[$i]->id){
			 
			 $sel2="selected=selected";
	    }
		else {
	
			$sel2="";
		}
		
  endif;
  
if($teamName=="team1"){	
echo '<option  value="'.$team_rec[$i]->id.'" '.$sel.' >'.$team_rec[$i]->name.'</option>';
}
else{
echo '<option  value="'.$team_rec[$i]->id.'" '.$sel2.' >'.$team_rec[$i]->name.'</option>';
}

endfor;

}

function viewcomp(){

udpate_comp();
global $wpdb;
$filt="";
$table1 = $wpdb->prefix . 'iggamelist';
$table_game = $wpdb->prefix . 'iggame';
$table_tour = $wpdb->prefix . 'igtour';	
$table_team = $wpdb->prefix . 'igteam';	

	 global  $team_rec;
	 pagination("viewcomp",$table1); 
   
     
?>

<table class="TFtable">
<th>Game</th><th>Tournament</th><th>Teams</th><th>Match Time</th><th>Match Duration</th><th>URL Link</th>
<th colspan="2">Action</th>
<?php for($i=0;$i<count($team_rec);$i++):?>
 <?php
   
     $expld_team[$i]=explode(",",$team_rec[$i]->teamvs);

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
	

	 ?>
	<tr>
	<td><?php echo $game_rec[0]->name;?></td>
	<td><?php echo $tour_rec[0]->name;?></td>
	<td><?php echo $tem_rec1[0]->name.'/'.$tem_rec2[0]->name;?></td>
	<td><?php echo $team_rec[$i]->time;?></td>
	<td><?php echo $team_rec[$i]->gameduration;?> H</td>
	<td><?php echo $team_rec[$i]->urlkey;?></td>
	<td>
	<a href="
	options-general.php?page=igamezone.php&link=viewcomp&edit_id=<?php echo $team_rec[$i]->id;?>">Edit</a></td>
	<td>
		<a href="
	options-general.php?page=igamezone.php&link=viewcomp&del_id=<?php echo $team_rec[$i]->id;?>">Delete</a></td>
	</tr>
	<?php endfor;?>	
</table>	
<?php 
}
function edit_compete () {
	
global $wpdb;

$table1 = $wpdb->prefix .'iggamelist';	
if(isset($_POST["gamedrop"])) $gameName = $_POST["gamedrop"];
if(isset($_POST["tourdrop"])) $tournamentname =$_POST["tourdrop"];
if(isset($_POST["tourdrop1"]) &&  isset($_POST["tourdrop2"])) 
$teamVs = $_POST["tourdrop1"].'/'.$_POST["tourdrop2"];
if(isset($_POST["day"]) &&  isset($_POST["month"]) &&  isset($_POST["year"])) 
$matchDate = $_POST["day"].'-'.$_POST["month"].'-'.$_POST["year"];
if(isset($_POST["gamehour"]) &&  isset($_POST["gamemin"]) &&  isset($_POST["ampm"])) 
$matchTime = $_POST["gamehour"].'-'.$_POST["gamemin"].'-'.$_POST["ampm"];
if(isset($_POST["timezone"]))
$timeZone = $_POST["timezone"];
if(isset($_POST["url_key"]))
$urlKey = $_POST["url_key"];


if(isset($_POST["gd_hour"]) &&  isset($_POST["gd_min"])) 
$match_period = $_POST["gd_hour"].'-'.$_POST["gd_min"];
//insert
if(isset($_POST['game'])){
	global $wpdb;
	$wpdb->insert(
		$table1,
		array('gamename' => $gameName,'tournamentname' => $tournamentname,'teamvs' => $teamVs,
		'date'=>$matchDate,'time'=>$matchTime, 'timeZone'=>$timeZone, 'urlKey'=>$urlKey,'gameduration'=>$match_period
		), 
		 array('%s','%s','%s','%s','%s','%s','%s') 
	);
	
 }
}

function edit_view() {
	
 global $wpdb;
 $table1 = $wpdb->prefix . 'iggamelist';	
 
   if(!empty($_REQUEST['edit_id'])):	
   $hidden_edit_id=$_REQUEST['edit_id'];
     $edit_rec= $wpdb->get_results(
	  "SELECT * FROM $table1 where id='".$_REQUEST['edit_id']."'"
	 );
   endif;
      $exp_urlkey = $edit_rec[0]->urlkey;   
	
	?>
  <?php if(isset($_POST['comp-update'])){?>
    <div class="updated"><p><?php echo "Comp Updated";?></p></div> 
  <?php }?>

	<form name="teamfrm" action="options-general.php?page=igamezone.php&link=viewcomp" method="post" enctype="multipart/form-data">
	
		 <p><label>Game</label>
			<select name="gamedrop"> 
				<?php select_game (); ?>
			</select>
		 </p>
		 
		<p><label>Tournament</label>
			<select name="tourdrop"> 
				<?php select_tour(); ?>
			</select>
		 </p>
		 
		 <p><label>Teams</label>
			<select name="tourdrop1"> 
				<?php select_team('team1'); ?>
			</select>
				<select name="tourdrop2"> 
				<?php select_team('team2'); ?>
			</select>
			
		 </p>
		 
		 
		 <p><label>Match Time</label>
			
		<div class="combine_div">
			<span class="date_drop"><small>Date</small><?php date_list();?></span>
			<span class="time_drop"><small>Time</small><?php time_list();?></span>
			<span class="time_zone_drop"><small>Timezone</small><?php timezone_drop();?> </span>
		</div>	
		 </p>
		 <p><label>Match Duration</label>
				<span class="match_duration"><?php game_duration();?></div>
		 </p>
		 <p><label>URL Link</label>
        <input type="text" name="url_key" id="url" value="<?php echo $exp_urlkey;?>">		 

		 </p>
 	     <p><input type="hidden" name="hd_edit_id" value="<?php echo $hidden_edit_id?>" id="sub"></p>
		 <p><input type="submit" name="comp-update" value="Update" id="sub"></p>
		 
		</form> 
<?php }?>	

<?php
//*******Team section ***/
function viewteam(){
		
udpate_team();
global $wpdb;

$table1 = $wpdb->prefix . 'igteam';	
global  $team_rec;
pagination("viewteam",$table1); 


?>

<table class="TFtable">
<th>Team Name</th><th>Image</th><th>Info</th>
<th colspan="2">Action</th>
<?php for($i=0;$i<count($team_rec);$i++):?>

	<tr>
	<td><?php echo $team_rec[$i]->name;?></td>
	<td><img src="<?php echo $team_rec[$i]->image;?>"></td>
	<td><?php echo $team_rec[$i]->info;?></td>

	<td>
	<a href="
	options-general.php?page=igamezone.php&link=viewteam&editteam_id=<?php echo $team_rec[$i]->id;?>">Edit</a></td>
	<td>
	<a href="
	options-general.php?page=igamezone.php&link=viewteam&delteam_id=<?php echo $team_rec[$i]->id;?>">Delete</a></td>
	</tr>
	<?php endfor;?>	
</table>	
<?php 
}	

function  edit_teamview() {

 global $wpdb;
 $table1 = $wpdb->prefix . 'igteam';	

   if(!empty($_REQUEST['editteam_id'])):	
     $hidden_edit_id=$_REQUEST['editteam_id'];
     $edit_rec= $wpdb->get_results(
	  "SELECT * FROM $table1 where id='".$_REQUEST['editteam_id']."'"
	 );
   endif;
    
	?>
	<form name="teamfrm" action="options-general.php?page=igamezone.php&link=viewteam" method="post" enctype="multipart/form-data">
	<p><label>Name</label><input type="text" name="tname" value="<?php echo $edit_rec[0]->name?>"></p>
	<p><label>Image</label>
	<div class="uploader">
		<input id="upload_image" type="text" size="36" name="ad_image" value="" />
		<input id="upload_image_button" class="button" type="button" value="Upload Image" />
		<img src="<?php echo $edit_rec[0]->image?>" class="ed_image">
	</div> 
	</p>
	<p><label>Info</label><textarea name="info" id="info"><?php echo $edit_rec[0]->info?></textarea></p>
	<p><input type="hidden" name="hd_edit_id" value="<?php echo $hidden_edit_id?>" id="sub"></p>
	<p><input type="submit" name="update_team" value="Update" id="sub"></p>
	</form>

<?php }	
//*******Tournament section *****/
function viewtour(){
udpate_tour();
global $wpdb;
$table1 = $wpdb->prefix . 'igtour';	
pagination("viewtour",$table1); 
global  $team_rec;

?>

<table class="TFtable">
<th>Tournament Name</th><th>Info</th>
<th colspan="2">Action</th>
<?php for($i=0;$i<count($team_rec);$i++):?>
  <tr>
	  <td><?php echo $team_rec[$i]->name;?></td>
	  <td><?php echo $team_rec[$i]->info;?></td>

	<td>
<a href="options-general.php?page=igamezone.php&link=viewtour&edittour_id=<?php echo $team_rec[$i]->id;?>">Edit</a></td>
<td>
<a href="options-general.php?page=igamezone.php&link=viewtour&deltour_id=<?php echo $team_rec[$i]->id;?>">Delete</a></td>
	</tr>
	<?php endfor;?>	
</table>	
<?php 
}	

function  edit_tourview() {
 global $wpdb;
 $table1 = $wpdb->prefix . 'igtour';	

   if(!empty($_REQUEST['edittour_id'])):	
     $hidden_edit_id=$_REQUEST['edittour_id'];
     $edit_rec= $wpdb->get_results(
	  "SELECT * FROM $table1 where id='".$_REQUEST['edittour_id']."'"
	 );
   endif;
    
	?>
	<form name="teamfrm" action="options-general.php?page=igamezone.php&link=viewtour" method="post" enctype="multipart/form-data">
	<p><label>Name</label><input type="text" name="tname" value="<?php echo $edit_rec[0]->name?>"></p>
	
	<p><label>Info</label><textarea name="info" id="info"><?php echo $edit_rec[0]->info?></textarea></p>
	<p><input type="hidden" name="hd_edit_id" value="<?php echo $hidden_edit_id?>" id="sub"></p>
	<p><input type="submit" name="update_tour" value="Update" id="sub"></p>
	</form>

<?php }	

/*******Game section *****/
function viewgame(){
udpate_game();
global $wpdb;
$table1 = $wpdb->prefix . 'iggame';	
pagination("viewgame",$table1); 
global  $team_rec;
?>

<table class="TFtable">
<th>Tournament Name</th><th>Image</th><th>Info</th>
<th colspan="2">Action</th>
<?php for($i=0;$i<count($team_rec);$i++):?>
  <tr>
	  <td><?php echo $team_rec[$i]->name;?></td>
	  <td><img src="<?php echo $team_rec[$i]->image;?>"></td>
	  <td><?php echo $team_rec[$i]->info;?></td>

	<td>
<a href="options-general.php?page=igamezone.php&link=viewgame&editgame_id=<?php echo $team_rec[$i]->id;?>">Edit</a></td>
<td>
<a href="options-general.php?page=igamezone.php&link=viewgame&delgame_id=<?php echo $team_rec[$i]->id;?>">Delete</a></td>
	</tr>
	<?php endfor;?>	
</table>	
<?php 
}	

function  edit_gameview() {

 global $wpdb;
 $table1 = $wpdb->prefix . 'iggame';	

   if(!empty($_REQUEST['editgame_id'])):	
     $hidden_edit_id=$_REQUEST['editgame_id'];
     $edit_rec= $wpdb->get_results(
	     "SELECT * FROM $table1 where id='".$_REQUEST['editgame_id']."'"
	 );
   endif;
    
	?>
	<form name="teamfrm" action="options-general.php?page=igamezone.php&link=viewgame" method="post" enctype="multipart/form-data">
	<p><label>Name</label><input type="text" name="tname" value="<?php echo $edit_rec[0]->name?>"></p>
		<p><label>Image</label>
			<div class="uploader">
		<input id="upload_image" type="text" size="36" name="ad_image" value=""  readonly/>
		<input id="upload_image_button" class="button" type="button" value="Upload Image" />
				<img src="<?php echo $edit_rec[0]->image?>" class="ed_image">
			</div> 
       </p>	
	<p><label>Info</label><textarea name="info" id="info"><?php echo $edit_rec[0]->info?></textarea></p>
	<p><input type="hidden" name="hd_edit_id" value="<?php echo $hidden_edit_id?>" id="sub"></p>
	<p><input type="submit" name="update_game" value="Update" id="sub"></p>
	</form>

<?php }?>	
