<div class = 'col-xs-9' id = 'content'>
<table class = 'table'>
		<thead class = 'thead'>
                        <tr>
				<td class = 'col-xs-1'> Van Number </td>
                                <td class = 'col-xs-1'> Ride Name </td>
                                <td class = 'col-xs-1'> Pick Up </td>
                                <td class = 'col-xs-1'> Destination 1 </td>
				<td class = 'col-xs-1'> Destination 2</td>
                                <td class = 'col-xs-1'> Seat 1</td>
                                <td class = 'col-xs-1'> Seat 2</td>
                                <td class = 'col-xs-1'> Start Time </td>
                                <td class = 'col-xs-1'> Day(s) </td>
                                <td class = 'col-xs-1'> Round Trip </td>
                                <td class = 'col-xs-1'> Frequency </td>
				<td class = 'col-xs-1'> Edit </td>
                        </tr>
                </thead>

	<?php
		$sql = $db->query('select ride_id, ride_name, vanId, pick_up, destination0, destination1, seat0, seat1, start_time, days, round_trip, frequency from Ride where vanId = "1"');


		while($row = $sql->fetch(PDO::FETCH_ASSOC))
		{
		echo "<tr><td>".$row["vanId"]."</td><td>".$row["ride_name"]."</td><td>".$row["pick_up"]."</td><td>".$row["destination0"]."</td><td>".$row["destination1"]."</td><td>".$row["seat0"]."</td><td>".$row["seat1"]."</td><td>".$row["start_time"]."</td><td>".$row["days"]."</td><td>".$row["round_trip"]."</td><td>".$row["frequency"]."</td>";
		echo "<td><form action = 'index.php?mode=editrequest' method = 'post'>";
                echo "<button type = 'submit' class = 'btn btn-primary'> Edit </button></td>";
		echo "<input type = 'hidden' name = 'ride_id' value = '{$row['ride_id']}'/></td>";
                echo "</form></tr>";
		}

	?>

</table>
<table class = 'table'>
		<thead class = 'thead'>
                        <tr>
				<td class = 'col-xs-1'> Van Number </td>
                                <td class = 'col-xs-1'> Ride Name </td>
                	        <td class = 'col-xs-1'> Pick Up </td>
                                <td class = 'col-xs-1'> Destination </td>
				<td class = 'col-xs-1'> Destination 2</td>
                                <td class = 'col-xs-1'> Seat 1</td>
                                <td class = 'col-xs-1'> Seat 2</td>
                                <td class = 'col-xs-1'> Start Time </td>
                                <td class = 'col-xs-1'> Day(s) </td>
                                <td class = 'col-xs-1'> Round Trip </td>
                                <td class = 'col-xs-1'> Frequency </td>
				<td class = 'col-xs-1'> Edit </td>
                        </tr>
                </thead>

	<?php
		$sql = $db->query('select ride_id, ride_name, vanId, pick_up, destination0, destination1, seat0, seat1, start_time, days, round_trip, frequency from Ride where vanId = "2"');


		while($row = $sql ->fetch(PDO::FETCH_ASSOC))
		{
		echo "<tr><td>".$row["vanId"]."</td><td>".$row["ride_name"]."</td><td>".$row["pick_up"]."</td><td>".$row["destination0"]."</td><td>".$row["destination1"]."</td><td>".$row["seat0"]."</td><td>".$row["seat1"]."</td><td>".$row["start_time"]."</td><td>".$row["days"]."</td><td>".$row["round_trip"]."</td><td>".$row["frequency"]."</td>";
		echo "<td><form action = 'index.php?mode=editrequest' method = 'post'>";
                echo "<button type = 'submit' class = 'btn btn-primary'> Edit </button></td>";
                echo "</tr>";
		}

	?>

</table>
<table class = 'table'>
		<thead class = 'thead'>
                        <tr>
				<td class = 'col-xs-1'> Van Number </td>
                                <td class = 'col-xs-1'> Ride Name </td>
                                <td class = 'col-xs-1'> Pick Up </td>
                                <td class = 'col-xs-1'> Destination </td>
				<td class = 'col-xs-1'> Destination 2</td>
                                <td class = 'col-xs-1'> Seat 1</td>
                                <td class = 'col-xs-1'> Seat 2</td>
                                <td class = 'col-xs-1'> Start Time </td>
                                <td class = 'col-xs-1'> Day(s) </td>
                                <td class = 'col-xs-1'> Round Trip </td>
                                <td class = 'col-xs-1'> Frequency </td>
				<td class = 'col-xs-1'> Edit </td>
                        </tr>
                </thead>

	<?php
		$sql = $db->query('select ride_id, ride_name, vanId, pick_up, destination0, destination1, seat0, seat1, start_time, days, round_trip, frequency from Ride where vanId = "3"');


		while($row = $sql->fetch(PDO::FETCH_ASSOC))
		{
		echo "<tr><td>".$row["vanId"]."</td><td>".$row["ride_name"]."</td><td>".$row["pick_up"]."</td><td>".$row["destination0"]."</td><td>".$row["destination1"]."</td><td>".$row["seat0"]."</td><td>".$row["seat1"]."</td><td>".$row["start_time"]."</td><td>".$row["days"]."</td><td>".$row["round_trip"]."</td><td>".$row["frequency"]."</td>";
		echo "<td><form action = 'index.php?mode=editrequest' method = 'post'>";
                echo "<button type = 'submit' class = 'btn btn-primary'> Edit </button>";
                echo "</tr>";
		}

	?>

</table>
</div>
