
<div ng-controller="contractController">
<div class="col-sm-9">
    <h3>Contract for Adaptive Transportation Services</h3>
    <form id="contractform" name="contractform">
  <div class="row">
        <div class="col-sm-6">
                <div class="form-group">
                  <label>Name*</label>
                  <input ng-model="contract_name" class="form-control" type="text" name="contract_name" id="contract_name" required/>
                </div>

        </div>
        <div class="col-sm-6">
                <div class="form-group">
                  <label>Student ID*</label>
                  <input ng-model="contract_student_id" class="form-control" type="contract_student_id" name="contract_student_id" id="contract_student_id" required/>
                </div>

        </div>
  </div>

  <div class="row">
        <div class="col-sm-6">
                <div class="form-group">
                  <label>Campus Address*</label>
                  <input ng-model="contract_campus_address" class="form-control" type="text" name="contract_campus_address" id="contract_campus_address" required/>
                </div>

        </div>
        <div class="col-sm-6">
                <div class="form-group">
                  <label>Phone Number*</label>
                  <input ng-model="contract_phone_number" class="form-control" type="contract_phone_number" name="contract_phone_number" id="contract_phone_number" required/>
                </div>

        </div>
  </div>

  <div class="row">
        <div class="col-sm-6">
                <div class="form-group">
                  <label>CSD Services Coordinator*</label>
                  <input ng-model="contract_csd_services_coordinator" class="form-control" type="text" name="contract_csd_services_coordinator" id="contract_csd_services_coordinator" required/>
                </div>

        </div>
    </div>

    <div class="row">
          <div class="col-sm-6">
                  <div class="form-group">
                    <h3>Type of Equipment*</h3>
                    <input ng-model="contract_wc" type="checkbox">
                      <label>Power Wheelchair</label><br/>
                    <input ng-model="contract_wc" type="checkbox">
                      <label>Manual Wheelchair</label><br/>
                     </div>
                   </div>
                 </div>

     <div class="row">
           <div class="col-sm-6">
                   <div class="form-group">
                     <h3>DVR*</h3>
                     <input ng-model="contract_dvr" type="checkbox" ng-checked="contract_dvr == 'T'">
                       <label>I have and will use DVR this semester.</label><br/>
                      <input ng-model="contract_dvr" type="checkbox">
                       <label>I do not have DVR, or will not be using DVR this semester.</label><br/>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                        <div class="col-sm-6">
                                <div class="form-group" ng-show="contract_dvr == 'T'">
                                  <h3>DVR Information*</h3>
                                  <label>DVR Counselor*</label>
                                  <input ng-model="contract_dvr_counselor" class="form-control" type="text" name="contract_dvr_counselor" id="contract_dvr_counselor" required/>
                                    </label><br/>
                                    <label>DVR Address*</label>
                                    <input ng-model="contract_dvr_address" class="form-control" type="text" name="contract_dvr_address" id="contract_dvr_address" required/>
                                      </label><br/>
                                   </div>
                                 </div>
                               </div>

                 <div class="row">
                       <div class="col-sm-6">
                               <div class="form-group" ng-show="contract_dvr == 'T'">

                                 <label>DVR Phone*</label>
                                 <input ng-model="contract_dvr_phone" class="form-control" type="text" name="contract_dvr_phone" id="contract_dvr_phone" required/>
                                   </label><br/>
                                   <label>DVR E-mail*</label>
                                   <input ng-model="contract_dvr_email" class="form-control" type="text" name="contract_dvr_email" id="contract_dvr_email" required/>
                                     </label><br/>
                                  </div>
                                </div>
                              </div>
                <div class="row">
                      <div class="col-sm-6">
                              <div class="form-group" ng-show="contract_dvr == 'T'">
                                  <h3>DVR Initials*</h3>
                                  <p>By adding my initials I understand that if DVR does not cover the cost of this request for services, it will be my responsibility to pay for the level of service requested. I understand that Adaptive Transportation Services is obligated to inform DVR if I am not utilizing the services agreed upon in this contract. It is my responsibility to inform the Transportation Coordinator at 262-472-4712 or transcsd@uww.edu, if I have concerns regarding services, or no longer want to participate in services.</p>
                                  <label>Initial Here*</label>
                                  <input ng-model="contract_dvr_initial" class="form-control" type="text" name="contract_dvr_inital" id="contract_dvr_initial" required/>
                                    </label><br/>
                                 </div>
                               </div>
                             </div>

                 <div class="row">
                       <div class="col-sm-6">
                               <div class="form-group">
                                 <h3>Service(s) to be Requested*</h3>
                                 <p>Academic & Non-Academic Hours</p>
                                 <table>
                                    <tr><td>Monday - Thursday:</td><td>7:15 am - 10:00 pm</td></tr>
                                    <tr><td>Friday:</td><td>7:15 am - 10:00 pm</td></tr>
                                    <tr><td>Saturday (appointment only):</td><td>4:00 pm - 9:00 pm</td></tr>
                                    <tr><td>Sunday:</td><td>Closed</td></tr>
                                  </table>
                                  <p>CSD Transportation will be closed for Spring Break.</p>
                                <h3>Academic</h3>
                                   <input ng-model="contract_academic_services" type="checkbox">
                                   <label>Full Semester ($2,400)</label><br/>
                                  <input ng-model="contract_academic_services" type="checkbox">
                                 <label>Winter Only ($1,500)</label><br/>

                                  <h3>Non-Academic</h3>
                                  <input ng-model="contract_nonacademic_services" type="checkbox">
                                   <label>Full Semester ($250)</label><br/>
                                  </div>
                                </div>
                              </div>


              <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                              <h3>Please Read and Initial All*</h3>
                             <h4>Non-refundable*</h4>
                                <label>Adaptive Transportation Contracts are non-refundable.</label><br/>
                              <input ng-model="contract_nonrefundable_initial" type="text">
                                <h4>Medical Transportation*</h4>
                              <label>UW-Whitewater Adaptive Transportation does not provide medical transportation.</label><br/>
                              <input ng-model="contract_medical_initial" type="text">
                              <h4>Communication*</h4>
                            <label>Communication will be done primarily through your UW-Whitewater email account & personal cell phone number.</label><br/>
                            <input ng-model="contract_communication_initial" type="text">
                            <h4>Cancellation*</h4>
                          <label>A minimum fee of $100 will be charged for administrative costs for cancellation of contracts.</label><br/>
                          <input ng-model="contract_cancellation_initial" type="text">
                          <h4>Signature*</h4>
                        <label>Parent signature required if under age 18</label><br/>
                        <input ng-model="contract_signature_initial" type="text">
                               </div>
                             </div>
                           </div>


    <div class="row">
      <div class="form-group" id="formBtns">
        <input ng-click="clearForm()" type="button" value="Clear" class="btn" id="clearBtn"/>
        <input ng-click="addStudent()" type="button" value="Submit" class="btn btn-primary btn-block" id="submitBtn"/>
      </div>
    </div>
