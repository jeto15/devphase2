<?php include '../header.php'; ?>
<?php $isStaff =  isset($_GET['stafrequestmode'])? $_GET['stafrequestmode']:''; ?>
   <!-- summernote -->
   <link rel="stylesheet" href="../resource/summernote/summernote-lite.min.css">
   

    <link href="makerequest.css" rel="stylesheet"> 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"> <a href="../patient" class="btn btn-sm btn-outline-secondary" > <span data-feather="arrow-left"></span> </a> Make Request  </h1>
           
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2"> 
                     <?php if( $isStaff == '' ){ ?>
                    <button type="button" class="btn btn-sm btn-primary"   style="margin-right: 2px;" id="handle-save-prescribe" disabled>Save Request</button>
                    <?php } ?>
                </div>  
            </div>
        </div>

        <div class="container-fluid bootstrap snippets bootdey">
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
                </div>


            </div>
            <div class="profile-info col"> 
                <div class="panel">
                    <div class="panel-body bio-graph-info">
                        <h1>Bio Graph </h1>
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

            </div>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Request Description:</h4>
                <p id="p-description-request" ></p>
            </div>
        </div>

        <div class="row profile-input-description" >
            <div class="btn-group-manageitems" >
                <button type="button" class="btn btn-sm btn-primary"   style="margin-right: 2px;" id="handle-open-lab"  data-bs-toggle="modal" data-bs-target="#productLabModal"    > Add Laboratories </button>
                <button type="button" class="btn btn-sm btn-primary"   style="margin-right: 2px;" id="handle-open-med" data-bs-toggle="modal"  data-bs-target="#productMedModal"  > Add Medicine </button>
                <button type="button" class="btn btn-sm btn-primary"   style="margin-right: 2px;" id="handle-open-custom" data-bs-toggle="modal"  data-bs-target="#productCustModal"  > Add Custom Request </button>
            </div> 
                         
            <?php if( $_SESSION['usernmake-request-prescription-laboratoriesame'] == 1 ){ ?>
            <?php if( $_SESSION['make-request-prescription'] == 0 || $isStaff == '1' ){ ?>
            <div  class="col-md-12" style="border-right: 1px dotted;">
            <?php }else { ?>
            <div  class="col-md-6" style="border-right: 1px dotted;">
            <?php } ?>
                <div class="panel" >
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h6>Diagnostic/Laboratories</h6>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <!-- <div class="btn-group me-2">
                                <a class="btn btn-sm btn-outline-secondary request-add-lab"  data-bs-toggle="modal"  data-bs-target="#addLaboratories"  data-descript-tab="dl" > Add  </a>
                                <a class="btn btn-sm btn-outline-secondary request-add-lab"  data-bs-toggle="modal"  data-bs-target="#addLaboratories"  data-descript-tab="dl" >  Other  </a>
                            </div> -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table   table-sm">
                        <thead>
                            <tr>
                            <th scope="col" style="width: 62%;">Description</th>
                            <th scope="col">Unit Price</th>   
                            <th scope="col">Adjusted Price</th>
                            <th scope="col" style="width: 18%;">Action</th> 
                            </tr> 
                        </thead> 
                        <tbody id='table-selected-lab-list-front-lab' >
                       
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel" >
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h6>Prescribed Medicine</h6>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <!-- <div class="btn-group me-2">
                                <a class="btn btn-sm btn-outline-secondary request-add-lab"  data-bs-toggle="modal"  data-bs-target="#addLaboratories"  data-descript-tab="dl" > Add  </a>
                                <a class="btn btn-sm btn-outline-secondary request-add-lab"  data-bs-toggle="modal"  data-bs-target="#addLaboratories"  data-descript-tab="dl" >  Other  </a>
                            </div> -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  table-sm">
                        <thead>
                            <tr>
                            <th scope="col">    Description</th>
                            <th scope="col">Qty</th>   
                            <th scope="col">Adjusted Qty</th>   
                            <th scope="col">Unit Price</th>      
                            <th scope="col">Adjusted Price</th>    
                            <th scope="col">Total Price</th>                            
                            <th scope="col" style="width: 18%;">Action</th> 
                            </tr> 
                        </thead> 
                        <tbody id='table-selected-lab-list-front-Med' >
                       
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel" >
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h6>Other Request</h6>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <!-- <div class="btn-group me-2">
                                <a class="btn btn-sm btn-outline-secondary request-add-lab"  data-bs-toggle="modal"  data-bs-target="#addLaboratories"  data-descript-tab="dl" > Add  </a>
                                <a class="btn btn-sm btn-outline-secondary request-add-lab"  data-bs-toggle="modal"  data-bs-target="#addLaboratories"  data-descript-tab="dl" >  Other  </a>
                            </div> -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  table-sm">
                        <thead>
                            <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Amount Fee</th>  
                            <th scope="col" style="width: 18%;">Action</th> 
                            </tr> 
                        </thead> 
                        <tbody id='table-selected-lab-list-front-Other' >
                       
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel" >
                    <div class="" >
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-sm border-0 rounded-lg">
                                <div class="card-header  text-center">
                                    <h4 class="mb-0">Total Amount</h4>
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="card-title text-center">Order Summary</h5>
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <span>Senior Discount:</span>
                                        <span>0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <span>DPWD Discount:</span>
                                        <span> 0.00</span>
                                    </div> 
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <span class="font-weight-bold">Total:</span>
                                        <span class="font-weight-bold" id="total-amount-to-pay">$115.00</span>
                                    </div>
                                </div>
                                <div class="card-footer bg-light text-center">
                                    <button class="btn btn-primary">Print Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if( $_SESSION['make-request-prescription'] == 1 && $isStaff == '' ){ ?>
            <div  class="col-md-6">
                <div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                <h6>Subjective complaints</h6>
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <div class="btn-group me-2">
                                        <a class="btn btn-sm btn-outline-secondary request-add-description" data-descript-tab="sc" > Save Draft</a>
                                    </div> 
                                </div>
                            </div>
                            <div class="input-subs-complaints">          
                                <textarea id="inputsubcomplaints" class="summernote-textarea"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                <h6>Assessment/Physical Exam:</h6>
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <div class="btn-group me-2">
                                        <a class="btn btn-sm btn-outline-secondary request-add-description" data-descript-tab="ap" > Save Draft</a>
                                    </div>
                                </div>
                            </div> 
                            <div class="input-assesmentandphysicalexam">
                                <textarea id="inputassesmentandphysicalexam" class="summernote-textarea"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row  mb-4">
                        <div class="col">
                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                    <h6>Plan/Treatment</h6>
                                    <div class="btn-toolbar mb-2 mb-md-0">
                                        <div class="btn-group me-2">
                                            <a  class="btn btn-sm  btn-primary  " href="../printprescription?id=<?php echo $_GET['id'];?>&presid=<?php echo  isset($_GET['presid'])? $_GET['presid']:''; ?>"  target="_blank"  >  Print as PDF </a>
                                            <a class="btn btn-sm btn-outline-secondary request-add-description" data-descript-tab="pt" > Save Draft</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="input-plantandtreatment">          
                                    <textarea id="inputplantandtreatment" class="summernote-textarea"></textarea>
                                </div>
                        </div>
    
                    </div>
                    <div class="row  mb-4"> 
                        <div class="col-md-12"> 
                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                    <h6>Impression</h6>
                                    <div class="btn-toolbar mb-2 mb-md-0">
                                        <div class="btn-group me-2">
                                            <a class="btn btn-sm btn-outline-secondary request-add-description" data-descript-tab="imp" > Save Draft</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-impression">          
                                    <textarea id="inputimpression" class="summernote-textarea"></textarea>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        </div>

 


        <?php include '_manage_laboratories.php'; ?>
        <?php include '_manage_medicine.php'; ?>
        <?php include '_manage_customrequest.php'; ?>
    </main>
 
    <input type="hidden" id="hd_recordid"  value="<?php echo  isset($_GET['id'])? $_GET['id']:''; ?>" />
    <input type="hidden" id="hd_prescribe_id"  value="<?php echo  isset($_GET['presid'])? $_GET['presid']:''; ?>" />
    <input type="hidden" id="hd_restric_statuspaid_action"  value="<?php echo  isset( $_SESSION['make-request-prescription-paidstatus'] )?  $_SESSION['make-request-prescription-paidstatus'] :''; ?>" />

<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="makerequest.js"></script>
<script src="_manage_laboratories.js"></script>
<script src="_manage_medicine.js"></script>
<script src="_manage_customrequest.js"></script>
<script src="../resource/summernote/summernote-lite.min.js"></script>
 
 
<?php include '../footer.php'; ?> 