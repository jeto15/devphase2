<?php include '../header.php'; ?>
 
   <!-- summernote --> 
    <link href="requestbasemonitoring.css" rel="stylesheet"> 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"> Request Base Monitoring  </h1>
           
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- <div class="btn-group me-2"> 
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="add-new-lab-btn"  style="margin-right: 2px;"    > Add New </button>
                    <button type="button" class="btn btn-sm btn-primary"   style="margin-right: 2px;" id="handle-save-prescribe" disabled>Import</button>
                </div>   -->
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
                    Hello, world! This is a toast message...
                </div>
            </div>
        </div>

   
        <div class="container-fluid bootstrap snippets bootdey">
            <div class="row" >
                <div class="col-md-6">
                    <div class="status-container bg-info text-dark">
                        <h5>Draft</h5>
                    </div>
                </div>
                <div class="col-md-6">    
                    <div class="status-container bg-primary">                    
                        <h5>To Billing</h5>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-6">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                            <thead>
                                <tr> 
                                    <th scope="col">Requested Date</th>  
                                    <th scope="col">Patient #</th>
                                    <th scope="col">Patient Name</th> 
                        
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-request-list-draft">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">                        
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                            <thead>
                                <tr> 
                                    <th scope="col">Requested Date</th>  
                                    <th scope="col">Patient #</th>
                                    <th scope="col">Patient Name</th> 
                        
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-request-list-tobill">

                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>

         
        </div>

        <div class="container-fluid bootstrap snippets bootdey">
            <div class="row" >
                <div class="col-md-6">
                    <div class="status-container bg-danger">
                        <h5>Canceled / Void</h5>
                    </div>
                </div> 
                
                <div class="col-md-6">
                    <div class="status-container bg-success">
                        <h5>Billing Complete</h5>
                    </div>
                </div>
               
            </div>
            <div class="row" >
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr> 
                                    <th scope="col">Requested Date</th>  
                                    <th scope="col">Patient #</th>
                                    <th scope="col">Status</th> 
                                    <th scope="col">Reason</th>
                                    <th scope="col">Patient Name</th> 
                        
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-request-list-cancel">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr> 
                                    <th scope="col">Requested Date</th>  
                                    <th scope="col">Patient #</th>
                    
                                    <th scope="col">Patient Name</th> 
                        
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-request-list-billcom">

                            </tbody>
                        </table>
                    </div>
                </div>
             
            </div>

         
        </div>

   
 
    <input type="hidden" id="hd_recordid"  value="<?php echo  isset($_GET['pid'])? $_GET['pid']:''; ?>" />     
    </main>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="requestbasemonitoring.js"></script>
 
<script>
 
</script>
<?php include '../footer.php'; ?> 