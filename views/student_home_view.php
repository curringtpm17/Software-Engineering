<!-- Modifications - Paulette Currington-->

<html ng-app="csdapp">

<head lang="en">

	<meta charset="utf-8">

	<!-- Set the viewport so this responsive site displays correctly on mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Ensures correct rendering in IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<title>Student Home</title>

	<!-- Include bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">

	<!-- Include jQuery library -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

	<!-- Include Bootstrap jQuery -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>

	<!-- Include Ajax - Angular -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>


	<!-- Include custom css rules -->
	<link rel="stylesheet" href="style.css">

        <!-- Include Custom Scripting -->
        <script src="scripts.js"></script>

</head>

<body id="studentHomePage">

<!-- Navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">

        <!-- Navbar Header -->
        <div class="navbar-header">

            <!-- Page Title -->
            <a class="navbar-brand" id="title" href="#">Student Home</a>

        </div>
    </div>
</nav>

<!--Tabs-->
<div class="container">
<div ng-controller="mainController">
  <ul class="nav nav-tabs">

    <li class="active"><a href="#staffHome"data-toggle="tab">Staff Home</a></li>
		<li><a href="#profile" data-toggle="tab">Profile</a></li>
    <li><a href="#studentCalendar" data-toggle="tab" ng-click="viewAdmin()">Student Calendar</a></li>
    <li><a href="#classScheduler" data-toggle="tab">Class Scheduler</a></li>
    <li><a href="rideRequest" data-toggle="tab">Ride Request</a></li>
    <li><a href="#cancelRide" data-toggle="tab">Cancel Ride</a></li>
  </ul>
  <br>

<div class="tab-content">


    <div id="home" class="tab-pane fade in active">
      <h3>Student Home</h3>
      <p>Welcome!</p>
      <!--TO DO: add display for daily ride schedule for student-->
    </div>

<div id="profile" class="tab-pane fade">
      <h3>Profile Information</h3>
			<table class="table">
        <tr>
          <th>NetID:</th><th><input ng-model="update_netid" type="text" name="update_netid" id="update_netid"/></th>
          </tr>
          <tr>
            <th>Password:</th><th><input ng-model="update_password" type="text" name="update_password" id="update_password"/></th>
            </tr>
				<tr>
					<th>Student Name:</th><th><input type="text" name="update_student_name" id="update_student_name"/></th>
					</tr>
					<tr>
						<th>Student ID#:</th><th><input ng-model="update_id" type="text" name="update_id" id="update_id"/></th>
						</tr>
					<tr>
					<th>Campus Address:</th><th><input ng-model="update_address" type="text" name="update_address" id="update_address"/></th>
					</tr>
					<tr>
					<th>Phone:</th><th><input ng-model="update_phone" type="text" name="update_phone" id="update_phone"/></th>
					</tr>
          <tr>
					<th>Email:</th><th><input ng-model="update_email" type="text" name="update_email" id="update_email"/></th>
					</tr>
					<tr>
					<th>Equipment Type:</th><th><select ng-model="update_equipment_type" name="update_equipment_type" id="update_equipment_type"/>
						<option value="Power Wheelchair">Power Wheelchair</option>
						<option value="Manual Wheelchair">Manual Wheelchair</option>
            <option value="Other">Other</option>
				</select></th>
					</tr>
		</table>

		<input ng-click="updateAdmin()" type="button" value="Update" class="btn btn-primary btn-block" id="updateBtn"/>

		<strong><span name="updatesuccessMessage">{{updatesuccessMessage}}</span></strong>
		<strong><span name="updateerrorMessage" style="color:red">{{updateerrorMessage}}</span></strong>

    </div>

<!---This is the create admin section- it is currently functional with validation.-->
    <div id="studentCalendar" class="tab-pane fade">
      <h3>Student Calendar</h3>
      <!--Display Calendar View from Google-->

		</div>

    <div id="classScheduler" class="tab-pane fade">
      <h3>Class Scheduler</h3>
      <!--Embed Google Form or create forms-->

    </div>

    <div id="rideRequest" class="tab-pane fade">
      <h3>Class Scheduler</h3>
      <!--Embed Google Form or create forms-->
	<button type = "button" id = "add"> Add Ride </button>
