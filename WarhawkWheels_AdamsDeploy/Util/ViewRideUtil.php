<?php
include_once "LookupTables/BuildingLookup.php";
$currentPage = "View Rides";
if (isset($_POST["Logout"])) {
    unset($_SESSION["LoggedOnUser"]);
    unset($_SESSION["LoggedOnUserId"]);
    unset($_SESSION["AccessLevel"]);
    $currentPage = "Login";
} else if (isset($_POST["Home"])) {
    $currentPage = "Home";
} else if (isset($_POST["Monday"])) {
    $_SESSION["ShowThisDay"] = "Monday";
} else if (isset($_POST["Tuesday"])) {
    $_SESSION["ShowThisDay"] = "Tuesday";
} else if (isset($_POST["Wednesday"])) {
    $_SESSION["ShowThisDay"] = "Wednesday";
} else if (isset($_POST["Thursday"])) {
    $_SESSION["ShowThisDay"] = "Thursday";
} else if (isset($_POST["Friday"])) {
    $_SESSION["ShowThisDay"] = "Friday";
} else if (isset($_SESSION["HighestId"])) {
    for ($x = 0; $x <= $_SESSION["HighestId"]; $x++) {
        $buttonName = "InactivateRide" . $x;
        if (isset($_POST[$buttonName])) {
            try {
                $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
                $stmt = $conn->prepare("UPDATE `Ride` SET `rideStatus` = 0 WHERE rideId = :id");
                $stmt->bindparam(":id", $x, PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $e) {
                
            }
        } else if (isset($_POST["ActivateRide" . $x])) {
            try {
                $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
                $stmt = $conn->prepare("UPDATE `Ride` SET `rideStatus` = 1 WHERE rideId = :id");
                $stmt->bindparam(":id", $x, PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $e) {
                
            }
        } else if (isset($_POST["EditRide" . $x])) {
            try {
                $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
                $stmt = $conn->prepare("Select * from Ride, Class WHERE idclass = classId AND rideId = :id");
                $stmt->bindparam(":id", $x, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION["formeditRideId"] = $x;
                    $_SESSION["formeditClassName"] = $row["classname"];
                    $_SESSION["formeditBuilding"] = AllBuilding_Lookup($row["building"]);
                    $_SESSION["formeditSource"] = $row["source"];
                    $_SESSION["formeditDestination"] = $row["destination"];
                    $_SESSION["formeditStartTime"] = $row["starttime"];
                    $_SESSION["formeditEndTime"] = $row["endtime"];
                    
                    
                    
                    
                    $minute = substr(strstr($row["startTime"], ":", false), 1);
                    $hour = strstr($row["startTime"], ":", true);
                    $ampm = "am";
                    if ($hour >= 12) {
                        $hour -= 12;
                        $ampm = "pm";
                    } 
                    if ($hour == 0) {
                        $hour = 12;
                    }
                    $_SESSION["formeditRidePickupTimeHour"] = $hour;
                    $_SESSION["formeditRidePickupTimeMinute"] = $minute;
                    $_SESSION["formeditRidePickupTimeAmPm"] = $ampm;
                    $_SESSION["formeditVanNumber"] = $row["vanId"];
                }
                $stmt = $conn->prepare("select usesvanthree from Student, ClassSubmission, Class, Ride
                                        WHERE Student.idstudent = ClassSubmission.idstudent
                                        AND ClassSubmission.classsubmissionid = Class.classsubmissionid
                                        AND Class.idclass = Ride.classId
                                        AND rideId = :id");
                $stmt->bindparam(":id", $x, PDO::PARAM_INT);
                $stmt->execute();
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION["formeditVanThreeAccessible"] = $row["usesvanthree"];
                }
                $currentPage = "Edit Ride";
            } catch (PDOException $e) {
                
            }
        }
    }
}

