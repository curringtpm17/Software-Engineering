<?php

if (isset($_POST["Cancel"])) {
    $currentPage = "Home";
    include "Util/unsetEditVars.php";
}

if (isset($_POST["Submit"])) {

    include "Util/InputTesting.php";

    $building = $_POST["building"];
    $_SESSION["formeditBuilding"] = $_POST["building"];
    
    $classname = "";

    if ($_POST["className"] == ""){
        $classNameErr = "Class Name is required";
    }else{
            $_SESSION["formeditClassName"] = $_POST["className"];
            $classname = filter_var($_POST["className"], FILTER_SANITIZE_STRING);
        }
        
        if(!isset($_POST["monday"]) &&!isset($_POST["tuesday"]) &&!isset($_POST["wednesday"]) &&
            !isset($_POST["thursday"]) &&!isset($_POST["friday"]))
    {
        $dayErr = "At least one day must be selected";
    }

    if(!isset($_POST["toClass"]))
    {
        $toErr = "One destination must be selected";
    }

    if(!isset($_POST["fromClass"]))
    {
        $fromErr = "One source must be selected";
    }
    $_SESSION["formeditStartHour"] = $startTimeHour = $_POST["startTimeHour"];
    $_SESSION["formeditStartMinute"] = $startTimeMinute = $_POST["startTimeMinute"];
    $_SESSION["formeditStartAmPm"] = $startTimeAmPm = $_POST["startTimeAmPm"];
    if ($startTimeAmPm == "pm") {
        $startTimeHour += 12;
        if ($startTimeHour == 24){
            $startTimeHour = 12;
        }
    } 
    $starttime = "";
    if (isset($_POST["startTimeHour"]) && isset($_POST["startTimeMinute"]) && isset($_POST["startTimeAmPm"])) {
        $starttime = $_POST["startTimeHour"] . ":" . $_POST["startTimeMinute"] . $_POST["startTimeAmPm"];
    }



    $_SESSION["formeditEndHour"] = $endTimeHour = $_POST["endTimeHour"];
    $_SESSION["formeditEndMinute"] = $endTimeMinute = $_POST["endTimeMinute"];
    $_SESSION["formeditEndAmPm"] = $endTimeAmPm = $_POST["endTimeAmPm"];
    $endtime = "";
    if (isset($_POST["endTimeHour"]) && isset($_POST["endTimeMinute"]) && isset($_POST["endTimeAmPm"])) {
        $endtime = $_POST["endTimeHour"] . ":" . $_POST["endTimeMinute"] . $_POST["endTimeAmPm"];
    }


    $monday = "";
    $tuesday = "";
    $wednesday = "";
    $thursday = "";
    $friday = "";
    $daySelected = false;
    if (isset($_POST["monday"])) {
        $monday = 1;
        $_SESSION["formeditMonday"] = 1;
        $daySelected = true;
    } else {
        $monday = 0;
        $_SESSION["formeditMonday"] = 0;
    }

    if (isset($_POST["tuesday"])) {
        $tuesday = 1;
        $_SESSION["formeditTuesday"] = 1;
        $daySelected = true;
    } else {
        $tuesday = 0;
        $_SESSION["formeditTuesday"] = 0;
    }

    if (isset($_POST["wednesday"])) {
        $wednesday = 1;
        $_SESSION["formeditWednesday"] = 1;
        $daySelected = true;
    } else {
        $wednesday = 0;
        $_SESSION["formeditWednesday"] = 0;
    }

    if (isset($_POST["thursday"])) {
        $thursday = 1;
        $_SESSION["formeditThursday"] = 1;
        $daySelected = true;
    } else {
        $thursday = 0;
        $_SESSION["formeditThursday"] = 0;
    }

    if (isset($_POST["friday"])) {
        $friday = 1;
        $_SESSION["formeditFriday"] = 1;
        $daySelected = true;
    } else {
        $friday = 0;
        $_SESSION["formeditFriday"] = 0;
    }

    $rideto = "";
    $ridefrom = "";

    if (isset($_POST["toClass"])) {
        $rideto = $_POST["toClass"];
        $_SESSION["formeditToClass"] = $rideto;
    }
    if (isset($_POST["fromClass"])) {
        $ridefrom = $_POST["fromClass"];
        $_SESSION["formeditFromClass"] = $ridefrom;
    }


    $prevLoc = $_POST["prevLoc"];







    $_SESSION["EditClassTest"] = "Outside if";
    if ($building != "" && $classname != "" && $starttime != "" && $endtime != "" && $rideto != "" && $ridefrom != "" && $daySelected) {
        $_SESSION["EditClassTest"] = $_SESSION["EditClassTest"] . "->Inside If";

        try {
            $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);

            $stmt = $conn->prepare("UPDATE `Class` " .
                    "SET " .
                    "`building` = " . ":building" . "," .
                    "`starttime` = " . ":stime" . "," .
                    "`endtime` = " . ":etime" . "," .
                    "`classname` = " . ":classname" . "," .
                    "`rideto` = " . ":rideto" . "," .
                    "`ridefrom` = " . ":ridefrom" . "," .
                    "`monday` = " . ":mon" . "," .
                    "`tuesday` = " . ":tue" . "," .
                    "`wednesday` = " . ":wed" . "," .
                    "`thursday` = " . ":thu" . "," .
                    "`friday` = " . ":fri" .
                    " WHERE `idclass` = " . ":classid");

            $stmt->bindParam(":building", $building, PDO::PARAM_INT);
            $stmt->bindParam(":classname", $classname, PDO::PARAM_STR);
            $stmt->bindParam(":stime", $starttime, PDO::PARAM_STR);
            $stmt->bindParam(":etime", $endtime, PDO::PARAM_STR);
            $stmt->bindParam(":mon", $monday, PDO::PARAM_INT);
            $stmt->bindParam(":tue", $tuesday, PDO::PARAM_INT);
            $stmt->bindParam(":wed", $wednesday, PDO::PARAM_INT);
            $stmt->bindParam(":thu", $thursday, PDO::PARAM_INT);
            $stmt->bindParam(":fri", $friday, PDO::PARAM_INT);
            $stmt->bindParam(":rideto", $rideto, PDO::PARAM_INT);
            $stmt->bindParam(":ridefrom", $ridefrom, PDO::PARAM_INT);
            $stmt->bindParam(":classid", $_SESSION["formeditClassId"], PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION["EditClassTest"] = $_SESSION["EditClassTest"] . "->After First Query";
            $stmt = $conn->prepare("DELETE FROM Ride WHERE classId=" . ":cid");
                $stmt->bindParam(":cid", $_SESSION["formeditClassId"], PDO::PARAM_INT);
                $stmt->execute();
            
            switch ($rideto) {
                case 1:
                    $_SESSION["EditClassTest"] = $_SESSION["EditClassTest"] . "->rideto 1";
                    $ridetoPickupTime = date("H:i", mktime($startTimeHour, ($startTimeMinute - 30)));
                    $stmt = $conn->prepare("INSERT INTO `Ride` (`source`,`destination`,`startTime`,`vanId`,`classId`,`rideStatus`) 
                        VALUES (:source, :destination, :starttime,  1, :classId, 1);");

                    $stmt->bindParam(":source", $_SESSION["LoggedOnaddress"], PDO::PARAM_STR);
                    include_once "LookupTables/BuildingLookup.php";
                    $stmt->bindValue(":destination", AllBuilding_Lookup($building), PDO::PARAM_STR);
                    $stmt->bindParam(":starttime", $ridetoPickupTime, PDO::PARAM_STR);
                    $stmt->bindParam(":classId", $_SESSION["formeditClassId"], PDO::PARAM_INT);
                    $stmt->execute();
                    break;
                case 2:
                    $_SESSION["EditClassTest"] = $_SESSION["EditClassTest"] . "-> rideto 2";
                    $ridetoPickupTime = date("H:i", mktime($startTimeHour, ($startTimeMinute - 30)));

                    $stmt = $conn->prepare("INSERT INTO `Ride` (`source`,`destination`,`startTime`,`vanId`,`classId`,`rideStatus`) 
                        VALUES (:source, :destination, :starttime,  1, :classId, 1);");

                    include_once "LookupTables/BuildingLookup.php";
                    $stmt->bindValue(":source", AllBuilding_Lookup($prevLoc), PDO::PARAM_STR);

                    $stmt->bindValue(":destination", AllBuilding_Lookup($building), PDO::PARAM_STR);
                    $stmt->bindParam(":starttime", $ridetoPickupTime, PDO::PARAM_STR);
                    $stmt->bindParam(":classId", $_SESSION["formeditClassId"], PDO::PARAM_INT);
                    $stmt->execute();
                    break;
            }
            $_SESSION["EditClassTest"] = $_SESSION["EditClassTest"] . "->After rideto switch";
            if ($endTimeAmPm == "pm") {
                $endTimeHour += 12;
            }
            if ($ridefrom == 1) {
                $_SESSION["EditClassTest"] = $_SESSION["EditClassTest"] . "->Inside RideFrom";
                $ridetoPickupTime = date("H:i", mktime($endTimeHour, ($endTimeMinute + 10)));
                $stmt = $conn->prepare("INSERT INTO `Ride` (`source`,`destination`,`startTime`,`vanId`,`classId`,`rideStatus`) 
                        VALUES (:source, :destination, :starttime,  1, :classId, 1);");

                $stmt->bindParam(":destination", $_SESSION["LoggedOnaddress"], PDO::PARAM_STR);
                include_once "LookupTables/BuildingLookup.php";
                $stmt->bindValue(":source", AllBuilding_Lookup($building), PDO::PARAM_STR);
                $stmt->bindParam(":starttime", $ridetoPickupTime, PDO::PARAM_STR);
                $stmt->bindParam(":classId", $_SESSION["formeditClassId"], PDO::PARAM_INT);
                $stmt->execute();
            }
            $_SESSION["EditClassTest"] = $_SESSION["EditClassTest"] . "->After ridefrom";
            include "Util/unsetEditVars.php";
        } catch (PDOException $e) {
            $_SESSION["EditClassTest"] = $_SESSION["EditClassTest"] . $e->getMessage();
        }
        $currentPage = "Home";
    } else {

        $currentPage = "Add Class";
    }
    $conn = null;
    $stmt = null;
}