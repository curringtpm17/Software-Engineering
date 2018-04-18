<?php
$currentPage = "Edit Ride";
if (isset($_POST["Cancel"])) {
    $currentPage = "View Rides";
    include "Util/unsetEditVars.php";
}

if (isset($_POST["Submit"])) {
    include "Util/InputTesting.php";

    $_SESSION["formeditRidePickupTimeHour"] = $ridePickupTimeHour = $_POST["ridePickupTimeHour"];
    $_SESSION["formeditRidePickupTimeMinute"] = $ridePickupTimeMinute = $_POST["ridePickupTimeMinute"];
    $_SESSION["formeditRidePickupTimeAmPm"] = $ridePickupTimeAmPm = $_POST["ridePickupTimeAmPm"];
    if ($ridePickupTimeAmPm == "pm"){
        $ridePickupTimeHour +=12;
        if ($ridePickupTimeHour == 24){
            $ridePickupTimeHour = "12";
        }
    }
    $time = "" . $ridePickupTimeHour . ":" . $ridePickupTimeMinute;
    $_SESSION["formeditVanNumber"] = $vanNumber = $_POST["vanNumber"];

    try {
        $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
        $stmt = $conn->prepare("UPDATE `Ride` " .
                "SET " .
                "`startTime` = " . ":starttime" . "," .
                "`vanId`  = " . ":vanId" .
                " WHERE `rideId` = " . ":rideid");
        
        $stmt->bindParam(":starttime", $time, PDO::PARAM_STR);
        $stmt->bindParam(":vanId", $vanNumber, PDO::PARAM_INT);
        $stmt->bindParam(":rideid", $_SESSION["formeditRideId"], PDO::PARAM_INT);
        $stmt->execute();
        $queryResult = "Record Updated";

        include "Util/unsetEditVars.php";
    } catch (PDOException $e) {
        $queryResult = "Error: " . $e;
    }

    $currentPage = "View Rides";
} 