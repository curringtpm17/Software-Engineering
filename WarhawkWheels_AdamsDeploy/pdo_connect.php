<?php

$host="mysql:host=localhost; dbname=assignment6;";
$user="root";
$pass="";

try {
    $db = new PDO($host, $user, $pass);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>