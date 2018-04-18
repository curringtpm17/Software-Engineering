<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
session_start();
$currentPage = "Login";
$longPage = true;

//$_SESSION["Page"] is a super global that tells you what page you were on previously
if (isset($_SESSION["Page"])) {  //Checking that the Session has a value, if this is the first time you've accessed the page, the Session Variable will not be set.
    $oldPage = $_SESSION["Page"];

    switch ($oldPage) {
        case "Login":
            include "Util/LoginUtil.php";
            break;
        case "Home":
            include "Util/HomeUtil.php";
            break;
        case "Add User":
            include "Util/AddUser.php";
            break;
        case "Edit User":
            include "Util/EditUser.php";
            break;
        case "Add Student":
            include "Util/AddStudent.php";
            break;
        case "Edit Student":
            include "Util/EditStudent.php";
            break;
        case "Add Class":
            include "Util/AddClass.php";
            break;
        case "View Rides":
            include "Util/ViewRideUtil.php";
            break;
        case "Edit Class";
            include "Util/EditClass.php";
            break;
        case "Change Password":
            include "Util/ChangePassword.php";
            break;
        case "Edit Ride":
            include "Util/EditRideUtil.php";
            break;
        default:
            session_unset();
            session_destroy();
            $currentpage = "Login";
            break;
    }
}
$_SESSION["Page"] = $currentPage;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Warhawk Wheels | <?php echo $currentPage; ?></title>
        <link rel="stylesheet" href="css/warhawk-wheels.css"/>
    </head>
    <body>
        <header>
            <img src = "pic/uwwLogo-wordmark.png" alt = "University of Wisconsin-Whitewater">
        </header>

        <?php
        //showing myself current values of variables.
        /*
          echo "<b>Variables</b> <br> currentPage: " . $currentPage . "<br>";
          if (isset($oldPage)) {
          echo "oldPage: " . $oldPage . "<br>";
          }
          if (isset($_POST["username"])) {
          echo "username: " . $_POST["username"] . "<br>";
          }
          if (isset($_POST["password"])) {
          echo "password: " . hash('sha256', $_POST["password"]) . "<br>";
          }
          if (isset($queryResult)) {
          echo "Query Result: " . $queryResult . "<br>";
          }
          if (isset($queryResult2)) {
          echo "Query Result 2: " . $queryResult2 . "<br>";
          }
          if (isset($_SESSION["AccessLevel"])) {
          echo "AccessLevel: " . $_SESSION["AccessLevel"] . "<br>";
          }
          if (isset($_SESSION["MadeIt"])) {
          echo $_SESSION["MadeIt"] . "<br>";
          }
          if (isset($_SESSION["LoggedOnaddress"])) {
          echo $_SESSION["LoggedOnaddress"] . "<br>";
          }
          if (isset($_SESSION["LoggedOnUserId"])) {
          echo "UserID: " . $_SESSION["LoggedOnUserId"] . "<br>";
          }
          if (isset($_SESSION["LoggedOnStudentId"])) {
          echo "StudentID: " . $_SESSION["LoggedOnStudentId"] . "<br>";
          }
          if (isset($_SESSION["ShowThisDay"])) {
          echo "SHOWTHISDAY: " . $_SESSION["ShowThisDay"] . "<br>";
          }
          if (isset($_SESSION["EditClassTest"])) {
          echo "EditClassTest: " . $_SESSION["EditClassTest"] . "<br>";
          }
          if (isset($_SESSION["EditClass20"])) {
          echo "Button Pressed: " . "EditClass20" . "<br>";
          }
          if (isset($_SESSION["HighestId"])) {
          echo "HighestId: " . $_SESSION["HighestId"] . "<br>";
          }
          if (isset($_SESSION["formeditPickupBuilding"])) {
          echo "formeditPickupBuilding: " . $_SESSION["formeditPickupBuilding"] . "<br>";
          }
          if (isset($_SESSION["formeditOncampus"])) {
          echo "Oncampus: ". $_SESSION["formeditOncampus"] . "<br>";
          }
          if (isset($_SESSION["formeditClassId"])){
          echo "classid: " . $_SESSION["formeditClassId"] . "<br>";
          }
          if (isset($_SESSION["formeditStartHour"])){
          echo "endhour: \"".$_SESSION["formeditStartHour"]. "\"<br>";
          }

          if (isset($_SESSION["formeditStartAmPm"])){
          echo "formeditStartAmPm: " . $_SESSION["formeditStartAmPm"] . "<br>";
          }
         
        if (isset($time)){
            echo $time . "<br>";
        }
        if (isset($queryResult)){
            echo $queryResult . "<br>";
        }
         * 
         */
        ?>

    <center>
        <h1>Warhawk Wheels</h1>

        <?php
        echo "Today is " . date("l, F j, Y") . "<br>";

        if ($currentPage != "Login" && isset($_SESSION["LoggedOnUser"])) {
            echo "Welcome, " . $_SESSION["LoggedOnUser"] . "!";
        }

        $AccessLevel = "";
        if (isset($_SESSION["AccessLevel"])) {
            $AccessLevel = $_SESSION["AccessLevel"];
        }
        switch ($currentPage) {
            case "Home":
                switch ($AccessLevel) {
                    case 1:
                        include "Pages/StudentHome.php";
                        break;
                    case 2:
                        include "Pages/Login.php";
                        break;
                    case 3:
                        include "Pages/Home.php";
                        break;
                }
                break;
            case "Login":
                $longPage = false;
                include "Pages/Login.php";
                break;
            case "Add User":
            case "Edit User":
                include "Pages/Add_EditUser.php";
                break;
            case "Add Student":
            case "Edit Student":
                include "Pages/Add_EditStudent.php";
                break;
            case "Add Class":
            case "Edit Class":
                include "Pages/Add_EditClass.php";
                break;
            case "View Rides":
                switch ($AccessLevel) {
                    case 1:
                        include "Pages/StudentRideSchedule.php";
                        break;
                    case 2:
                        include "Pages/Login.php";
                        break;
                    case 3:
                        include "Pages/CoordinatorRideSchedule.php";
                        break;
                }
                break;
            case "Change Password":
                include "Pages/ChangePassword.php";
                break;
            case "Edit Ride":
                include "Pages/EditRide.php";
                break;
        }
        ?>
    </center>
    <?php
    if (isset($addrideQuery)) {
        echo "Query Result: " . $addrideQuery . "<br>";
    }
    ?>

    <footer>
        <div id="footerLeft">
            <div id = "marginFooterLeft">
                <h3><b><u>Location:</u></b></h3>
                <p>
                    Center for Students with Disabilities<br>
                    Andersen Library Room 2002 <br>
                    800 West Main Street <br>
                    Whitewater WI, 53190 <br>
                    <u><a href = "http://www.uww.edu/csd/contact-x29090" target="_blank">Map and Directions</a></u>
                </p>
            </div>
        </div>
        <div id="footerRight">
            <div id = "marginFooterRight">
                <h3><b><u>Contact Us:</u></b></h3>
                <p>
                    CSD Office: (262) 472-4711 <br>
                    Dispatch: (262) 472-4712 <br>
                    Email: <a href = "mailto:transcsd@uww.edu" target="_blank">transcsd@uww.edu</a>
                </p>
            </div>
        </div>
    </footer>


</body>
</html>
