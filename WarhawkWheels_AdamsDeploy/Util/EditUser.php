<?php

if (isset($_POST["Cancel"])) {
    $currentPage = "Home";
    include "Util/unsetEditVars.php";
}

if (isset($_POST["Submit"])) {
    include "Util/InputTesting.php";
    
    $fName = "";
    $lName = "";
    $email = "";
    $phone = "";
    
    //$_SESSION["formeditFirst"] = $_POST["firstName"];
    //$_SESSION["formeditLast"] = $_POST["lastName"];
    //$_SESSION["formeditEmail"] = $_POST["email"];
    //$_SESSION["formeditPhone"] = $_POST["phone"];
    $_SESSION["formeditAccessLevel"] = $_POST["accessLevel"];
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
    //$fName = inputValidation($_POST["firstName"]);
    //$lName = inputValidation($_POST["lastName"]);
    //$email = inputValidation($_POST["email"]);
    //$phone = inputValidation($_POST["phone"]);
    $aLevel = inputValidation($_POST["accessLevel"]);

    if (isUWWEmail($email) && isValidPhoneNumber($phone) && $fName != "" && $lName != "" && $email != "" && $phone != "") {

        try {
            $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
            $stmt = $conn->prepare("UPDATE `User` " .
                "SET " .
                "`firstName` = " . ":fName" . "," .
                "`lastName` = " . ":lName" . "," .
                "`Phone` = " . ":phone" . "," .
                "`Email` = " . ":email" . "," .
                    "`UWWid` = " . ":uwwid" . "," .
                "`AccessLevel` = " . ":aLevel" .
                " WHERE `UserId` = " . ":uid");
            $stmt->bindParam(":fName", $fName, PDO::PARAM_STR);
            $stmt->bindParam(":lName", $lName, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":uwwid", $UWWID, PDO::PARAM_INT);
            $stmt->bindParam(":aLevel", $aLevel, PDO::PARAM_INT);
            $stmt->bindParam(":uid", $_SESSION["formeditUserId"], PDO::PARAM_INT);
            $stmt->execute();
            $queryResult = "Record Updated";
            include "Util/unsetEditVars.php";
        } catch (PDOException $e) {
            $queryResult = "Error: " . $e;
        }
        
        $currentPage = "Home";
    } else {
        $currentPage = "Add User";
    }
}