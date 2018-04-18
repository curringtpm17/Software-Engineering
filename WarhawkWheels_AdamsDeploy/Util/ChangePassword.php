<?php

if (isset($_POST["Submit"])) {
    include_once "Util/InputTesting.php";
    $newPassword = $_POST["newPassword"];
    $confirmNewPassword = $_POST["confirmNewPassword"];
    
    if(isValidPassword($newPassword) && $newPassword == $confirmNewPassword){
        try {
            $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
            $stmt = $conn->prepare("UPDATE `User` " .
                "SET " .
                "`password` = " . ":newPass" .
                " WHERE `UserId` = " . ":uid");
            $newPassHash = hash('sha256', $newPassword);
            $stmt->bindParam(":newPass", $newPassHash, PDO::PARAM_STR);
            $stmt->bindParam(":uid", $_SESSION["LoggedOnUserId"], PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $ex) {
            
        }
    } else {
        $currentPage = "Change Password";
    }
}
$currentPage = "Login";