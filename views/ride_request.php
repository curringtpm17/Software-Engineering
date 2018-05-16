<div class = 'col-xs-9' id = 'content'>
	<h2> My Ride Requests: </h2>
		<table class = 'table'>
		<thead class = 'thead'>
        		<tr>
                		<td class = 'col-xs-1'> Pick Up </td>
                		<td class = 'col-xs-1'> Destination 1 </td>
                		<td class = 'col-xs-1'> Destination 2</td>
				<td class = 'col-xs-1'> Seat 1 </td>
				<td class = 'col-xs-1'> Seat 2 </td>
                		<td class = 'col-xs-1'> Start Time </td>
                		<td class = 'col-xs-1'> Day(s) </td>
                		<td class = 'col-xs-1'> Frequency </td>
                		<td class = 'col-xs-1'> Round Trip </td>
				<td class = 'col-xs-1'> Edit</td>
				<td class = 'col-xs-1'> Delete</td>
        		</tr>
		</thead>
		<tbody>
<?php
//display each request
		if(isset($data) && count($data)>0)
		{
			for($i=0; $i <count($data); $i++)
         		{
				$row = $data[$i]; //each element is an object
				echo "<tr>
					<td class = 'col-xs-1'>{$row['pick_up']}</td>
					<td class = 'col-xs-1'>{$row['destination0']}</td>
					<td class = 'col-xs-1'>{$row['destination1']}</td>
					<td class = 'col-xs-1'>{$row['seat0']}</td>
					<td class = 'col-xs-1'>{$row['seat1']}</td>
					<td class = 'col-xs-1'>{$row['start_time']}</td>
					<td class = 'col-xs-1'>{$row['days']}</td>
					<td class = 'col-xs-1'>{$row['frequency']}</td>
					<td class = 'col-xs-1'>{$row['round_trip']}</td>";
					echo "<td><form action = 'index.php?mode=editrequest' method = 'post'>";
					echo "<button type = 'submit' class = 'btn btn-primary'> Edit </button>";
					echo "<input type = 'hidden' name = 'ride_id' value = '{$row['ride_id']}' />";
					echo "<td><form action = 'index.php?mode=deleteriderequest' method = 'post'>";
					echo "<button type = 'button' class = 'btn btn-primary'> Delete </button>";
					echo "<input type = 'hidden' name = 'ride_id' value = '{$row['ride_id']}' />";
					echo "</form></td></tr>";
			}

		}
?>

		</tbody>
	</table>
</div>
<br>
