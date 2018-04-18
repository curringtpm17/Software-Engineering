<br>
<form class="hiddenForm" action=<?php echo htmlspecialchars("index.php"); ?> method="post">
    <input type="submit" name="Logout" value="Logout">
    <input type="submit" name="View_Rides" value="View Rides">
</form>
<?php
include "LookupTables/AccessLookup.php";
include "Util/ReshallOrAddress.php";
include "LookupTables/YesNoLookup.php";





$conn = new mysqli($_SESSION["DBserver"], $_SESSION["DBuser"], $_SESSION["DBpass"], $_SESSION["DBname"]);
$sql = "SELECT * FROM User where AccessLevel = 2 OR AccessLevel = 3 ORDER BY AccessLevel DESC, lastName";
$result = $conn->query($sql);

if ($result->num_rows > 0) {


    // output data of each row
    echo "<h2>CSD Staffmembers</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th><th>Phone Number</th><th>Email Address</th><th>Access Level</th><th>Options</th>";
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        if (!isset($_SESSION["HighestId"])) {
            $_SESSION["HighestId"] = $row["UserId"];
        } else if ($_SESSION["HighestId"] < $row["UserId"]) {
            $_SESSION["HighestId"] = $row["UserId"];
        }
        echo "<tr><td>" .
        $row["lastName"] .
        ", " .
        $row["firstName"] .
        "</td><td>" .
        $row["Phone"] .
        "</td><td>" .
        $row["Email"] .
        "</td><td>" .
        Access_Lookup($row["AccessLevel"]) .
        "</td><td>" .
        "<form class=\"hiddenForm\" action=\"index.php\" method=\"post\">" .
        "<input  type=\"submit\" value=\"Edit\"  name=\"EditUser" . $row["UserId"] . "\"/>";
        if ($row["UserId"] != $_SESSION["LoggedOnUserId"]){
        echo "<input  type=\"submit\" onclick=\"javascript:return confirm('Are you sure you want to delete " . $row["lastName"] . ", " . $row["firstName"] . "?')\" value=\"Delete\"  name=\"DeleteUser" . $row["UserId"] . "\"/>";
        }
        echo "</form>" .
        "</td></tr>";
    }
    echo "</table>";
    //echo "<br>HighestId: " . $_SESSION["HighestId"];
} else {
    echo "0 results";
}
?>


<form class= "hiddenForm" action=<?php echo htmlspecialchars("index.php"); ?> method="post">
    <input type="submit" name="Add_User" value="Add Staffmember">
</form>

<?php
$sql = "select * from User u , Student s where s.UserId = u.UserId Order By lastName";
$result = $conn->query($sql);
echo "<h2>Students</h2>";
if ($result->num_rows > 0) {


    // output data of each row
    
    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th><th>Phone Number</th><th>Email Address</th><th>Reshall/Address</th><th>Fits in Van 3?</th><th>Options</th>";
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        if (!isset($_SESSION["HighestId"])) {
            $_SESSION["HighestId"] = $row["UserId"];
        } else if ($_SESSION["HighestId"] < $row["UserId"]) {
            $_SESSION["HighestId"] = $row["UserId"];
        }
        echo "<tr><td>" .
        $row["lastName"] .
        ", " .
        $row["firstName"] .
        "</td><td>" .
        $row["Phone"] .
        "</td><td>" .
        $row["Email"] .
        "</td><td>" .
        reshall_addressDisplay($row["oncampus"], $row["reshall"], $row["address"]) .
        "</td><td>" .
        YesNo_Lookup($row["usesvanthree"]) .
        "</td><td>" .
        "<form class=\"hiddenForm\" action=\"index.php\" method=\"post\">" .
        "<input  type=\"submit\" value=\"Edit\"  name=\"EditStudent" . $row["UserId"] . "\"/>" .
        "<input  type=\"submit\" onclick=\"javascript:return confirm('Are you sure you want to delete " . $row["lastName"] . ", " . $row["firstName"] . "?')\" value=\"Delete\"  name=\"DeleteStudent" . $row["UserId"] . "\"/>" .
        "</form>" .
        "</td></tr>";
    }
    echo "</table>";
    //echo "<br>HighestId: " . $_SESSION["HighestId"];
} else {
    echo "No students currently in system.<br>";
}
?>

<form class= "hiddenForm" action=<?php echo htmlspecialchars("index.php"); ?> method="post">
    <input type="submit" name="Add_Student" value="Add Student">
</form>
