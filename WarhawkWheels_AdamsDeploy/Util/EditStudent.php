<?php

if (isset($_POST["Cancel"])) {
    $currentPage = "Home";
    include "Util/unsetEditVars.php";
}

if (isset($_POST["Submit"])) {
    include "Util/InputTesting.php";

    $address = "";
    $reshall = "";
    $oncampus = "";
    $vanThree = "";

    //$_SESSION["formeditFirst"] = $_POST["firstName"];
    //$_SESSION["formeditLast"] = $_POST["lastName"];
    //$_SESSION["formeditEmail"] = $_POST["email"];
    //$_SESSION["formeditPhone"] = $_POST["phone"];
    if (isset($_POST["oncampus"])) {
        $_SESSION["formeditOncampus"] = $_POST["oncampus"];
        $oncampus = inputValidation($_POST["oncampus"]);
    }
    else
    {
        $oncampusErr = "Selection for student's residence is required";
    }
    if ($_POST["oncampus"] == 1) {
        $_SESSION["formeditReshall"] = $_POST["reshall"];
        $reshall = inputValidation($_POST["reshall"]);
    } else {
        $_SESSION["formeditReshall"] = "";
    }
    if ($_POST["oncampus"] == 0) {
        if ($_POST["address"] == ""){
        $addressErr = "Address is required if student lives off campus";
        }else{
        $_SESSION["formeditAddress"] = $_POST["address"];
        $address = inputValidation($_POST["address"]);
        }
    } else {
        $_SESSION["formeditAddress"] = "";
    }
    //$_SESSION["formeditAddress"] = $_POST["address"];
    if (isset($_POST["vanThree"])) {
        $_SESSION["formeditVanThree"] = $_POST["vanThree"];
        $vanThree = inputValidation($_POST["vanThree"]);
    }
    else
    {
        $vanErr = "Selection for van required";
    }
    if ($_POST["firstName"] == ""){
        $firstNameErr = "First Name is required";
    }else
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",inputValidation($_POST["firstName"])))
        {
        $firstNameErr = "Only letters and white space allowed";
        $fName = "";
        $_SESSION["formeditFirst"] = $_POST["firstName"];
        }else
        {
            $_SESSION["formeditFirst"] = $_POST["firstName"];
            $fName = inputValidation($_POST["firstName"]);
        }
    if ($_POST["lastName"] == ""){
        $lastNameErr = "Last Name is required";
    }else
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",inputValidation($_POST["lastName"])))
        {
        $lastNameErr = "Only letters and white space allowed";
        $lName = "";
        $_SESSION["formeditLast"] = $_POST["lastName"];
        }else
        {
            $_SESSION["formeditLast"] = $_POST["lastName"];
            $lName = inputValidation($_POST["lastName"]);
        }
    if ($_POST["email"] == ""){
        $emailErr = "Email is required";
    }else
        // check if name only contains letters and whitespace
        if (!isUWWEmail($_POST["email"]))
        {
        $emailErr = "Email entered must be @uww.edu format";
        $email = "";
        $_SESSION["formeditEmail"] = $_POST["email"];
        }else
        {
           $_SESSION["formeditEmail"] = $_POST["email"];
           $email = inputValidation($_POST["email"]);
        }
    if ($_POST["UWWID"] == ""){
        $UWWIDErr = "Campus Id number is required";
    }else
        // check if name only contains letters and whitespace
        if (!isValidUWWid($_POST["UWWID"]))
        {
        $UWWIDErr = "Must be a 7 digit campus Id number";
        $UWWID = "";
        $_SESSION["formeditUWWID"] = filter_var($_POST["UWWID"], FILTER_SANITIZE_NUMBER_INT);
        }else
        {
            $_SESSION["formeditUWWID"] = $UWWID = filter_var($_POST["UWWID"], FILTER_SANITIZE_NUMBER_INT);
        }
    if ($_POST["phone"] == ""){
        $phoneErr = "Phone number is required";
    }else
        // check if name only contains letters and whitespace
        if (!isValidPhoneNumber($_POST["phone"]))
        {
        $phoneErr = "Must be a valid phone number";
        $phone = "";
        $_SESSION["formeditPhone"] = $_POST["phone"];
        }else
        {
            $_SESSION["formeditPhone"] = $_POST["phone"];
            $phone = inputValidation($_POST["phone"]);
        }

    if (isUWWEmail($email) && isValidPhoneNumber($phone) && isValidUWWid($UWWID) && $fName != "" && $lName != "" && $email != "" && $phone != "" &&
            $oncampus != "" && (($address != "" && $oncampus == 0) || ($reshall != "" && $oncampus == 1)) &&  $vanThree != "") {

        try {
            $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
            $stmt = $conn->prepare("UPDATE `User` " .
                "SET " .
                "`firstName` = " . ":fName" . "," .
                "`lastName` = " . ":lName" . "," .
                "`Phone` = " . ":phone" . "," .
                 "`UWWid` = " . ":uwwid" . "," .
                "`Email` = " . ":email" . 
                " WHERE `UserId` = " . ":uid");
            $stmt->bindParam(":fName", $fName, PDO::PARAM_STR);
            $stmt->bindParam(":lName", $lName, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":uwwid", $UWWID, PDO::PARAM_INT);
            $stmt->bindParam(":uid", $_SESSION["formeditUserId"], PDO::PARAM_INT);
            $stmt->execute();
            $queryResult = "Record Updated";
            
            
            $stmt = $conn->prepare("UPDATE `Student` " .
                "SET " .
                "`oncampus` = " . ":oncampus" . "," .
                "`reshall` = " . ":reshall" . "," .
                "`address` = " . ":address" . "," .
                "`usesvanthree` =" . ":vanThree" .
                " WHERE `UserId` = " . ":uid");
            $stmt->bindParam(":reshall", $reshall, PDO::PARAM_STR);
            $stmt->bindParam(":address", $address, PDO::PARAM_STR);
            $stmt->bindParam(":vanThree", $vanThree, PDO::PARAM_INT);
            $stmt->bindParam(":oncampus", $oncampus, PDO::PARAM_INT);
            $stmt->bindParam(":uid", $_SESSION["formeditUserId"], PDO::PARAM_INT);
            $stmt->execute();
            
            $queryResult2 = "Record Updated";
            include "Util/unsetEditVars.php";
            //include "Util/unsetEditVars.php";
        } catch (PDOException $e) {
            $queryResult = "Error: " . $e;
        }

        $currentPage = "Home";
    } else {
        $currentPage = "Edit Student";
    }
}