<style>

ul {
    position:fixed;
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 200px;
    background-color: #f1f1f1;
    box-shadow:5px 10px 10px grey;
    
}

li a {
    display: block;
    font-size:15px;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

/* Change the link color on hover */
li a:hover {
    background-color: #660066;
    color: white;
}


</style>

<div class='col-xs-3' id='sidemenu'>
<?php if (isset($_SESSION['user'])){
?>
  
	<ul>
    	       <li><a href='index.php'>Home</a></li>
    		<li><a href='index.php?mode=contract'>Contract</a></li>
    		<li><a href='index.php?mode=profile'>Profile</a></li>
    		<li><a href='index.php?mode=studentCalendar'>Student Calendar</a></li>
    		<li><a href='index.php?mode=addriderequest'>Add Ride Request</a></li>
    		<li><a href='index.php?mode=riderequest'>View Ride Request</a></li>
<?php
// Admin access sidemenu links

} if (isset($_SESSION['access_level']) && $_SESSION['access_level'] == 1) {
  ?>
  <li><a href='index.php?mode=vanschedule'>Van Schedule</a></li>
  <li><a href='index.php'>Search Student</a></li>
<?php
}
?>
</ul>
</div>

