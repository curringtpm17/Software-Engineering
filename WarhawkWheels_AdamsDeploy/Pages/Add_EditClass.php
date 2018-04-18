<br>
        <form class="left" action="<?php echo htmlspecialchars("index.php"); ?>" method="post">
            <p><span class="error">* All Fields Required.</span></p>
            Building: <select name="building">
                <option value=1 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 1) {echo "selected";} ?>>Bookstore</option>
                <option value=2 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 2) {echo "selected";} ?>>Center of the Arts</option>
                <option value=3 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 3) {echo "selected";} ?>>Goodhue</option>
                <option value=4 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 4) {echo "selected";} ?>>Heide</option>
                <option value=5 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 5) {echo "selected";} ?>>Hyer</option>
                <option value=6 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 6) {echo "selected";} ?>>Hyland</option>
                <option value=7 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 7) {echo "selected";} ?>>Laurentide</option>
                <option value=8 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 8) {echo "selected";} ?>>Anderson Library</option>
                <option value=9 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 9) {echo "selected";} ?>>McCutchen</option>
                <option value=10 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 10) {echo "selected";} ?>>McGraw</option>
                <option value=11 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 11) {echo "selected";} ?>>Perkins Stadium</option>
                <option value=12 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 12) {echo "selected";} ?>>Roseman</option>
                <option value=13 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 13) {echo "selected";} ?>>Student Athletic Complex</option>
                <option value=14 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 14) {echo "selected";} ?>>University Center</option>
                <option value=15 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 15) {echo "selected";} ?>>UHCS(Ambrose Health Center)</option>
                <option value=16 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 16) {echo "selected";} ?>>Williams Center</option>
                <option value=17 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 17) {echo "selected";} ?>>Winther</option>
                <option value=18 <?php if (isset($_SESSION["formeditBuilding"]) && $_SESSION["formeditBuilding"] == 18) {echo "selected";} ?>>Young Auditorium</option>
            </select><br>
            Class Name: <input type="text" name="className" <?php if (isset($_SESSION["formeditClassName"])) {echo "value=\"" . $_SESSION["formeditClassName"] . "\"";}?>>
            <span class="error"> <?php if (isset($classNameErr)) {echo "* " . $classNameErr;}?></span><br>
            Class Start Time: <select name="startTimeHour">
                <option value=1 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 1) {echo "selected";} ?>>1</option>
                <option value=2 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 2) {echo "selected";} ?>>2</option>
                <option value=3 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 3) {echo "selected";} ?>>3</option>
                <option value=4 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 4) {echo "selected";} ?>>4</option>
                <option value=5 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 5) {echo "selected";} ?>>5</option>
                <option value=6 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 6) {echo "selected";} ?>>6</option>
                <option value=7 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 7) {echo "selected";} ?>>7</option>
                <option value=8 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 8) {echo "selected";} ?>>8</option>
                <option value=9 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 9) {echo "selected";} ?>>9</option>
                <option value=10 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 10) {echo "selected";} ?>>10</option>
                <option value=11 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 11) {echo "selected";} ?>>11</option>
                <option value=12 <?php if (isset($_SESSION["formeditStartHour"]) && $_SESSION["formeditStartHour"] == 12) {echo "selected";} ?>>12</option>
            </select>
            <select name="startTimeMinute">
                <option value=00 <?php if (isset($_SESSION["formeditStartMinute"]) && $_SESSION["formeditStartMinute"] == 00) {echo "selected";} ?>>00</option>
                <option value=15 <?php if (isset($_SESSION["formeditStartMinute"]) && $_SESSION["formeditStartMinute"] == 15) {echo "selected";} ?>>15</option>
                <option value=30 <?php if (isset($_SESSION["formeditStartMinute"]) && $_SESSION["formeditStartMinute"] == 30) {echo "selected";} ?>>30</option>
                <option value=45 <?php if (isset($_SESSION["formeditStartMinute"]) && $_SESSION["formeditStartMinute"] == 45) {echo "selected";} ?>>45</option>
            </select>
            <select name="startTimeAmPm">
                <option value="am" <?php if (isset($_SESSION["formeditStartAmPm"]) && $_SESSION["formeditStartAmPm"] == "am") {echo "selected";} ?>>am</option>
                <option value="pm" <?php if (isset($_SESSION["formeditStartAmPm"]) && $_SESSION["formeditStartAmPm"] == "pm") {echo "selected";} ?>>pm</option>
            </select><br>
            Class End Time: <select name="endTimeHour">
                <option value=1 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 1) {echo "selected";} ?>>1</option>
                <option value=2 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 2) {echo "selected";} ?>>2</option>
                <option value=3 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 3) {echo "selected";} ?>>3</option>
                <option value=4 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 4) {echo "selected";} ?>>4</option>
                <option value=5 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 5) {echo "selected";} ?>>5</option>
                <option value=6 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 6) {echo "selected";} ?>>6</option>
                <option value=7 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 7) {echo "selected";} ?>>7</option>
                <option value=8 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 8) {echo "selected";} ?>>8</option>
                <option value=9 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 9) {echo "selected";} ?>>9</option>
                <option value=10 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 10) {echo "selected";} ?>>10</option>
                <option value=11 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 11) {echo "selected";} ?>>11</option>
                <option value=12 <?php if (isset($_SESSION["formeditEndHour"]) && $_SESSION["formeditEndHour"] == 12) {echo "selected";} ?>>12</option>
            </select>
            <select name="endTimeMinute">
                <option value=00 <?php if (isset($_SESSION["formeditEndMinute"]) && $_SESSION["formeditEndMinute"] == 00) {echo "selected";} ?>>00</option>
                <option value=15 <?php if (isset($_SESSION["formeditEndMinute"]) && $_SESSION["formeditEndMinute"] == 15) {echo "selected";} ?>>15</option>
                <option value=30 <?php if (isset($_SESSION["formeditEndMinute"]) && $_SESSION["formeditEndMinute"] == 30) {echo "selected";} ?>>30</option>
                <option value=45 <?php if (isset($_SESSION["formeditEndMinute"]) && $_SESSION["formeditEndMinute"] == 45) {echo "selected";} ?>>45</option>
                <option value=50 <?php if (isset($_SESSION["formeditEndMinute"]) && $_SESSION["formeditEndMinute"] == 50) {echo "selected";} ?>>50</option>
            </select>
            <select name="endTimeAmPm">
                <option value="am" <?php if (isset($_SESSION["formeditEndAmPm"]) && $_SESSION["formeditEndAmPm"] == "am") {echo "selected";} ?>>am</option>
                <option value="pm" <?php if (isset($_SESSION["formeditEndAmPm"]) && $_SESSION["formeditEndAmPm"] == "pm") {echo "selected";} ?>>pm</option>
            </select>
            <br>
            <span class="error"> <?php if (isset($dayErr)) {echo "* " . $dayErr;}?></span><br>
            Day: <input type="checkbox" name="monday" <?php if (isset($_SESSION["formeditMonday"] ) && $_SESSION["formeditMonday"] == 1){echo "checked";} ?>>Monday
            <input type="checkbox" name="tuesday" <?php if (isset($_SESSION["formeditTuesday"]) && $_SESSION["formeditTuesday"] == 1){echo "checked";} ?>>Tuesday 
            <input type="checkbox" name="wednesday" <?php if (isset($_SESSION["formeditWednesday"]) && $_SESSION["formeditWednesday"] == 1){echo "checked";} ?>>Wednesday 
            <input type="checkbox" name="thursday" <?php if (isset($_SESSION["formeditThursday"]) && $_SESSION["formeditThursday"] == 1){echo "checked";} ?>>Thursday 
            <input type="checkbox" name="friday" <?php if (isset($_SESSION["formeditFriday"]) && $_SESSION["formeditFriday"] == 1){echo "checked";} ?>>Friday <br> 
            <span class="error"> <?php if (isset($toErr)) {echo "* " . $toErr;}?></span><br>
            I need a ride to this class: <br>
            <input type="radio" value=1 name="toClass" <?php if (isset($_SESSION["formeditToClass"]) && $_SESSION["formeditToClass"] == 1) {echo "checked";} ?>>From Home <br> 
            <input type="radio" value=2 name="toClass"<?php if (isset($_SESSION["formeditToClass"]) && $_SESSION["formeditToClass"] == 2) {echo "checked";} ?>>From Another Class in: <select name="prevLoc">
                <option value=1 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 1) {echo "selected";} ?>>Bookstore</option>
                <option value=2 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 2) {echo "selected";} ?>>Center of the Arts</option>
                <option value=3 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 3) {echo "selected";} ?>>Goodhue</option>
                <option value=4 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 4) {echo "selected";} ?>>Heide</option>
                <option value=5 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 5) {echo "selected";} ?>>Hyer</option>
                <option value=6 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 6) {echo "selected";} ?>>Hyland</option>
                <option value=7 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 7) {echo "selected";} ?>>Laurentide</option>
                <option value=8 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 8) {echo "selected";} ?>>Anderson Library</option>
                <option value=9 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 9) {echo "selected";} ?>>McCutchen</option>
                <option value=10 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 10) {echo "selected";} ?>>McGraw</option>
                <option value=11 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 11) {echo "selected";} ?>>Perkins Stadium</option>
                <option value=12 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 12) {echo "selected";} ?>>Roseman</option>
                <option value=13 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 13) {echo "selected";} ?>>Student Athletic Complex</option>
                <option value=14 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 14) {echo "selected";} ?>>University Center</option>
                <option value=15 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 15) {echo "selected";} ?>>UHCS(Ambrose Health Center)</option>
                <option value=16 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 16) {echo "selected";} ?>>Williams Center</option>
                <option value=17 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 17) {echo "selected";} ?>>Winther</option>
                <option value=18 <?php if (isset($_SESSION["formeditPickupBuilding"]) && $_SESSION["formeditPickupBuilding"] == 18) {echo "selected";} ?>>Young Auditorium</option>
            
            </select> <br>
            <input type="radio" value=3 name="toClass" <?php if (isset($_SESSION["formeditToClass"]) && $_SESSION["formeditToClass"] == 3) {echo "checked";} ?>>No Ride To This Class <br>
            <span class="error"> <?php if (isset($fromErr)) {echo "* " . $fromErr;}?></span><br>
            I need a ride from this class: <br>
            <input type="radio" value=1 name="fromClass" <?php if (isset($_SESSION["formeditFromClass"]) && $_SESSION["formeditFromClass"] == 1) {echo "checked";} ?>>To Home <br> 
            <input type="radio" value=2 name="fromClass" <?php if (isset($_SESSION["formeditFromClass"]) && $_SESSION["formeditFromClass"] == 2) {echo "checked";} ?>>To Another Class <br>
            <input type="radio" value=3 name="fromClass"<?php if (isset($_SESSION["formeditFromClass"]) && $_SESSION["formeditFromClass"] == 3) {echo "checked";} ?>>No Ride After This Class <br>
            <br>
            <center>
            <input type="submit" name="Submit" value="Submit">
            <input type="submit" name="Cancel" value="Cancel">
            </center>
        </form>
    