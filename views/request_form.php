<?php
	include("./pdo_connect.php");
?>

<script>
        function Clear()
        {
                document.getElementById("form1").reset();
                // console.log("Clear has been clicked.");
        }

</script>

<div class = "col-xs-5" align = "left">
<h3> Ride Request Form </h3>
<form action = 'index.php?mode=addriderequest' method = "POST" id = "form1">
       <b> Ride Name: </b> <input type = "text" name = "ride" id = "ride_name" required>
        <br><br>
        <b> Pick Up Location: </b>
                        <?php
                                $query = $db->query('select building_name from Buildings');

                                echo '<select name = "pickup" id = "pick_up" required>';

                                while($row = $query->fetch(PDO::FETCH_ASSOC))
                                {
                                        echo '<option name="'.$row['building_name'].'" value = "'.$row['building_name'].'">'.$row['building_name'].'</option>';
                                }

                                echo '</select>';

                        ?>
        <br><br>
        <b> Destination: </b>
                        <?php
                                $query = $db->query('select building_name from Buildings');

                                echo '<select name = "dest" id = "destination" required>';

                                while($row = $query->fetch(PDO::FETCH_ASSOC))
                                {
                                        echo '<option name="'.$row['building_name'].'" value = "'.$row['building_name'].'">'.$row['building_name'].'</option>';
                                }

                                echo '</select>';

                        ?>
        <br><br>
        <b> Start Time: </b> <input type = "text" name = "start" id = "start_time" required>
        <br><br>
	<b> Day(s) of the Week: </b>
        <br>
        <input type = "checkbox" name = "day[]" id = "MON" value = "MON"> Monday
        <input type = "checkbox" name = "day[]" id = "TUE" value = "TUE"> Tuesday
        <input type = "checkbox" name = "day[]" id = "WED" value = "WED"> Wednesday
        <input type = "checkbox" name = "day[]" id = "THU" value = "THU"> Thursday
        <input type = "checkbox" name = "day[]" id = "FRI" value = "FRI"> Friday
        <input type = "checkbox" name = "day[]" id = "SAT" value = "SAT"> Saturday
        <input type = "checkbox" name = "day[]" id = "SUN" value = "SUN"> Sunday
        <br><br>
        <b> Frequency: </b>
        <br>
        <input type = "checkbox" name = "fre" id = "frequency" value = "sem"> Semester
        <input type = "checkbox" name = "fre" id = "frequency" value = "onc"> Once
        <br><br>
        <b> Round Trip: </b>
        <br>
        <input type = "checkbox" name = "trip" id = "round_trip" value = "yes"> Yes
	<input type = "checkbox" name = "trip" id = "round_trip" value = "no"> No 
        <br><br>
        <input type = "submit" value="Submit">
        <input type = "reset" value="Clear">
</form>
</div>

<?php
/*
 // if (isset($_POST['ride']))
   // $ride = $_POST['ride'];

  $ride = "";
  $ride = isset($_POST['ride']) ? $_POST['ride'] : '';
  $ride = !empty($_POST['ride']) ? $_POST['ride'] : '';


 // if (isset($_POST['pickup']))
   // $pickup = $_POST['pickup'];

  $pickup = "";
  $pickup = isset($_POST['pickup']) ? $_POST['pickup'] : '';
  $pickup = !empty($_POST['pickup']) ? $_POST['pickup'] : '';


  if (isset($_POST['dest']))
    $dest = $_POST['dest'];

  $dest = "";
  $dest = isset($_POST['dest']) ? $_POST['dest'] : '';
  $dest = !empty($_POST['dest']) ? $_POST['dest'] : '';


 // if (isset($_POST['start']))
   // $start = $_POST['start'];

  $start = "";
  $start = isset($_POST['start']) ? $_POST['start'] : '';
  $start = !empty($_POST['start']) ? $_POST['start'] : '';


  if (isset($_POST['end']))
    $end = $_POST['end'];

  $end = "";
  $end = isset($_POST['end']) ? $_POST['end'] : '';
  $end = !empty($_POST['end']) ? $_POST['end'] : '';


 // if (isset($_POST['day']))
  // $days = implode(', ', $_POST['day']);
  // print_r($days);
  $days = "";
  $days = isset($_POST['day']) ? $_POST['day'] : '';
  $days = !empty($_POST['day']) ? $_POST['day'] : '';
	
  if (isset($_POST['fre']))
    $fre = $_POST['fre'];
  else
    $fre = "onc";

  if (isset($_POST['trip']))
	 $trip = $_POST['trip'];
  else
    $trip = "one-way";

global $db;

   for ($i=0; $i<count($days); $i++) {
     $currentDay = $days[$i];

     // this will print out all the information for each ride each day. Each ride will have to be inserted into the table once for each day.
     // echo "Ride name:\t{$ride}<br>Pickup Location:\t{$pickup}<br>Dropoff Location:\t{$dest}<br>Class time:\t{$start}<br>End time:\t{$end}<br>Day:\t{$currentDay}<br>Frequency:\t{$fre}<br>Trip:\t{$trip}";

     // This is the SQL debugging line, I just wanted to verify that all the values would be filled.
     // echo "<p>INSERT INTO Ride(ride,pickup,dest,start,end,day,fre,trip) VALUES ('$ride','$pickup','$dest','$start','$end','$currentDay','$fre','$trip')</p>";

     $query = "INSERT INTO `Ride` (student_id,ride_name,pick_up,destination,start_time,end_time,days,frequency,round_trip)) VALUES ({$_SESSION['student_id']},$ride,$pickup,$dest,$start,$end,$currentDay,$fre,$trip)";

	$values = array('')
//     if(mysql_query($query))
  //   {
    // 	echo "<h3>Student request has been added</h3>";
    // }
  }

*/
?>
