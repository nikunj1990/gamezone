<?php
function pagination($viewpage,$tablename){
global $wpdb;
global  $team_rec;
$start=0;
$limit=3;
$id=1;
$filt="";

/** for gamelistfilter ***/

if(!empty($_REQUEST['filter_gamelist'])) $filt = $_REQUEST['filter_gamelist'];	

	if(isset($_GET['pagenum']))
	{
		
	$id=$_GET['pagenum'];
	$start=($id-1)*$limit;
	}	
	
	if($filt){
	    $team_rec= $wpdb->get_results(
	      "SELECT * FROM $tablename ORDER BY $filt LIMIT $start, $limit"
	     );	
	}
	else{
		
		  $team_rec= $wpdb->get_results(
	      "SELECT * FROM $tablename ORDER BY id DESC LIMIT $start, $limit"
	     );
	}
		$rows = $wpdb->get_var("SELECT COUNT(*) FROM $tablename" );
		$total=ceil($rows/$limit);

		if($id>1)
		{
		echo "<a href='options-general.php?page=igamezone.php&link=".$viewpage."&pagenum=".($id-1)."' class='button'>PREVIOUS</a>";
		}
		if($id!=$total)
		{
		echo "<a href='options-general.php?page=igamezone.php&link=".$viewpage."&pagenum=".($id+1)."' class='button'>NEXT</a>";
		}

		echo "<ul class='pagnate'>";
		for($i=1;$i<=$total;$i++)
		{
		if($i==$id) { echo "<li class='current'>".$i."</li>"; }

		else { echo "<li><a href='options-general.php?page=igamezone.php&link=".$viewpage."&pagenum=".$i."'>".$i."</a></li>"; }
		}
		echo "</ul>";	
}

