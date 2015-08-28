<?php
/**
/*
Plugin Name: ESportsSpectator 
Plugin URI: 
Description:Create Game Tournament 
Version: 1.0
Author: ESportsSpectator 
Author URI: 
License: GPLv2 or later
Text Domain: 
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
define( 'IGAMEZONE__PLUGIN_URL', plugin_dir_url( __FILE__ ) ); 
define( 'IGAMEZONE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

$your_db_name = $wpdb->prefix . 'your_db_name';

add_action('admin_menu', 'igamezone_menu');

function igamezone_menu() {
	add_options_page('igamezone Options', 'ESportsSpectator', 'manage_options', 'igamezone.php', 'igamezone_option_page');
}


function igamezone_option_page(){
   wp_enqueue_style('igamecss', plugins_url('css/igame.css', __FILE__));
   require_once(IGAMEZONE__PLUGIN_DIR.'crud_action/create-record.php');
   require_once(IGAMEZONE__PLUGIN_DIR.'crud_action/pagination.php');
   require_once(IGAMEZONE__PLUGIN_DIR.'crud_action/update-record.php');
   require_once(IGAMEZONE__PLUGIN_DIR.'crud_action/select-record.php');
   require_once(IGAMEZONE__PLUGIN_DIR.'crud_action/delete-record.php');
   require_once(IGAMEZONE__PLUGIN_DIR.'date_time.php');
   require_once(IGAMEZONE__PLUGIN_DIR.'flattabs.php');



}
function igmaefront_styles()  
{ 
if(!is_admin()){
	wp_enqueue_style( 'ESportsSpectator', plugins_url('css/igamefront.css', __FILE__) );
	wp_enqueue_style( 'uniformcss', plugins_url('css/uniform.default.css', __FILE__) );
   // wp_enqueue_script( 'uniformjs', plugins_url('js/jquery.uniform.min.js', __FILE__) );
}	
}
add_action('init', 'igmaefront_styles');


function igame_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'uniformjs', plugins_url('js/jquery.uniform.min.js', __FILE__) );
    wp_enqueue_script( 'uniforminit', plugins_url('js/uniformInit.js', __FILE__) );
}	
  

add_action('wp_enqueue_scripts', 'igame_scripts_method');



function iuw_wdScript(){
  wp_enqueue_media();
  wp_enqueue_script('adsScript', plugins_url('js/media_game.js', __FILE__), array('jquery'));
}
add_action('admin_enqueue_scripts', 'iuw_wdScript');
 
require_once(IGAMEZONE__PLUGIN_DIR.'frontview.php');
require_once(IGAMEZONE__PLUGIN_DIR.'front_register.php');

function igame_db_options() {
global $wpdb;
global $charset_collate;
$table1 = $wpdb->prefix . 'igteam';
$table2 = $wpdb->prefix . 'igtour';
$table3 = $wpdb->prefix . 'iggame';
$table4 = $wpdb->prefix . 'iggamelist';

$sql1 = "CREATE TABLE IF NOT EXISTS $table1(
  id int(50) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  image varchar(150) NOT NULL,
  info varchar(150) NOT NULL,
  PRIMARY KEY (id)
)";
$sql2="CREATE TABLE IF NOT EXISTS $table2(
  id int(50) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  info varchar(150) NOT NULL,
  PRIMARY KEY (id)
)";

$sql3="CREATE TABLE IF NOT EXISTS $table3(
  id int(50) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  image varchar(150) NOT NULL,
  info varchar(150) NOT NULL,
  PRIMARY KEY (id)
)";

$sql4="CREATE TABLE IF NOT EXISTS $table4(
  id int(50) NOT NULL AUTO_INCREMENT,
  gamename varchar(100) NOT NULL,
  tournamentname varchar(100) NOT NULL,
  teamvs varchar(100) NOT NULL,
  date varchar(30) NOT NULL,
  time varchar(30) NOT NULL,
  timezone varchar(150) NOT NULL,
  urlkey varchar(150) NOT NULL,
  PRIMARY KEY (id)
)";


$wpdb->query($sql1);   	
$wpdb->query($sql2); 
$wpdb->query($sql3);  
$wpdb->query($sql4); 

$game_tab_alt=$wpdb->prefix.'iggamelist';
$wpdb->query("ALTER TABLE $game_tab_alt ADD gameduration varchar(150) NOT NULL");
}
// run the install scripts upon plugin activation
register_activation_hook(__FILE__,'igame_db_options');



?>
