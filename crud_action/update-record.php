<?php
function udpate_comp(){
global $wpdb;

$table1 = $wpdb->prefix .'iggamelist';	
if(isset($_POST["gamedrop"])) $gameName = $_POST["gamedrop"];
if(isset($_POST["tourdrop"])) $tournamentname =$_POST["tourdrop"];
if(isset($_POST["tourdrop1"]) &&  isset($_POST["tourdrop2"])) 
$teamVs = $_POST["tourdrop1"].','.$_POST["tourdrop2"];
if(isset($_POST["day"]) &&  isset($_POST["month"]) &&  isset($_POST["year"])) 
$matchDate = $_POST["day"].'-'.$_POST["month"].'-'.$_POST["year"];
if(isset($_POST["gamehour"]) &&  isset($_POST["gamemin"]) &&  isset($_POST["ampm"])) 
$matchTime = $_POST["gamehour"].'-'.$_POST["gamemin"].'-'.$_POST["ampm"];
if(isset($_POST["timezone"]))
$timeZone = $_POST["timezone"];
if(isset($_POST["url_key"]))
$urlKey = $_POST["url_key"];

if(isset($_POST["hd_edit_id"]))
$edit_id=$_POST["hd_edit_id"];

if(isset($_POST["gd_hour"]) &&  isset($_POST["gd_min"])) 
$match_period = $_POST["gd_hour"].'-'.$_POST["gd_min"];

if(isset($_POST['comp-update'])){

	global $wpdb;
	
	$wpdb->query("UPDATE  $table1 
     SET gamename = '$gameName' ,tournamentname = '$tournamentname' ,teamvs ='$teamVs', 
	 date= '$matchDate',
	 time='$matchTime',timezone='$timeZone',urlkey='$urlKey',gameduration='$match_period'
	 WHERE id = ".$edit_id."
	");
	
	
  }

 }

 
 function udpate_team(){
	global $wpdb;
	$table1 = $wpdb->prefix . 'igteam';	
	if(isset($_POST["tname"]))  $name =  $_POST["tname"];
	if(isset($_POST["ad_image"]))  $image = $_POST["ad_image"];
	if(isset($_POST["info"]))  $info = $_POST["info"];

if(isset($_POST["hd_edit_id"]))
  $editteam_id=$_POST["hd_edit_id"];

if(isset($_POST['update_team'])){
	global $wpdb;
 if($image!=""):	
    $wpdb->query("UPDATE  $table1 
     SET name = '$name' ,image = '$image' ,info ='$info' 
	 WHERE id = ".$editteam_id."
	");
else:
   $wpdb->query("UPDATE  $table1 
     SET name = '$name',info ='$info' 
	 WHERE id = ".$editteam_id."
	");
endif;
	
  }

 }

function udpate_tour(){

global $wpdb;
	$table1 = $wpdb->prefix . 'igtour';	
	if(isset($_POST["tname"]))  $name =  $_POST["tname"];
    if(isset($_POST["info"]))  $info = $_POST["info"];

if(isset($_POST["hd_edit_id"]))

	 $editteam_id=$_POST["hd_edit_id"];

if(isset($_POST['update_tour'])){
 $wpdb->query("UPDATE  $table1 
     SET name = '$name',info ='$info' 
	 WHERE id = ".$editteam_id."
	");

	
  }
}
function udpate_game() {

global $wpdb;	
$table1 = $wpdb->prefix . 'iggame';	
	if(isset($_POST["tname"]))  $name =  $_POST["tname"];
	if(isset($_POST["ad_image"]))  $image = $_POST["ad_image"];
	if(isset($_POST["info"]))  $info = $_POST["info"];

if(isset($_POST["hd_edit_id"]))
  $editgame_id=$_POST["hd_edit_id"];

if(isset($_POST['update_game'])){

 if($image!=""):	
    $wpdb->query("UPDATE  $table1 
     SET name = '$name' ,image = '$image' ,info ='$info' 
	 WHERE id = ".$editgame_id."
	 ");
else:
   $wpdb->query("UPDATE  $table1 
     SET name = '$name',info ='$info' 
	 WHERE id = ".$editgame_id."
	");
endif;



	
  }	
	
	
}
?>