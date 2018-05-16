<?php
	session_start();
	// include database connection info
	include('pdo_connect.php');
	// include functions needed to get data from the database
	include('models/model.php');
	// Read the main task using the primary key 'mode'
	include('contract_confirmation_student.php');
	
	$mode = '';
	if(isset($_REQUEST['mode']))
		$mode = $_REQUEST['mode'];

	switch ($mode)
	{
		case 'checkLogin' :
			$data = checkValidUser();
			if(isset($data) && isset($data['student_id']))
			{
				$_SESSION['user'] = $data['first_name'].' '.$data['last_name'];
				$_SESSION['student_id'] = $data['student_id'];
				if (isset($data['access_level'])) {
					$_SESSION['access_level'] = $data['access_level'];
				}
			}

			include('views/header.php');
			include('views/sidemenu.php');
			include('views/defaultview.php');
			include('views/footer.php');
			break;

		case 'logout' :
			// destroy session variables and display login form
                	session_destroy();
                	setcookie(session_name(), '', time()-1000, '/');
                	$_SESSION = array();
                	// display default views
                	include('views/header.php');
			include('views/sidemenu.php');
                	include('views/defaultview.php');
                	include('views/footer.php');
                	break;

		case 'home':
			include('views/header.php');
			include('views/sidemenu.php');
			include('views/student_home_view.php');
			include('views/footer.php');
			break;
		
		case 'addriderequest':
			include('views/header.php');
                        include('views/sidemenu.php');
                        include('views/request_form.php');
			$ride_name = (isset($_POST['ride'])) ? $_POST['ride'] : -1;
			$pick_up = (isset($_POST['pickup'])) ? $_POST['pickup'] : -1;
			$destination = (isset($_POST['dest'])) ? $_POST['dest'] : -1;
			$start_time = (isset($_POST['start'])) ? $_POST['start'] : -1;
			$end_time = (isset($_POST['end'])) ? $_POST['end'] : -1;
			$day = (isset($_POST['day'])) ? implode(",",$_POST['day']) : -1;
			$frequency = (isset($_POST['fre'])) ? $_POST['fre'] : -1;
			$round_trip = (isset($_POST['trip'])) ? $_POST['trip'] : "one-way";
			$student_id = $_SESSION['student_id'];				
			
/*			echo "<p>".$student_id."</p>";
			echo "<p>".$ride_name."</p>";
			echo "<p>".$pick_up."</p>";
			echo "<p>".$destination."</p>";
			echo "<p>".$start_time."</p>";
			echo "<p>".$end_time."</p>";
			echo "<p>".$day."</p>";
			echo "<p>".$frequency."</p>";
			echo "<p>".$round_trip."</p>";
*/			
			 
			if($ride_name != -1 && $pick_up != -1 && $destination != -1 && 
			$start_time != -1 && $end_time != -1 && $day != -1 && 
			$frequency != -1 && $student_id != -1){
		
				$sql = "INSERT INTO `Class` (student_id, ride_name, pick_up, destination, start_time, end_time, days, frequency, round_trip) VALUES ('$student_id', '$ride_name', '$pick_up', '$destination', '$start_time', '$end_time', '$day', '$frequency', '$round_trip')";
			
				
				$values = array($student_id, 
					$ride_name, 
					$pick_up, 
					$destination, 
					$start_time, 
					$end_time, 
					$day, 
					$frequency,
					$round_trip);
			
				$stm = $db->prepare($sql);
				$stm->execute($values);
			}			
			//echo "DONE!-PC";
                        include('views/footer.php');
                        break;

		case 'riderequest':
			include('views/header.php');
                        include('views/sidemenu.php');
			$data = getRides();
                        include('views/ride_request.php');
                        include('views/footer.php');
			break;

		case 'editrequest':
			include('views/header.php');
			include('views/sidemenu.php');
			$sql = "SELECT class_id, ride_name, pick_up, destination, start_time, end_time, days, frequency, round_trip
				FROM `Class`
				WHERE class_id =:class_id";
			$parameters = array(':class_id'=>NULL);
			//obtain data
			$data = getOne($sql, $parameters);
			//display a formi
			include('views/displayeditform.php');
			include('views/footer.php');
			break;
		
		case 'updaterequest':
			include('views/header.php');
			include('views/sidemenu.php');
			$sql = 'UPDATE `Ride` SET ride_name = :ride_name, pick_up = :pickup, destination = :dest, start_time = :start, days = :day, frequency = :fre, round_trip = :trip
				WHERE ride_id = :ride_id';
			$parameters = array(':ride_name'=>$_POST['ride'],
						':pickup'=>$_POST['pickup'],
						':dest'=>$_POST['dest'],
						':start'=>$_POST['start'],
						':day'=>$_POST['day'],
						':fre'=>$_POST['fre'],
						':trip'=>$_POST['trip'],
						':ride_id'=>$_POST['ride_id']);
			//prepare SQL Statement
			$stm = $db->prepare($sql);
			//execute SQL Statement
			$stm->execute($parameters);
			echo "Done!";
			break;

		case 'profile':
			include('views/header.php');
			include('views/sidemenu.php');
			$data = getStudentInfo();
			include('views/profileview.php');
			include('views/footer.php');
			break;

		case 'vanschedule':
			include('views/header.php');
			include('views/sidemenu.php');
			include('views/van_view.php');
			include('views/footer.php');
			break;

		case 'contract':
			include('views/header.php');
			include('views/sidemenu.php');
			include('views/contractview.php');          
			include('views/footer.php');
			break;
		case 'test':
			include('views/header.php');
                        include('views/sidemenu.php');
                        include('views/defaultview.php');
			$data = getUniqueTimes();	
			print_r($data);
			
                        include('views/footer.php');
                        break;			
		case 'contractsubmit':
			include('views/header.php');
                        include('views/sidemenu.php');
                        //include('views/contractview.php');
			$student_name = (isset($_POST['contract_name'])) ? $_POST['contract_name'] : -1;
                        $student_id = $_SESSION['student_id'];
                        $campus_address = (isset($_POST['contract_campus_address'])) ? $_POST['contract_campus_address'] : -1;
                        $student_phone = (isset($_POST['contract_phone_number'])) ? $_POST['contract_phone_number'] : -1;
			$student_email = (isset($_POST['contract_email'])) ? $_POST['contract_email'] : -1;
                        $csd_services_coordinator = (isset($_POST['contract_csd_services_coordinator'])) ? $_POST['contract_csd_services_coordinator'] : -1;
                        $type_of_equipment = (isset($_POST['type_equipment'])) ? $_POST['type_equipment'] : -1;
                        $dvr_applicability = (isset($_POST['dvropt'])) ? $_POST['dvropt'] : -1;
                        $dvr_counselor = (isset($_POST['contract_dvr_counselor'])) ? $_POST['contract_dvr_counselor'] : null;
                        $dvr_address = (isset($_POST['contract_dvr_address'])) ? $_POST['contract_dvr_address'] : null;
                        $dvr_phone = (isset($_POST['contract_dvr_phone'])) ? $_POST['contract_dvr_phone'] : null;
                        $dvr_fax = (isset($_POST['contract_dvr_fax'])) ? $_POST['contract_dvr_fax'] : null;
                        $dvr_email = (isset($_POST['contract_dvr_email'])) ? $_POST['contract_dvr_email'] : null;
                        $dvr_applicable_initials = (isset($_POST['contract_dvr_initial'])) ? $_POST['contract_dvr_initial'] : null;
                        $academic = (isset($_POST['contract_academic_services'])) ? $_POST['contract_academic_services'] : -1;
                        $non_academic = (isset($_POST['contract_nonacademic_services'])) ? $_POST['contract_nonacademic_services'] : null;
                        $non_refundable = (isset($_POST['contract_nonrefundable_initial'])) ? $_POST['contract_nonrefundable_initial'] : -1;
                        $medical_transportation = (isset($_POST['contract_medical_initial'])) ? $_POST['contract_medical_initial'] : -1;
                        $communication = (isset($_POST['contract_communication_initial'])) ? $_POST['contract_communication_initial'] : -1;
                        $cancellation = (isset($_POST['contract_cancellation_initial'])) ? $_POST['contract_cancellation_initial'] : -1;
                        $signature = (isset($_POST['contract_signature'])) ? $_POST['contract_signature'] : -1;
			
		/*	echo "<p>".$student_id."</p>";
                        echo "<p>".$student_name."</p>";
                        echo "<p>".$campus_address."</p>";
                        echo "<p>".$student_phone."</p>";
                        echo "<p>".$csd_services_coordinator."</p>";
                        echo "<p>".$type_of_equipment."</p>";
                        echo "<p>".$dvr_applicability."</p>";
                        echo "<p>".$dvr_counselor."</p>";
                        echo "<p>".$dvr_address."</p>";
                        echo "<p>".$dvr_phone."</p>";
                        echo "<p>".$dvr_fax."</p>";
                        echo "<p>".$dvr_email."</p>";
                        echo "<p>".$dvr_applicable_initials."</p>";
                        echo "<p>".$academic."</p>";
                        echo "<p>".$non_academic."</p>";
                        echo "<p>".$non_refundable."</p>";
                        echo "<p>".$medical_transportation."</p>";
                        echo "<p>".$communication."</p>";
                        echo "<p>".$cancellation."</p>";
                        echo "<p>".$signature."</p>";*/

			$sql = "insert into `Student` (student_name, student_id, campus_address, student_phone, student_email, csd_services_coordinator, type_of_equipment, dvr_applicability, dvr_counselor, dvr_address, dvr_phone, dvr_fax, dvr_email, dvr_applicable_initials, academic, non_academic, non_refundable, medical_transportation, communication, cancellation, signature) values ('$student_name', '$student_id', '$campus_address', '$student_phone', '$student_email', '$csd_services_coordinator', '$type_of_equipment', '$dvr_applicability', '$dvr_counselor', '$dvr_address', '$dvr_phone', '$dvr_fax', '$dvr_email', '$dvr_applicable_initials', '$academic', '$non_academic', '$non_refundable', '$medical_transportation', '$communication', '$cancellation', '$signature')";


				$values = array($student_name,
                                                $student_id,
                                                $campus_address,
                                                $student_phone,
						$student_email,
                                                $csd_services_coordinator,
                                                $type_of_equipment,
                                                $dvr_applicability,
                                                $dvr_counselor,
                                                $dvr_address,
                                                $dvr_phone,
                                                $dvr_fax,
                                                $dvr_email,
                                                $dvr_applicable_initials,
                                                $academic,
                                                $non_academic,
                                                $non_refundable,
                                                $medical_transportation,
                                                $communication,
                                                $cancellation,
                                                $signature);

                                $stm = $db->prepare($sql);
                                $stm->execute($values);
			contractStudentEmail($student_email, $student_name);
   			include('views/defaultview.php');
                        include('views/footer.php');
                        break;

		default :
			include('views/header.php');
			include('views/sidemenu.php');
	                include('views/defaultview.php');
        	        include('views/footer.php');
			break;
	}

?>
