<?php

$user = 'kuttil13';
$pass = 'lk7359'; // first initial last initial last 4-digits of ID
$db_info='mysql:host=washington.uww.edu; dbname=csd-transport';
try {
    $db = new PDO($db_info, $user, $pass);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
