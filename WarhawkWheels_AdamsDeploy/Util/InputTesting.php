<?php

function isUWWEmail($email) {
    if (strstr(strtoLower($email), "@") == "@uww.edu")
        return true;
    else
        return false;
}

function isValidPhoneNumber($number){
    if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $number)) {
        return true;
    }
    return false;
}

function isValidUWWid($number){
    if(preg_match("/^[0-9]{7}$/", $number)) {
        return true;
    }
    return false;
}

function isValidPassword($newPassword){
    if ((preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $newPassword) || preg_match('`[0-9]`',$newPassword)) && strlen($newPassword)>6 && strlen($newPassword)<21
                && preg_match('`[A-Z]`',$newPassword) && preg_match('`[a-z]`',$newPassword) ) {
                    return $newPassword . " is a valid password!";
                } else {
                    return $newPassword . " is not a valid password!";
                }
}

function inputValidation($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function convertToTwelveHr($time){
    $hour = strstr($time, ":", true);
    $ampm = "am";
    if ($hour>=12){
        $hour -=12;
        $ampm = "pm";
    }
    if ($hour == 00){
        $hour = 12;
    }
    $minute = strstr($time, ":");
    return "" . $hour . $minute . $ampm;
}