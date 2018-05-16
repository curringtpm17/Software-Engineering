<?php
if(isset($data) && isset($_SESSION['student_id']))
{

echo "
  <div class='container'>
  <div id='profile' class='col-xs-9'>
        <h3>Profile Information</h3>
  			<table class='table'>
	<tr>
		<th>Student Name:</th>
            <th>
              <input type='text' name='update_student_name' id='update_student_name' value='{$data['student_name']}'/>
            </th>
					</tr>
					<tr>
						<th>Student ID#:</th>
              <th>
                <input ng-model='update_id' type='text' name='update_id' id='update_id' value='{$data['student_id']}'/>
              </th>
						</tr>
					<tr>
					<th>Campus Address:</th>
            <th>
              <input ng-model='update_address' type='text' name='update_address' id='update_address' value='{$data['campus_address']}'/>
            </th>
					</tr>
					<tr>
					<th>Phone:</th>
            <th>
              <input ng-model='update_phone' type='text' name='update_phone' id='update_phone' value='{$data['student_phone']}'/>
            </th>
					</tr>
          <tr>
					<th>Email:</th>
            <th>
              <input ng-model='update_email' type='text' name='update_email' id='update_email' value='{$data['email']}'/>
            </th>
					</tr>
					<tr>
					<th>Equipment Type:</th>
            <th>
              <select ng-model='update_equipment_type' name='update_equipment_type' id='update_equipment_type'>
    						<option value='Power Wheelchair'>Power Wheelchair</option>
    						<option value='Manual Wheelchair'>Manual Wheelchair</option>
                <option value='Other'>Other</option>
				       </select>
             </th>
					</tr>
		</table>

		<input ng-click='updateAdmin()' type='button' value='Update' class='btn btn-primary btn-block' id='updateBtn'/>
  </div>
";
}
 else {
?>

<!-- *************************************HTML PAGE BEGIN************************************* -->

<div class="container">
  <div id="profile" class="col-xs-9">
    <h3>Profile Information</h3>
		<table class="table">
      <tr>
       
			<tr>
				<th>Student Name:</th>
          <th>
            <input type="text" name="update_student_name" id="update_student_name"/>
          </th>
  			</tr>
			<tr>
				<th>Student ID#:</th>
          <th>
            <input ng-model="update_id" type="text" name="update_id" id="update_id"/>
          </th>
				</tr>
			<tr>
			<th>Campus Address:</th>
        <th>
          <input ng-model="update_address" type="text" name="update_address" id="update_address"/>
        </th>
			</tr>
			<tr>
			<th>Phone:</th>
        <th>
          <input ng-model="update_phone" type="text" name="update_phone" id="update_phone"/>
        </th>
			</tr>
      <tr>
			<th>Email:</th>
        <th>
          <input ng-model="update_email" type="text" name="update_email" id="update_email"/>
        </th>
			</tr>
			<tr>
			<th>Equipment Type:</th>
        <th>
          <select ng-model="update_equipment_type" name="update_equipment_type" id="update_equipment_type">
						<option value="Power Wheelchair">Power Wheelchair</option>
						<option value="Manual Wheelchair">Manual Wheelchair</option>
            <option value="Other">Other</option>
		       </select>
         </th>
			</tr>
		</table>

		<input ng-click="updateAdmin()" type="button" value="Update" class="btn btn-primary btn-block" id="updateBtn"/>
  </div>

<?php
}
?>