<!--<form id = "form1">
        <b> Ride Name: </b> <input type = "text" name = "ride">
        <br><br>
        <b> Pick Up Location: </b>
                <select name = "pickup">
                        <option value = "alumni"> Alumni Center </option>
                        <option value = "arey"> Arey Hall </option>
                </select>
        <br><br>
        <b> Destination: </b>
                <select name = "dest">
                        <option value = alumni"> Alumni Center </option>
                        <option value = "arey"> Arey Hall </option>
                </select>
        <br><br>
        <b> Start Time: </b> <input type = "text" name = "start">
        <input type = "radio" name = "stime" value = "AM">
        <input type = "radio" name = "stime" value = "PM">
        <br><br>
        <b> End Time: </b> <input type = "text" name = "end">
        <input type = "radio" name = "etime" value = "AM">
        <input type = "radio" name = "etime" value = "PM">
        <br><br>
        <b> Days of the Week </b>
        <input type = "checkbox" name = "day" value = "mon"> Monday
        <input type = "checkbox" name = "day" value = "tue"> Tuesday
        <input type = "checkbox" name = "day" value = "wed"> Wednesday
        <input type = "checkbox" name = "day" value = "thu"> Thursday
        <input type = "checkbox" name = "day" value = "fri"> Friday
        <input type = "checkbox" name = "day" value = "sat"> Saturday
        <input type = "checkbox" name = "day" value = "sun"> Sunday
        <br><br>
        <b> Frequency </b>
        <input type = "checkbox" name = "fre" value = "sem"> Semester
        <input type = "checkbox" name = "fre" value = "onc"> Once
        <br><br>
        <b> Round Trip </b>
        <input type = "checkbox" name = "trip" value = "round"> Round Trip
        <br><br>
        <button type = "button" id = "submit"> Submit </button>
        <button type = "button" id = "clear"> Clear </button>
</form>
    -->
</div>

    <div id="cancelRide" class="tab-pane fade">
      <h3>Cancel Ride</h3>
      <!--Embed Google Form or create forms-->
    </div>


</div>
</div>
<!--CreateForm Script

<script>

var adminapp = angular.module('adminapp', []);

//creates admin user in Create Administrator
adminapp.controller('mainController',function($scope,$http){
	$scope.user_admin;


	$scope.clearForm = function(){
		$scope.user_name = null;
		$scope.pwd = null;
		$scope.first = null;
		$scope.last = null;
		$scope.type = null;
		$scope.email = null;
		$scope.successMessage = null;
	}

	$scope.updateAdmin = function(){
		$http({

			method: 'PUT',
			url: 'http://localhost/IDPWebDev/ia_webservices/public/administrator',
			data: {user_name: $scope.user_name,
						pwd: $scope.pwd,
						first: $scope.first,
						last: $scope.last,
						type:	$scope.type,
						email:	$scope.email}
		}).then(function (response){
				console.log("success");
				$scope.updatesuccessMessage = "Information updated successfully.";
		}, function (response){
				console.log(response.data, response.status);
				$scope.updateerrorMessage = "*There was a problem updating your information.";

		});
	};

	$scope.createAdmin = function(){
		$http({

			method: 'POST',
			url: 'http://localhost/IDPWebDev/ia_webservices/public/administrator',
			data: {user_name: $scope.user_name,
						pwd: $scope.pwd,
					 	first: $scope.first,
					 	last: $scope.last,
						type:	$scope.type,
						email:	$scope.email}
		}).then(function (response){
				console.log("success");
				$scope.successMessage = $scope.first + " " + $scope.last + " is now an administrator.";
		}, function (response){
				console.log(response.data, response.status);
				$scope.errorMessage = "*Please fill all required fields.";

		});


	};

//gets all admins info in View Administrators
	    $scope.viewAdmin = function(){
	          $http({
	              method: 'GET',
	              url: 'http://localhost/IDPWebDev/ia_webservices/public/administrators'
	          }).then(function(response) {
	              // on success
	              $scope.user_admin = response.data;

	          }, function (response) {
	              // on error
	              console.log(response.data,response.status);
	          });
	    };

			$scope.search = function(){
	          $http({
	              method: 'GET',
	              url: 'http://localhost/IDPWebDev/ia_webservices/public/administrator'
	          }).then(function(response) {
	              // on success
	              $scope.user_admin = response.data;

	          }, function (response) {
	              // on error
	              console.log(response.data,response.status);
	          });
	    };


			 });

</script>-->
</body>
</html>
