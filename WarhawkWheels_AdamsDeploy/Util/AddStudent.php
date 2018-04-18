<?php

if (isset($_POST["Submit"])) {
    include "Util/InputTesting.php";

    $address = "";
    $reshall = "";
    $oncampus = "";
    $vanThree = "";
    $email = "";
    $UWWID = "";

    if (isset($_POST["oncampus"])) {
        $_SESSION["formeditOncampus"] = $oncampus = $_POST["oncampus"];
    
        if ($_POST["oncampus"] == 1) {
            $_SESSION["formeditReshall"] = $reshall = $_POST["reshall"];
        } else {
            $_SESSION["formeditReshall"] = "";
        }
        if ($_POST["oncampus"] == 0) {
            if ($_POST["address"] == ""){
        $addressErr = "Address is required if student lives off campus";
        }else
        {
            $_SESSION["formeditAddress"] = $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
        }} else {
            $_SESSION["formeditAddress"] = "";
    }
    }
    else
    {
        $oncampusErr = "Selection for student's residence is required";
    }
    //$_SESSION["formeditAddress"] = $_POST["address"];
    if (isset($_POST["vanThree"])) {
        $_SESSION["formeditVanThree"] = $vanThree = $_POST["vanThree"];
    }else
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
    //$_SESSION["formeditFirst"] = $fName = filter_var($_POST["firstName"], FILTER_SANITIZE_STRING);
    //$_SESSION["formeditLast"] = $lName = filter_var($_POST["lastName"], FILTER_SANITIZE_STRING);
    //$_SESSION["formeditEmail"] = $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    //$_SESSION["formeditUWWID"] = $UWWId = filter_var($_POST["UWWID"], FILTER_SANITIZE_NUMBER_INT);
    //$_SESSION["formeditPhone"] = $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);



    if (isUWWEmail($email) && isValidPhoneNumber($phone) && isValidUWWid($UWWID) && $fName != "" && $lName != "" && $email != "" && $phone != "" &&
            $oncampus != "" && (($address != "" && $oncampus == 0) || ($reshall != "" && $oncampus == 1)) && $vanThree != "") {




        try {
            $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
            $stmt = $conn->prepare("INSERT INTO User (firstName, lastName, Email, Phone, AccessLevel, UWWid, password)
    VALUES (:fName,:lName,:email,:phone,1, :uwwid, :defaultPass)");
            $stmt->bindParam(":fName", $fName, PDO::PARAM_STR);
            $stmt->bindParam(":lName", $lName, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":uwwid", $UWWID, PDO::PARAM_INT);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $defaultPass = hash('sha256', $UWWID);
            $stmt->bindParam(":defaultPass", $defaultPass, PDO::PARAM_STR);
            $stmt->execute();
            $stmt = null;
            $last_id = $conn->lastInsertId();
            $stmt = $conn->prepare("INSERT INTO Student ( reshall, address, usesvanthree, oncampus, UserId)
    VALUES (:reshall,:address,:vanThree,:oncampus,:last_id)");
            $stmt->bindParam(":reshall", $reshall, PDO::PARAM_STR);
            $stmt->bindParam(":address", $address, PDO::PARAM_STR);
            $stmt->bindParam(":vanThree", $vanThree, PDO::PARAM_INT);
            $stmt->bindParam(":oncampus", $oncampus, PDO::PARAM_INT);
            $stmt->bindParam(":last_id", $last_id, PDO::PARAM_STR);
            $stmt->execute();

            include "Util/unsetEditVars.php";
        } catch (PDOException $e) {
            $queryResult = "Error: " . $e . "<br>";
        }

        $currentPage = "Home";
    } else {
        $currentPage = "Add Student";
    }
}

if (isset($_POST["Cancel"])) {
    $currentPage = "Home";
    include "Util/unsetEditVars.php";
}