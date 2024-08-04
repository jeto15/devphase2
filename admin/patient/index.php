<?php include '../header.php'; ?>
 
    <link href="patientpage.css" rel="stylesheet"> 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Patients Record</h1>

            <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary " id="addNewPatientBtn"   data-bs-toggle="modal"  data-bs-target="#addNewPatients" data-bs-whatever="@mdo">Add New</button>
            </div>
            </div>
        </div>
        <div class="toast-container position-absolute top-5 end-0 p-3">
            <div id="alertMed" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <!-- <img src="..." class="rounded me-2" alt="..."> -->
                    <strong class="me-auto">Save Change</strong>
                    <small>Record has been updated</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>
        </div>
        
        <div class="container-fluid bootstrap snippets bootdey"> 
            <div class="container mt-5">
                <div class="table-responsive">
                    
                    <input type="text" autocomplete=off placeholder="Search Patient" class="form-control" id="handle-search-patient">
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Created Date</th>
                        <th scope="col">Patient #</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Middle Name</th>
                        <th scope="col">Contact #</th>
                        <th scope="col">Action</th>
                        </tr> 
                    </thead>
                    <tbody id='table-patient-list' >
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        


        <div class="modal fade" id="addNewPatients" tabindex="-1" aria-labelledby="addNewPatientsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewPatientsLabel">New Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                <div class="mb-3">
                    <label for="patient-num-name" class="col-form-label">Patient #:</label>
                    <input type="text" autocomplete=off class="form-control" id="patient-num-name"><br>
                    <div class="alert-exist-patient" > </div>
                </div>
                <div class="row" >
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="fname-name" class="col-form-label">First Name:</label>
                            <input type="text" autocomplete=off class="form-control" id="fname-name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="lname-name" class="col-form-label">Last Name:</label>
                            <input type="text" autocomplete=off class="form-control" id="lname-name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="mname-name" class="col-form-label">Middle Name:</label>
                            <input type="text" autocomplete=off class="form-control" id="mname-name">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="age-name" class="col-form-label">Age:</label>
                    <input type="text" autocomplete=off class="form-control" id="age-name">
                </div>
                <div class="mb-3">
                    <label for="sex-name" class="col-form-label">Sex:</label>
                    <!-- <input type="text" autocomplete=off class="form-control" id="sex-name"> -->
                    <!-- Default radio -->
                    <div class="form-check">
                    <input class="form-check-input get-gender-radiobtn gender-Male" value="Male" type="radio" name="gender-radiobtn" id="gender-radiobtn1" checked/>
                    <label class="form-check-label" for="gender-radiobtn1"> Male </label>
                    </div>

                    <!-- Default checked radio -->
                    <div class="form-check">
                    <input class="form-check-input get-gender-radiobtn gender-Female" value="Female" type="radio" name="gender-radiobtn" id="gender-radiobtn2" />
                    <label class="form-check-label " for="gender-radiobtn2"> Female </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="bday-name" class="col-form-label">Birth Day:</label>
                    <!-- <input type="text" autocomplete=off class="form-control" id="bday-name"> -->
                    <input type="text" autocomplete=off name="birthday" value="" id="bday-name"/>
                </div> 
                <div class="mb-3">
                    <label for="address-text" class="col-form-label">Address:</label>
                    <textarea class="form-control" id="address-text"></textarea>
                </div>
                <div class="mb-3">
                    <label for="contact-number-text" class="col-form-label">Contact Number:</label>
                    <input type="text" autocomplete=off class="form-control" name="contact-number" value="" id="contact-number-text"/> 
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="handle-save-patient" >Save</button>
            </div>
            </div>
        </div>
        </div>
    </main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="patientpage.js"></script>
<script src="bootstrap-birthday.js"></script>

<?php include '../footer.php'; ?> 