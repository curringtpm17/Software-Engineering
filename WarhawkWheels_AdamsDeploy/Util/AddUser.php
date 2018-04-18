<?php

if (isset($_POST["Submit"])) {
    include "Util/InputTesting.php";
    
    $fName = "";
    $lName = "";
    $email = "";
    $phone = "";

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
            $_SESSION["formeditFirst"] = $fName = filter_var($_POST["firstName"], FILTER_SANITIZE_STRING);
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
    //$_SESSION["formeditUWWID"] = $UWWID = filter_var($_POST["UWWID"], FILTER_SANITIZE_NUMBER_INT);
    //$_SESSION["formeditPhone"] = $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    $_SESSION["formeditAccessLevel"] = $aLevel = $_POST["accessLevel"];
    
    if (isUWWEmail($email) && isValidPhoneNumber($phone) && isValidUWWid($UWWID) && $fName != "" && $lName != "" && $email != "" && $phone != "") {

        try {
            $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
            $stmt = $conn->prepare("INSERT INTO User (firstName, lastName, Email, Phone, AccessLevel, UWWid, password)
    VALUES (:fName,:lName,:email,:phone,:aLevel, :uwwid, :defaultPass)");
            $stmt->bindParam(":fName", $fName, PDO::PARAM_STR);
            $stmt->bindParam(":lName", $lName, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":uwwid", $UWWID, PDO::PARAM_INT);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":aLevel", $aLevel, PDO::PARAM_INT);
            $defaultPass = hash('sha256', $UWWID);
            $stmt->bindParam("defaultPass", $defaultPass, PDO::PARAM_STR);
            $stmt->execute();
            include "Util/unsetEditVars.php";
        } catch (PDOException $e) {
            $queryResult = "Error: " . $e;
        }


        $currentPage = "Home";
    } else {
        $currentPage = "Add User";
    }
}








if (isset($_POST["Cancel"])) {
    $currentPage = "Home";
    include "Util/unsetEditVars.php";
}