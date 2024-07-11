<?php include '../header.php'; ?>
 
    <link href="patientprofile.css" rel="stylesheet"> 
    
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"> <a href="../patient" class="btn btn-sm btn-outline-secondary" > <span data-feather="arrow-left"></span> </a> Patients Profile  </h1>
           
            <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a class="btn btn-sm btn-outline-secondary" href="../makepatientrequest/?pid=<?php echo $_GET['id'];?>"    >Make a Request</a>
                <!-- <button type="button" class="btn btn-sm btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#addNewPatients" data-bs-whatever="@mdo">Add New</button>
             -->
                <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
            </div>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button> -->
            </div>
        </div>

        <div class="container bootstrap snippets bootdey">
        <div class="row">
        <div class="profile-nav col-md-3">
            <div class="panel">
                <div class="user-heading round">
                    <a href="#">
                        <img id="profile-avatar-image" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                    </a>
                    <h1 class="profile-avatar-name" ></h1>
                    <p class="profile-avatar-patientnumber" ></p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="../capturepicture/?id=<?php echo $_GET['id'];?>"><span data-feather="instagram"></span>  Update Profile Picture</a></li>
                    <!-- <li><a href="#"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-warning pull-right r-activity">9</span></a></li>
                    <li><a href="#"> <i class="fa fa-edit"></i> Edit profile</a></li> -->
                </ul>
            </div>
        </div>
        <div class="profile-info col-md-9"> 
            <div class="panel">
                <div class="panel-body bio-graph-info">
                    <h1>Bio Graph</h1>
                    <div class="row">
                        <div class="bio-row">
                            <p><span class="patient-label" >First Name </span> <span   id="fname-name"> </span>  </p>
                        </div>
                        <div class="bio-row">
                            <p><span class="patient-label" >Last Name </span> <span id="lname-name"> </span> </p>
                        </div>
                        <div class="bio-row">
                            <p><span class="patient-label" >Adress </span> <span id="address-text"> </span> </p>
                        </div>
                        <div class="bio-row">
                            <p><span class="patient-label" >Birthday</span> <span id="bday-name"> </span></p>
                        </div>
                        <div class="bio-row">
                            <p><span class="patient-label">Age </span> <span id="age-name"> </span></p>
                        </div>
                        <div class="bio-row">
                            <p><span class="patient-label" >Gender </span> <span id="sex-name"> </span></p>
                        </div>
                        <div class="bio-row">
                            <p><span class="patient-label" >Patient # </span> <span id="patient-num-name"> </span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-12">
                            <h4>History Request</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                    <!-- 
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Rquest</th>  -->
                                    <th scope="col">Date Requested</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th> 
                                    </tr> 
                                </thead>
                                <tbody id='table-patient-prescribe-list' >
                                </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

    </main>

    <input type="hidden" id="hd_recordid"  value="<?php echo $_GET['id'];?> " />

<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="patientprofile.js"></script>

<?php include '../footer.php'; ?> 