</form>
</div>
</div>

<script>
var csdapp = angular.module('csdapp', []);

csdapp.controller('contractController', function($scope, $http){
		$scope.student;
		$scope.addStudent = function(){
			console.log("made it to ajax call");
			$http.post("index.php?mode=addStudentProcess", {
				data:{student_name: $scope.contract_name,
				student_id:$scope.contract_student_id,
				campus_address:$scope.contract_campus_address,
				student_phone:$scope.contract_phone_number,
				csd_services_coordinator:$scope.contract_csd_services_coordinator,
				academic:$scope.contract_academic_services,
				non_academic:$scope.contract_nonacademic_services,
				dvr_counselor:$scope.contract_dvr_counselor,
				dvr_address:$scope.contract_dvr_address,
				dvr_phone:$scope.contract_dvr_phone,
				dvr_fax:$scope.contract_dvr_fax,
				dvr_email:$scope.contract_dvr_email,
				dvr_applicable_initials:$scope.contract_dvr_initial,
				non_refundable:$scope.contract_nonrefundable_initial,
				medical_transportation:$scope.contract_medical_initial,
				communication:$scope.contract_communication_initial,
				cancellation:$scope.contract_cancellation_initial,
				signature:$scope.contract_signature_initial,
				type_of_equipment:$scope.contract_wc,
				dvr_applicability:$scope.contract_dvr}
			}).then(function (response){
				console.log("success");
			}, function (response){
				console.log(response.data, response.status);
			});
		};
});

</script>
