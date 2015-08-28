<?php
function create_team () {
global $wpdb;
$table1 = $wpdb->prefix . 'igteam';	
if(isset($_POST["tname"]))  $name =  $_POST["tname"];
if(isset($_POST["ad_image"]))  $image = $_POST["ad_image"];
if(isset($_POST["info"]))  $info = $_POST["info"];
//insert
if(isset($_POST['insert_team'])){
	global $wpdb;
	$wpdb->insert(
		$table1, //table
		array('name' => $name,'image' => $image,'info' => $info), 
		array('%s','%s','%s') 
	);
	
 }
}
create_team ();

function create_game () {
global $wpdb;
$table1 = $wpdb->prefix . 'iggame';	
if(isset($_POST["tname"]))  $name =  $_POST["tname"];
if(isset($_POST["ad_image"]))  $image = $_POST["ad_image"];
if(isset($_POST["info"]))  $info = $_POST["info"];
//insert
//insert
if(isset($_POST['game'])){
	global $wpdb;
	$wpdb->insert(
		$table1, //table
		array('name' => $name,'image' => $image,'info' => $info), 
		array('%s','%s','%s') 
	);
	
 }
}

create_game ();
function create_tour () {
global $wpdb;
$table1 = $wpdb->prefix .'igtour';		
if(isset($_POST["tname"]))  $name =  $_POST["tname"];
if(isset($_POST["info"]))  $info = $_POST["info"];
//insert

if(isset($_POST['insert_tour'])){

	global $wpdb;
	$wpdb->insert(
		$table1, 
		array('name' =>$name,'info' => $info), 
		array('%s','%s') 
	);
	
 }
}
create_tour ();

function create_compete () {
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
if(isset($_POST["gd_hour"]) &&  isset($_POST["gd_min"])) 
$game_duration = $_POST["gd_hour"].'-'.$_POST["gd_min"];

if(isset($_POST["timezone"]))
$timeZone = $_POST["timezone"];
if(isset($_POST["url_key"]))
$urlKey = $_POST["url_key"];

//insert
if(isset($_POST['creat_comp'])){

	global $wpdb;
	$wpdb->insert(
		$table1,
		array('gamename' => $gameName,'tournamentname' => $tournamentname,'teamvs' => $teamVs,
		'date'=>$matchDate,'time'=>$matchTime, 'timeZone'=>$timeZone,'gameduration'=>$game_duration ,'urlKey'=>$urlKey
		), 
		 array('%s','%s','%s','%s','%s','%s') 
	);
	
 }
 
}
create_compete();
?>
