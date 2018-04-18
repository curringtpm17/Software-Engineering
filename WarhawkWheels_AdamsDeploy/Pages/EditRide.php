<!--This php block wont actually be here because session variable values will be used for displaying the class data -->
<?php

$className = $_SESSION["formeditClassName"];
$source = $_SESSION["formeditSource"];
$destination = $_SESSION["formeditDestination"];
$startTime = $_SESSION["formeditStartTime"];
$endTime = $_SESSION["formeditEndTime"];
$classBuilding = $_SESSION["formeditBuilding"];
?>

        <form class="left" action="<?php echo htmlspecialchars("index.php"); ?>" method="post">
            <!-- The values displayed will not be $className etc..  They should be session variables --> 
            <?php echo "The class this ride is for is: " . $className;?><br>
            <?php echo "Located in: " . $classBuilding;?><br>
            <?php echo "The Pick up Location for this ride is: " . $source;?><br>
            <?php echo "The Destination for this ride is: " . $destination;?><br>
            <?php echo "The Class starts at: " . $startTime;?><br>
            <?php echo "The Class ends at: " . $endTime;?><br>
            Ride Pickup Time: 
            <select name="ridePickupTimeHour">
                <option value=1 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 1) {echo "selected";} ?>>1</option>
                <option value=2 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 2) {echo "selected";} ?>>2</option>
                <option value=3 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 3) {echo "selected";} ?>>3</option>
                <option value=4 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 4) {echo "selected";} ?>>4</option>
                <option value=5 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 5) {echo "selected";} ?>>5</option>
                <option value=6 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 6) {echo "selected";} ?>>6</option>
                <option value=7 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 7) {echo "selected";} ?>>7</option>
                <option value=8 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 8) {echo "selected";} ?>>8</option>
                <option value=9 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 9) {echo "selected";} ?>>9</option>
                <option value=10 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 10) {echo "selected";} ?>>10</option>
                <option value=11 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 11) {echo "selected";} ?>>11</option>
                <option value=12 <?php if (isset($_SESSION["formeditRidePickupTimeHour"]) && $_SESSION["formeditRidePickupTimeHour"] == 12) {echo "selected";} ?>>12</option>
            </select>
            <select name="ridePickupTimeMinute">
                <option value=00 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 00) {echo "selected";} ?>>00</option>
                <option value=05 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 05) {echo "selected";} ?>>05</option>
                <option value=10 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 10) {echo "selected";} ?>>10</option>
                <option value=15 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 15) {echo "selected";} ?>>15</option>
                <option value=20 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 20) {echo "selected";} ?>>20</option>
                <option value=25 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 25) {echo "selected";} ?>>25</option>
                <option value=30 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 30) {echo "selected";} ?>>30</option>
                <option value=35 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 35) {echo "selected";} ?>>35</option>
                <option value=40 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 40) {echo "selected";} ?>>40</option>
                <option value=45 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 45) {echo "selected";} ?>>45</option>
                <option value=50 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 50) {echo "selected";} ?>>50</option>
                <option value=55 <?php if (isset($_SESSION["formeditRidePickupTimeMinute"]) && $_SESSION["formeditRidePickupTimeMinute"] == 55) {echo "selected";} ?>>55</option>
            </select>
            <select name="ridePickupTimeAmPm">
                <option value="am" <?php if (isset($_SESSION["formeditRidePickupTimeAmPm"]) && $_SESSION["formeditRidePickupTimeAmPm"] == "am") {echo "selected";} ?>>am</option>
                <option value="pm" <?php if (isset($_SESSION["formeditRidePickupTimeAmPm"]) && $_SESSION["formeditRidePickupTimeAmPm"] == "pm") {echo "selected";} ?>>pm</option>
            </select><br>
            Van Number:
            <select name="vanNumber">
                <option value="1" <?php if (isset($_SESSION["formeditVanNumber"]) && $_SESSION["formeditVanNumber"] == 1) {echo "selected";} ?>>1</option>
                <option value="2" <?php if (isset($_SESSION["formeditVanNumber"]) && $_SESSION["formeditVanNumber"] == 2) {echo "selected";} ?>>2</option>
                <?php if (isset($_SESSION["formeditVanThreeAccessible"]) && $_SESSION["formeditVanThreeAccessible"] == 1) { ?><option value="3" <?php if (isset($_SESSION["formeditVanNumber"]) && $_SESSION["formeditVanNumber"] == "am") {echo "selected";} ?>>3</option><?php } ?>
            </select><br>
            <center>
                <input type="submit" name="Submit" value="Submit">
            <input type="submit" name="Cancel" value="Cancel">
            </center>
        </form>