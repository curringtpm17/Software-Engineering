<?php

if (isset($_POST["Logout"])) {
    unset($_SESSION["LoggedOnUser"]);
    unset($_SESSION["LoggedOnUserId"]);
    unset($_SESSION["AccessLevel"]);
    $currentPage = "Login";
} else if (isset($_POST["Add_User"])) {
    $currentPage = "Add User";
} else if (isset($_POST["Add_Student"])) {
    $currentPage = "Add Student";
} else if (isset($_POST["Add_Class"])) {
    $currentPage = "Add Class";
} else if (isset($_POST["View_Rides"])) {
    $currentPage = "View Rides";
} else if (isset($_SESSION["HighestId"])) {
    for ($x = 0; $x <= $_SESSION["HighestId"]; $x++) {
        $buttonName = "DeleteUser" . $x;
        if (isset($_POST[$buttonName])) {
            try {
                $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$conn = new mysqli($_SESSION["DBserver"], $_SESSION["DBuser"], $_SESSION["DBpass"], $_SESSION["DBname"]);
                $stmt = $conn->prepare("DELETE FROM User WHERE UserId=" . ":uid");
                $stmt->bindParam(":uid", $x, PDO::PARAM_INT);
                $stmt->execute();
                $currentPage = "Home";
            } catch (Exception $ex) {
                $queryResult = "Error with query " . $sql . "<br>" . $ex->getMessage();
                echo $queryResult;
            }
        } else if (isset($_POST["EditUser" . $x])) {
            try {
                $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
                $stmt = $conn->prepare("Select * FROM User WHERE UserId=" . ":uid");
                $stmt->bindParam(":uid", $x, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION["formeditUserId"] = $row["UserId"];
                    $_SESSION["formeditFirst"] = $row["firstName"];
                    $_SESSION["formeditLast"] = $row["lastName"];
                    $_SESSION["formeditEmail"] = $row["Email"];
                    $_SESSION["formeditPhone"] = $row["Phone"];
                    $_SESSION["formeditAccessLevel"] = $row["AccessLevel"];
                    $_SESSION["formeditUWWID"] = $row["UWWid"];
                }
                $currentPage = "Edit User";
            } catch (PDOException $ex) {
                
            }
        } else if (isset($_POST["EditStudent" . $x])) {
            $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
            $stmt = $conn->prepare("Select * FROM User, Student WHERE User.UserId = Student.UserId AND Student.UserId=" . ":uid");
            $stmt->bindParam(":uid", $x, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION["formeditUserId"] = $row["UserId"];
                $_SESSION["formeditidstudent"] = $row["idstudent"];
                $_SESSION["formeditFirst"] = $row["firstName"];
                $_SESSION["formeditLast"] = $row["lastName"];
                $_SESSION["formeditEmail"] = $row["Email"];
                $_SESSION["formeditPhone"] = $row["Phone"];
                $_SESSION["formeditReshall"] = $row["reshall"];
                $_SESSION["formeditOncampus"] = $row["oncampus"];
                $_SESSION["formeditAddress"] = $row["address"];
                $_SESSION["formeditVanThree"] = $row["usesvanthree"];
                $_SESSION["formeditUWWID"] = $row["UWWid"];
            }
            $currentPage = "Edit Student";
        } else if (isset($_POST["DeleteStudent" . $x])) {


            try {
                $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$conn = new mysqli($_SESSION["DBserver"], $_SESSION["DBuser"], $_SESSION["DBpass"], $_SESSION["DBname"]);
                $stmt = $conn->prepare("DELETE FROM Student WHERE UserId=" . ":uid");
                $stmt->bindParam(":uid", $x, PDO::PARAM_INT);
                $stmt->execute();
                $currentPage = "Home";
                //$conn = new mysqli($_SESSION["DBserver"], $_SESSION["DBuser"], $_SESSION["DBpass"], $_SESSION["DBname"]);
                $stmt = $conn->prepare("DELETE FROM User WHERE UserId=" . ":uid");
                $stmt->bindParam(":uid", $x, PDO::PARAM_INT);
                $stmt->execute();
                $currentPage = "Home";
            } catch (Exception $ex) {
                $queryResult = "Error with query " . $ex->getMessage();
                echo $queryResult;
            }
        } else if (isset($_POST["EditClass$x"])) {
            $_SESSION["EditClassTest"] = "EditClass" . $x;
            try {
                $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
                $stmt = $conn->prepare("Select * FROM Class WHERE idclass=" . ":idc");
                $stmt->bindParam(":idc", $x, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION["formeditClassId"] = $row["idclass"];
                    $_SESSION["formeditBuilding"] = $row["building"];
                    $_SESSION["formeditClassName"] = $row["classname"];

                    $startHour = strstr($row["starttime"], ":", true);
                    $_SESSION["formeditStartHour"] = $startHour;
                    $_SESSION["formeditStartMinute"] = substr(strstr($row["starttime"], ":", false), 1);
                    $_SESSION["formeditStartAmPm"] = substr($_SESSION["formeditStartMinute"], 2);


                    $endHour = strstr($row["endtime"], ":", true);
                    $_SESSION["formeditEndHour"] = $endHour;
                    $_SESSION["formeditEndMinute"] = substr(strstr($row["endtime"], ":", false), 1);
                    $_SESSION["formeditEndAmPm"] = substr($_SESSION["formeditEndMinute"], 2);


                    $_SESSION["formeditMonday"] = $row["monday"];
                    $_SESSION["formeditTuesday"] = $row["tuesday"];
                    $_SESSION["formeditWednesday"] = $row["wednesday"];
                    $_SESSION["formeditThursday"] = $row["thursday"];
                    $_SESSION["formeditFriday"] = $row["friday"];
                    $_SESSION["formeditToClass"] = $row["rideto"];
                    $_SESSION["formeditFromClass"] = $row["ridefrom"];

                    if ($row["rideto"] == 2) {

                        //$conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
                        include_once 'LookupTables/BuildingLookup.php';
                        $_SESSION["formeditPickupBuilding"] = "Select source FROM Class,Ride WHERE idclass=classId AND destination = \"" . AllBuilding_Lookup($_SESSION["formeditBuilding"]) . "\" AND idclass=" . ":idc";
                        $stmt = $conn->prepare("Select source FROM Class,Ride WHERE idclass=classId AND destination =:dest AND idclass=" . ":idc");
                        $stmt->bindParam(":idc", $x, PDO::PARAM_INT);
                        $stmt->bindValue(":dest", AllBuilding_Lookup($_SESSION["formeditBuilding"]), PDO::PARAM_STR);
                        $stmt->execute();
                        if ($stmt->rowCount() == 1) {
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $i = 1;

                            while (AllBuilding_Lookup($i) != $row["source"] && $i < 50) {
                                $i++;
                            }
                            $_SESSION["formeditPickupBuilding"] = $i;
                        }
                    }
                }
                $currentPage = "Edit Class";
            } catch (PDOException $ex) {
                
            }
        } else if (isset($_POST["DeleteClass" . $x])) {
            try {
                $conn = new PDO($_SESSION["pdoString"], $_SESSION["DBuser"], $_SESSION["DBpass"]);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$conn = new mysqli($_SESSION["DBserver"], $_SESSION["DBuser"], $_SESSION["DBpass"], $_SESSION["DBname"]);
                $stmt = $conn->prepare("DELETE FROM Class WHERE idclass=" . ":idc");
                $stmt->bindParam(":idc", $x, PDO::PARAM_INT);
                $stmt->execute();
                $currentPage = "Home";
                //$conn = new mysqli($_SESSION["DBserver"], $_SESSION["DBuser"], $_SESSION["DBpass"], $_SESSION["DBname"]);
                $stmt = $conn->prepare("DELETE FROM Ride WHERE classId=" . ":cid");
                $stmt->bindParam(":cid", $x, PDO::PARAM_INT);
                $stmt->execute();
                $currentPage = "Home";
            } catch (Exception $ex) {
                $queryResult = "Error with query " . $ex->getMessage();
                echo $queryResult;
            }
            $currentPage = "Home";
        }
    }
}
