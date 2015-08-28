<?php
function delete_comp(){
global $wpdb;
$table1 = $wpdb->prefix .'iggamelist';	
if(isset($_REQUEST["del_id"]))
$del_id=$_REQUEST["del_id"];

if(isset($del_id)){

	global $wpdb;
	
	$wpdb->query(
	    "DELETE FROM $table1
		 WHERE id= ".$del_id.""
	 );


  }
 }
 delete_comp();
 
function delete_team(){
global $wpdb;
$table1 = $wpdb->prefix .'igteam';	
if(isset($_REQUEST["delteam_id"]))
$del_id=$_REQUEST["delteam_id"];

if(isset($del_id)){

	global $wpdb;
	
	$wpdb->query(
	    "DELETE FROM $table1
		 WHERE id= ".$del_id.""
	 );


  }
 }
 delete_team();
 
function delete_tourmanment(){
global $wpdb;
$table1 = $wpdb->prefix .'igtour';	
if(isset($_REQUEST["deltour_id"]))
$del_id=$_REQUEST["deltour_id"];

if(isset($del_id)){

	global $wpdb;
	
	$wpdb->query(
	    "DELETE FROM $table1
		 WHERE id= ".$del_id.""
	 );


  }
 }
 delete_tourmanment(); 
 
 function delete_game(){
global $wpdb;
$table1 = $wpdb->prefix .'iggame';	
if(isset($_REQUEST["delgame_id"]))
$del_id=$_REQUEST["delgame_id"];

if(isset($del_id)){

	global $wpdb;
	
	$wpdb->query(
	    "DELETE FROM $table1
		 WHERE id= ".$del_id.""
	 );


  }
 }
delete_game(); 
 
 
?>