<?php
 function checkValidUser(){
        // validate user
        $sql = "select student_id, first_name, last_name, access_level from `User` where
                username=:username and pwd = :pwd";
        // define values for parameters
        $values = array(':username'=>$_POST['username'], ':pwd'=>$_POST['pwd']);
        $result = getOne($sql, $values);
        return $result;
 }

function getUniqueTimes(){
	$sql = "SELECT DISTINCT start_time FROM `Class`";
	$result = getAll($sql, $parameter=null);
	
	return $result;
	
}

function getVanAvailability(){
	$sql="SELECT * FROM `Van`";

	$data = getAll($sql);
	
	return $data;
}

function getAllClassesSpecificTime(){
	$sql = "SELECT * FROM `Class` WHERE `Class`.start_time = {$classTime}";
	$data = getAll($sql);
	return $data;
}

function getStudentAtBuildingAtTime(){
	$sql = "SELECT * FROM `Class` WHERE `Class`.pick_up = {$pick_up} AND `Class`.days LIKE %{$day}%";
	$data = getAll($sql);
	return $data;
}

function getOne($sql, $parameter = null){
        global $db;
        $statement = $db->prepare($sql);
        // execute the SQL statement
        $statement->execute($parameter);
        // return result
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
  }


function getStudentInfo()
{
  	$sql = "SELECT `Student`.student_name, `Student`.student_id, `Student`.campus_address, `Student`.student_phone, `Student`.type_of_equipment, `User`.student_id, `User`.email, `User`.username FROM `Student`, `User` WHERE `Student`.student_id = `User`.student_id AND `User`.student_id = ".$_SESSION['student_id'].";";
  	$data = getOne($sql);

  	return $data;
}

function getAll($sql, $parameter = null) 
{
  	global $db;
        $statement = $db->prepare($sql);
        // execute the SQL statement
        $statement->execute($parameter);
        // return result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

}

function getRides()
{
	/*$student = (isset($_GET['studentid'])) ? $_GET['studentid'] : -1;*/
	 // step 1: Define SQL Statement
	$sql = "SELECT `Ride`.ride_id, `Ride`.student_id, `User`.student_id, `Ride`.ride_name, `Ride`.pick_up, `Ride`.destination, `Ride`.start_time, `Ride`.days, `Ride`.frequency, `Ride`.round_trip 
		FROM `Ride`, `User`
		WHERE `User`.student_id = ".$_SESSION['student_id']." AND `User`.student_id = `Ride`.student_id;";
	// obtain data
        //$par = array(':studentid'=>$student);
        $data = getAll($sql);

        if($data == NULL)
        {
		echo "<h4> Student has not made any requests. </h4>";
       	}

        return $data;

}

?>
