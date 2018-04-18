<?php 
    
        include_once "Util/InputTesting.php";
    if (!isset($_SESSION["ShowThisDay"])){
        if (date("l") != "Saturday" && date("l") != "Sunday"){
            $_SESSION["ShowThisDay"] = date("l");
        } else {
            $_SESSION["ShowThisDay"] = "Monday";
        }
    } 
    
?>
<br>

<form action=<?php echo htmlspecialchars("index.php"); ?> method="post">
    <?php echo "<br>Showing rides for " . $_SESSION["ShowThisDay"] . "s<br>"; ?>
    Show rides for: 
    <input type="submit" name="Monday" value="Monday" <?php if (isset($_SESSION["ShowThisDay"]) && $_SESSION["ShowThisDay"] == "Monday") {echo "disabled class=\"selectedDay\"";} ?>>
    <input type="submit" name="Tuesday" value="Tuesday" <?php if (isset($_SESSION["ShowThisDay"]) && $_SESSION["ShowThisDay"] == "Tuesday") {echo "disabled class=\"selectedDay\"";} ?>>
    <input type="submit" name="Wednesday" value="Wednesday" <?php if (isset($_SESSION["ShowThisDay"]) && $_SESSION["ShowThisDay"] == "Wednesday") {echo "disabled class=\"selectedDay\"";} ?>>
    <input type="submit" name="Thursday" value="Thursday" <?php if (isset($_SESSION["ShowThisDay"]) && $_SESSION["ShowThisDay"] == "Thursday") {echo "disabled class=\"selectedDay\"";} ?>>
    <input type="submit" name="Friday" value="Friday" <?php if (isset($_SESSION["ShowThisDay"]) && $_SESSION["ShowThisDay"] == "Friday") {echo "disabled class=\"selectedDay\"";} ?>>
    <br>
    <input type="submit" name="Home" value="Return To Home">
    <input type="submit" name="Logout" value="Logout">
</form>
<h3>Active Rides</h3>
<table>
    <tr>
        
        <th>Pickup Time</th><th>Student</th><th>Pickup Location</th><th>Destination</th><th>Van</th><th>Options</th>
    </tr>

    <?php
    try {
        $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
        
        $stmt = $conn->prepare("select rideId, r.startTime, CONCAT(lastName, ', ', firstName) as Name, source, destination, vanId 
                                from Student s, User u, Ride r, ClassSubmission cs, Class c
                                Where u.UserId = s.UserId AND
                                s.idstudent = cs.idstudent AND
                                cs.classsubmissionid = c.classsubmissionid AND
                                c.idclass = r.classId AND
                                u.UserId = :userid AND
                                rideStatus=1 AND ".
                                $_SESSION["ShowThisDay"] ." = 1 "
                . "Order by r.startTime");
        $stmt->bindParam(":userid", $_SESSION["LoggedOnUserId"], PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (!isset($_SESSION["HighestId"])) {
            $_SESSION["HighestId"] = $row["rideId"];
        } else if ($_SESSION["HighestId"] < $row["rideId"]) {
            $_SESSION["HighestId"] = $row["rideId"];
        }
                echo "<tr>";
                echo "	<td>". convertToTwelveHr($row["startTime"]) ."</td><td>".$row["Name"]."</td><td>".$row["source"]."</td><td>".$row["destination"]."</td><td>".$row["vanId"]."</td><td>"."<form class=\"hiddenForm\" action=\"index.php\" method=\"post\">" ."<input type=\"submit\" value=\"Inactivate Ride\"  name=\"InactivateRide" . $row["rideId"] . "\"/>" ."</form>" ."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan=6 style=\"text-align: center\">There are currently no active rides for this day.</td></tr>";
        }
    } catch (PDOException $e) {
        $queryResult = "Student Ride Schedule Error: " . $e->getMessage();
    }
    
    ?>
</table>

<h3>Inactive Rides</h3>
<table>
    <tr>
        
        <th>Pickup Time</th><th>Student</th><th>Pickup Location</th><th>Destination</th><th>Van</th><th>Options</th>
    </tr>
    <?php
    try {
        $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
        $stmt = $conn->prepare("select rideId, r.startTime, CONCAT(lastName, ', ', firstName) as Name, source, destination, vanId 
                                from Student s, User u, Ride r, ClassSubmission cs, Class c
                                Where u.UserId = s.UserId AND
                                s.idstudent = cs.idstudent AND
                                cs.classsubmissionid = c.classsubmissionid AND
                                c.idclass = r.classId AND
                                u.UserId = :userid AND
                                rideStatus=0 AND ". 
                                $_SESSION["ShowThisDay"] ." = 1 "
                . "Order By r.startTime");
        $stmt->bindParam(":userid", $_SESSION["LoggedOnUserId"], PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (!isset($_SESSION["HighestId"])) {
            $_SESSION["HighestId"] = $row["rideId"];
        } else if ($_SESSION["HighestId"] < $row["rideId"]) {
            $_SESSION["HighestId"] = $row["rideId"];
        }
                echo "<tr>";
                echo "	<td>". convertToTwelveHr($row["startTime"]) ."</td><td>".$row["Name"]."</td><td>".$row["source"]."</td><td>".$row["destination"]."</td><td>".$row["vanId"]."</td><td>"."<form class=\"hiddenForm\" action=\"index.php\" method=\"post\">" ."<input type=\"submit\" value=\"Activate Ride\"  name=\"ActivateRide" . $row["rideId"] . "\"/>" ."</form>" ."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan=6 style=\"text-align: center\">There are currently no inactive rides for this day.</td></tr>";
        }
    } catch (PDOException $e) {
        $queryResult = "Student Ride Schedule Error: " . $e->getMessage();
    }
    
    ?>
</table>