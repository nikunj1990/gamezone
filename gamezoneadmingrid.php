<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
 <script>
jQuery(function($) {
$( "#tabs" ).tabs();
});
</script>
<div id="tabs">
	<ul>
		<li><a href="#viewgame">View Games</a></li>
		<li><a href="#newcomp">Add New Comp</a></li>
		<li><a href="#newgame">Add New Game</a></li>
		<li><a href="#newtour">Add Tournament</a></li>
		<li><a href="#newteam">Add Team</a></li>
	</ul>
<div id="viewgame"  class="gameinfo">

<div class="title"><h5> Schedule of Game </h5></div>
	<form name="teamfrm" action=#" method="post" enctype="multipart/form-data">
	<p><label>Name</label><input type="text" name="txt" value=""></p>
	<p><label>Image</label><input type="file" name="file" value=""></p>
	<p><label>Info</label><textarea name="info" id="info"></textarea></p>
	<p><input type="submit" name="sub" value="submit" id="sub"></p>
	</form>
</div>



<div id="newcomp"  class="gameinfo">
<div class="title"><h5> Add A New Comp </h5></div>
<form name="teamfrm" action=#" method="post" enctype="multipart/form-data">
 <p><label>Game</label>
	<select name="gamedrop"> 
			<option>CS</option>
			<option>IGI</option>
	</select>
</p>

<p><label>Tournament</label>
   <select name="tournament"> <option>CS</option><option>IGI</option></select>
</p>

<p>
<label>Teams</label><select name="team1"> <option>team-1A</option><option>team-1B</option></select>
<select name="team2"> <option>team-3A</option><option>team-4B</option></select>
</p>

<p><label>Match Time</label>
 <div class="datewrap"><small> Date </small><?php include('date-template.php');?> 
 <span class="timewrap">
 <small> Time </small>
 
<select name="time " style="width: auto;"><option value="">H</option><option value="0">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option>
</select>



<select class="minute" style="width: auto;"><option value="">M</option><option value="0">00</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>


<select name="duration"> <option>AM</option><option>PM</option></select>
<div>

</p>
<p><input type="submit" name="sub" value="submit" id="sub"></p>


 </form>




</div>

<div id="newgame" class="gameinfo">

<div class="title"><h5> Add A New Tournament </h5></div>
<form name="teamfrm" action=#" method="post" enctype="multipart/form-data">
<p><label>Name</label><input type="text" name="txt" value=""></p>
<p><label>Image</label><input type="file" name="file" value=""></p>
<p><label>Info</label><textarea name="info" id="info"></textarea></p>
<p><input type="submit" name="sub" value="submit" id="sub"></p>
</form>
</div>


<div id="newtour" class="gameinfo">

<div class="title"><h5> Add A New Tournament </h5></div>
<form name="teamfrm" action=#" method="post" enctype="multipart/form-data">
<p><label>Name</label><input type="text" name="txt" value=""></p>
<p><label>Image</label><input type="file" name="file" value=""></p>
<p><label>Info</label><textarea name="info" id="info"></textarea></p>
<p><input type="submit" name="sub" value="submit" id="sub"></p>
</form>
</div>


<div id="newteam" class="gameinfo">
<div class="title"><h5> Add A New Team </h5></div>
<form name="teamfrm" action=#" method="post" enctype="multipart/form-data">
<p><label>Name</label><input type="text" name="txt" value=""></p>
<p><label>Image</label><input type="file" name="file" value=""></p>
<p><label>Info</label><textarea name="info" id="info"></textarea></p>
<p><input type="submit" name="sub" value="submit" id="sub"></p>
</form>


</div>


