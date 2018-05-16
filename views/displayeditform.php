<div class = "col-xs-5" align = "left">

<h2>Edit Selected Request</h2>
<form action = 'index.php?mode=updaterequest' method = 'post'>
	<b> Ride Name: </b>
		<input type = 'text' name = 'ride' value = '<?php echo  $data['ride_name']; ?>' />
	<br><br>
	<b> Pick Up Location: </b>
		<?php
			$query = $db->query('select building_name from Buildings');

			echo '<select name = "pickup" id = "pick_up">';
			echo '<option name="'.$data['pick_up'].'" value = "'.$data['pick_up'].'">'.$data['pick_up'].'</option>';

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

                        echo '<select name = "dest" id = "destination">';
			echo '<option name="'.$data['destination'].'" value = "'.$data['destination'].'">'.$data['destination'].'</option>';

                        while($row = $query->fetch(PDO::FETCH_ASSOC))
                        {
                                echo '<option name="'.$row['building_name'].'" value = "'.$row['building_name'].'">'.$row['building_name'].'</option>';
                        }

                        echo '</select>';
                ?>
	<br><br>
	<b> Start Time: </b>
		<input type = text" name = "start" value = '<?php echo $data['start_time']; ?>' />
	<br><br>
	<b> Day(s) of the Week: </b>
        <br>

	<?php

		$monday = false;
		$tuesday = false;
		$wednesday = false;
		$thursday = false;
		$friday = false;
		$saturday = false;
		$sunday = false;

		$daysArray = explode(",",$data['days']);
		for($i=0; $i < count($daysArray); $i++){
			if($daysArray[$i] == 'MON'){
				$monday = true;
			}	
			if($daysArray[$i] == 'TUE'){
				$tuesday = true;
                	}
			if($daysArray[$i] == 'WED'){
                               $wednesday = true;	 
			}
			if($daysArray[$i] == 'THU'){
				$thursday = true;
                        }
			if($daysArray[$i] == 'FRI'){
				$friday = true;
                        }
			if($daysArray[$i] == 'SAT'){
				$saturday = true;
                        }
			if($daysArray[$i] == 'SUN'){
				$sunday = true;
                        }
			//echo "<p>".$daysArray[$i]."</p>";
		}

		if($monday == false){
			echo '<input type = "checkbox" class = "get_value" name = "day" id = "MON" value = "MON"> Monday';
		}else{
			echo '<input type = "checkbox" class = "get_value" name = "day" id = "MON" value = "MON" checked> Monday';
		}

                if($tuesday == false){
                        echo '<input type = "checkbox" class = "get_value" name = "day" id = "TUE" value = "TUE"> Tuesday';
                }else{
			 echo '<input type = "checkbox" class = "get_value" name = "day" id = "TUE" value = "TUE" checked> Tuesday';
		}

                if($wednesday == false){
                        echo '<input type = "checkbox" class = "get_value" name = "day" id = "WED" value = "WED"> Wednesday';
                }else{
			 echo '<input type = "checkbox" class = "get_value" name = "day" id = "WED" value = "WED" checked> Wednesday';
		}

                if($thursday == false){
                        echo '<input type = "checkbox" class = "get_value" name = "day" id = "THU" value = "THU"> Thursday';
                }else{
			 echo '<input type = "checkbox" class = "get_value" name = "day" id = "THU" value = "THU" checked> Thursday';	
		}

                if($friday == false){
                        echo '<input type = "checkbox" class = "get_value" name = "day" id = "FRI" value = "FRI"> Friday';
                }else{
			 echo '<input type = "checkbox" class = "get_value" name = "day" id = "FRI" value = "FRI" checked> Friday';
		}

                if($saturday == false){
                        echo '<input type = "checkbox" class = "get_value" name = "day" id = "SAT" value = "SAT"> Saturday';
                }else{
			 echo '<input type = "checkbox" class = "get_value" name = "day" id = "SAT" value = "SAT" checked> Saturday';
		}

                if($sunday == false){
                        echo '<input type = "checkbox" class = "get_value" name = "day" id = "SUN" value = "SUN"> Sunday';
                }else{
			 echo '<input type = "checkbox" class = "get_value" name = "day" id = "SUN" value = "SUN" checked> Sunday';
		}	
	?>

        <br><br>
	<b> Frequency: </b>
        <br>
	<?php

		if($data['frequency']== "sem"){
			echo '<input type = "checkbox" name = "fre" id = "frequency" value = "sem" checked> Semester';
			echo '<input type = "checkbox" name = "fre" id = "frequency" value = "onc"> Once';
		}else{
			echo '<input type = "checkbox" name = "fre" id = "frequency" value = "sem"> Semester';
                        echo '<input type = "checkbox" name = "fre" id = "frequency" value = "onc" checked> Once';
		}

	?>

        <br><br>
        <b> Round Trip: </b>
        <br>

	<?php
		if($data['round_trip']=="yes"){
			echo '<input type = "checkbox" name = "trip" id = "round_trip" value = "yes" checked> Yes';
                        echo '<input type = "checkbox" name = "trip" id = "round_trip" value = "no"> No';
                }else{
                        echo '<input type = "checkbox" name = "trip" id = "round_trip" value = "yes"> Yes';
                        echo '<input type = "checkbox" name = "trip" id = "round_trip" value = "no" checked> No';

			}
	?>
        <br><br>
	<p><input type = 'hidden' name = 'ride_id' value = '<?php echo $data['ride_id'];?>' /></p>
	<p><button type = 'submit' class = 'btn btn-primary'>Update </button></p>
</form>
</div>
