<?php
include "LookupTables/YesNoLookup.php";
include_once "LookupTables/BuildingLookup.php";
?>
<br><br>
<form action=<?php echo htmlspecialchars("index.php"); ?> method="post">
    <input type="submit" name="Logout" value="Logout">
    <input type="submit" name="Add_Class" value="Add Class">
    <input type="submit" name="View_Rides" value="View Rides">
</form>

<?php
$counter = 0;
try {
    while ($counter < 5) {
        $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
        $sql = "SELECT building, classname, starttime, endtime, rideto, ridefrom, idclass, c.classsubmissionid, cs.idstudent, UserId " .
                "FROM Class c, ClassSubmission cs, Student s " .
                "WHERE c.classsubmissionid = cs.classsubmissionid " .
                "AND cs.idstudent = s.idstudent " .
                "AND s.UserId =" . ":uid" . " ";

        switch ($counter) {
            case 0:
                $sql = $sql . "AND monday =1";
                echo "<h2>Monday</h2>";
                break;
            case 1:
                $sql = $sql . "AND tuesday =1";
                echo "<h2>Tuesday</h2>";
                break;
            case 2:
                $sql = $sql . "AND wednesday =1";
                echo "<h2>Wednesday</h2>";
                break;
            case 3:
                $sql = $sql . "AND thursday =1";
                echo "<h2>Thursday</h2>";
                break;
            case 4:
                $sql = $sql . "AND friday =1";
                echo "<h2>Friday</h2>";
                break;
        }
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":uid", $_SESSION["LoggedOnUserId"], PDO::PARAM_INT);
        $stmt->execute();
        $queryResult = $sql;
        if ($stmt->rowCount() > 0) {

            // output data of each row
            echo "<table>";
            echo "<tr>";
            echo "<th>Building</th><th>Class Name</th><th>Start Time</th><th>End Time</th><th>Ride to Class?</th><th>Ride From Class?</th><th>Options</th>";
            echo "</tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (!isset($_SESSION["HighestId"])) {
                    $_SESSION["HighestId"] = $row["idclass"];
                } else if ($_SESSION["HighestId"] < $row["idclass"]) {
                    $_SESSION["HighestId"] = $row["idclass"];
                }
                echo "<tr><td>" .
                Building_Lookup($row["building"]) .
                "</td><td>" .
                $row["classname"] .
                "</td><td>" .
                $row["starttime"] .
                "</td><td>" .
                $row["endtime"] .
                "</td><td>" .
                YesNo_Lookup($row["rideto"]) .
                "</td><td>" .
                YesNo_Lookup($row["ridefrom"]) .
                "</td><td><form class=\"hiddenForm\" action=\"index.php\" method=\"post\">" .
                "<input class=\"green\" type=\"submit\" value=\"Edit\"  name=\"EditClass" . $row["idclass"] . "\"/>" .
                "<input class=\"red\" type=\"submit\" value=\"Delete\"  name=\"DeleteClass" . $row["idclass"] . "\"/>" .
                "</form></td></tr>";
            }
            echo "</table>";
        } else {
            echo "No Classes Listed";
        }
        $counter++;
    }
} catch (PDOException $e) {
    $queryResult = "Student Home Error: " . $e->getMessage();
}
?>