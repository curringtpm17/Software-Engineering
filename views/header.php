<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Set the viewport so this responsive site displays correctly on mobile devices -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CSD-Transport Page</title>
<!-- Include bootstrap CSS -->
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css" >
<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!--<script src='script.js'></script>-->
</head>
<body>
 <div class='row' id='outerbox'>
   <div class='col-xs-12' id='logos'>
         <img src="http://cs.uww.edu/beta/cs/images/uww-logo.jpg" alt='UW-Whitewater' align="left">
        <!-- <div class='col-md-6'  id='r-img'> <img src="http://cs.uww.edu/beta/cs/images/CompSciLogoBlackWeb1.png" alt='UW-Whitewater'></div>-->
   </div>
   <div class='row'>
        <div class='col-xs-12' id='info-box'>
               <!-- <div class='col-xs-4'><a class='a-menu' href="index.php">Home</a></div>-->
                <?php if (isset($_SESSION['user'])){
                      echo "<div class='col-xs-6 a-menu' align='right'>Welcome ".$_SESSION['user']."!</div>";
                      echo "<div class='col-xs-6' align='right'><a class='a-menu' href=\"index.php?mode=logout\" style='color:white'>Sign out</a></div>";
                     }
                ?>
    </div>
</div>

</body>
</html>
