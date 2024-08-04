<?php include '../header.php'; ?>
 
   <!-- summernote -->
 
    <link href="makepatientrequest.css" rel="stylesheet"> 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"> Make Patient Request  </h1>
           
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
            <div class="row">
                <div class="col-md-4" ></div>
                <div class="col-md-4" >
                    <div class="container-request">
                        <div class="mb-3">            
                            <label for="search" class="form-label">Search Patient</label>
                            <input type="text" autocomplete=off class="form-control" id="search" placeholder="Start typing...">
                            <div id="suggestions" class="list-group"></div>
                        </div>
                        <div class="mb-3">
                            <label for="request_description" class="form-label">Request Description:</label>
                            <textarea class="form-control" id="request_description" rows="3"></textarea>
                        </div>
                     
                        <div class="mb-3">            
                            <label for="search-doctor" class="form-label">Assigned to Doctor:</label>
                            <input type="text" autocomplete=off class="form-control" id="search-doctor" placeholder="">
                            <div id="suggestions-doctor" class="list-group"></div>
                        </div>
                        <button type="submit" class="btn btn-primary"  id="btn-submit-request" >Submit</button>
                    </div>
                </div>
                <div class="col-md-4" ></div>
            </div>
        </div> 

        <!-- Add Modal -->
  
    <input type="hidden" id="hd_recordid"  value="<?php echo  isset($_GET['pid'])? $_GET['pid']:''; ?>" />     
    </main>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="makepatientrequest.js"></script>
 
<script>
 
</script>
<?php include '../footer.php'; ?> 