<h2><b>ESportsSpectator </b> </h2>
<div class="gamewrapper">


<div class="game_menu">
<a href="options-general.php?page=igamezone.php&link=viewcomp" class="first_li
<?php if($_REQUEST['link']=="viewcomp"):echo "active_tab"; endif; ?>"
">View Comps</a>
<a href="options-general.php?page=igamezone.php&link=addcomp"
class="<?php if($_REQUEST['link']=="addcomp"):echo "active_tab"; endif; ?>"
>Add New Comp</a>
<a href="options-general.php?page=igamezone.php&link=addgame"
class="<?php if($_REQUEST['link']=="addgame"):echo "active_tab"; endif; ?>"
>Add New Game</a>
<a href="options-general.php?page=igamezone.php&link=addtounamet"
class="<?php if($_REQUEST['link']=="addtounamet"):echo "active_tab"; endif; ?>"
>Add Tournament</a>
<a href="options-general.php?page=igamezone.php&link=addteam" class="last_li 

<?php if($_REQUEST['link']=="addteam"):echo "active_tab"; endif; ?>"

>Add Team</a>

</div>

<div class="game_container clear">

<?php if(empty($_REQUEST['link']) || $_REQUEST['link']=='viewcomp'): ?>


<div class="tab1 tabwrap"><div class="title"><h5>Scheduled Games </h5></div>
 <div class="game_filter"> 
 
<form name="filter_form" method="post" action="options-general.php?page=igamezone.php&link=viewcomp">
 <select name="filter_gamelist" class="filter_gamelist">
	<option value="gamename">Filter by Game</option>
	<option value="tournamentname">Filter by Tournament</option>
</select>
<input type="submit" name="filtsub" value="Filter" >

</form>

</div>

	  <?php 
	  if(!empty($_REQUEST['edit_id']) && $_REQUEST['edit_id']!=""):
	     edit_view();
	     edit_compete();
	  else:
	  
	     viewcomp();

	  endif;
	  ?>
	  
	  
	</div>
<?php endif;?>



<?php if(!empty($_REQUEST['link']) && $_REQUEST['link']=='viewgame'):?>


<div class="tab1 tabwrap"><div class="title"><h5>View Games </h5></div>
	  <?php 
	   if(!empty($_REQUEST['editgame_id'])):
	     edit_gameview();
	     //edit_compete();
	   else:
	  
	     viewgame();

	  endif;
	  ?>
	  
	  
	</div>
<?php endif;?>



<?php if(!empty($_REQUEST['link']) && $_REQUEST['link']=='viewteam'):?>


<div class="tab1 tabwrap"><div class="title"><h5>Teams </h5></div>
	  <?php 
	  if(!empty($_REQUEST['editteam_id'])):
	     edit_teamview();
	     //edit_compete();
	  else:
	  
	     viewteam();

	  endif;
	  ?>
	  
	  
	</div>
<?php endif;?>

<?php if(!empty($_REQUEST['link']) && $_REQUEST['link']=='viewtour'):?>


<div class="tab1 tabwrap"><div class="title"><h5>Tournaments </h5></div>
	  <?php 
	  if(!empty($_REQUEST['edittour_id'])):
	     edit_tourview();
	 
	  else:
	  
	     viewtour();

	  endif;
	  ?>
	  
	  
	</div>
<?php endif;?>


<?php if(!empty($_REQUEST['link']) && $_REQUEST['link']=='addcomp'):?>
	<div class="tab2 tabwrap">
		<div class="title"><h5>Add A New Comp </h5></div>
  <?php if(isset($_POST['creat_comp'])){?>
    <div class="updated"><p><?php echo "Comp Inserted";?></p></div> 
  <?php }?>

	<form name="teamfrm" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
	
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
		 
		 
		 <p><label>Match Time1</label>
			
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
		 
          <input type="text" name="url_key" id="url">		 
		
		 </p>
		 
		 <p><input type="submit" name="creat_comp" value="submit" id="sub"></p>
		</form> 

		
	
	</div>
<?php endif;?>

<?php if(!empty($_REQUEST['link']) && $_REQUEST['link']=='addgame'):?>
	
<div class="tab2 tabwrap">
	<a href="options-general.php?page=igamezone.php&link=viewgame" class="view_team">View Games</a>
<div class="title"><h5> Add A New Game </h5></div>

  <?php if(isset($_POST['game'])){?>
    <div class="updated"><p><?php echo "Game Inserted";?></p></div> 
  <?php }?>

	<form name="teamfrm" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
	<p><label>Name</label><input type="text" name="tname" value="" required></p>

	<p>
	  <label>Image</label>
	  <div class="uploader">
		<input id="upload_image" type="text" size="36" name="ad_image" value="" required readonly/>
		<input id="upload_image_button" class="button" type="button" value="Upload Image" />
	  
	</div> 
	</p>
	<p><label>Info</label><textarea name="info" id="info"></textarea></p>
	<p><input type="submit" name="game" value="submit" id="sub"></p>
	</form>
	
</div>
</div>	
	
<?php endif;?>

<?php if(!empty($_REQUEST['link']) &&  $_REQUEST['link']=='addtounamet'):?>
<div class="tab2 tabwrap">
<a class="view_team" href="options-general.php?page=igamezone.php&link=viewtour">View Tournaments</a>
<div class="title"><h5> Add A New Tournament </h5></div>


  <?php if(isset($_POST['insert_tour'])){?>
    <div class="updated"><p><?php echo "Tournament Inserted";?></p></div> 
  <?php }?>

	<form name="teamfrm" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" 
	  enctype="multipart/form-data">
	<p><label>Name</label><input type="text" name="tname" value="" required></p>
	<p><label>Info</label><textarea name="info" id="info"></textarea></p>
	<p><input type="submit" name="insert_tour" value="submit" id="sub"></p>
	</form>
	
	
</div>
</div>
<?php endif;?>


<?php if(!empty($_REQUEST['link']) &&  $_REQUEST['link']=='addteam'):?>
<div class="tab2 tabwrap">
<a href="options-general.php?page=igamezone.php&amp;link=viewteam" class="view_team">View Teams</a>
 <div class="title"><h5> Add A New Team </h5></div>

  <?php if(isset($_POST['insert_team'])){?>
   <div class="updated"><p><?php echo "Team Inserted";?></p></div> 
  <?php }?>

	<form name="teamfrm" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
	<p><label>Name</label><input type="text" name="tname" value="" required></p>

	<p><label>Image</label>
	<div class="uploader">
	
		<input id="upload_image" type="text" size="36" name="ad_image" value=""  required/>
		<input id="upload_image_button" class="button" type="button" value="Upload Image" />

	</div> 
	</p>
	<p><label>Info</label><textarea name="info" id="info"></textarea></p>
	<p><input type="submit" name="insert_team" value="submit" id="sub"></p>
	</form>


</div>
<?php endif;?>




</div>
</div>