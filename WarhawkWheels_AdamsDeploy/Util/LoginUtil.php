<?php

$DBservername = "adams.uww.edu";
$DBusername = "ATSapp";
$DBpassword = "SADprojectsRock";
$DBname = "ATSDev";
$pdoString = "mysql:host=$DBservername;dbname=ATSDev;charset=utf8mb4";
try {
    //Create Connection
    $conn = new PDO($pdoString, $DBusername, $DBpassword);
    $_SESSION["DBserver"] = $DBservername;
    $_SESSION["DBuser"] = $DBusername;
    $_SESSION["DBpass"] = $DBpassword;
    $_SESSION["DBname"] = $DBname;
    $_SESSION["pdoString"] = $pdoString;
    $stmt = $conn->prepare("SELECT * FROM User WHERE email = " . ":username" . " OR email = :partial");
    $partial = $_POST["username"] . "@uww.edu";
    $stmt->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
    $stmt->bindParam(":partial", $partial, PDO::PARAM_STR);
    $stmt->execute();



    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row["password"] == hash('sha256', $_POST["password"])) {
            $currentPage = "Home";
            $_SESSION["AccessLevel"] = $row["AccessLevel"];
            $_SESSION["LoggedOnUserId"] = $row["UserId"];
            $_SESSION["LoggedOnUser"] = $row["firstName"];
            if ($_POST["password"] == $row["UWWid"]){
                $currentPage = "Change Password";
            }
            else if ($row["AccessLevel"] == 1) {
                $stmt = $conn->prepare("Select idstudent, address, reshall, oncampus from Student Where UserId =" . ":uid");
                $stmt->bindParam(":uid", $row["UserId"], PDO::PARAM_INT);
                $stmt->execute();
                $studentinfo = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION["LoggedOnStudentId"] = $studentinfo["idstudent"];
                $_SESSION["LoggedOnCampus"] = $studentinfo["oncampus"];
                if ($studentinfo["oncampus"] == 0) {
                    $_SESSION["LoggedOnaddress"] = $studentinfo["address"];
                } else if ($studentinfo["oncampus"] == 1) {
                    include_once "LookupTables/BuildingLookup.php";
                    $_SESSION["LoggedOnaddress"] = AllBuilding_Lookup(($studentinfo["reshall"] + 18));
                }
            }
        } else{
            $loginError = "Invalid Username or Password";
            $currentPage = "Login";
        }
    }
    else {
        $loginError = "Invalid Username or Password";
        $currentPage = "Login";
    }
} catch (PDOException $ex) {
    
}
