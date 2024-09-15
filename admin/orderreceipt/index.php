<?php include '../header.php'; ?>
   <!-- summernote -->
  
    <link href="orderreceipt.css" rel="stylesheet"> 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"> OR Management  </h1>
           
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2"> 
                <button type="button" class="btn btn-sm btn-outline-secondary" id="add-new-lab-btn"  style="margin-right: 2px;"    > Add New </button>
                    <button type="button" class="btn btn-sm btn-primary"   style="margin-right: 2px;" id="handle-save-prescribe" disabled>Import CSV</button>
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
            <div class="row"> 
                <div class="col-md-12" >
                    <div class="or-container"> 
                        <h6>OR Information</h6>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Enter OR Number</label>
                            <div class="col-sm-6">
                                <input type="Text" class="form-control" id="inputornumber">
                            </div>
                            <button type="button" id="handlesaveor" class="btn btn-primary col-sm-2">Add</button>
                        </div>  
                    </div>
                    <h6>OR List</h6>
                    <input class="form-control" id="searchInput" type="text" placeholder="Search OR#">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>OR#</th>
                            <th>Status</th>
                            <th>Created Date</th> 
                        </tr>
                        </thead>
                        <tbody id="orlisttable">
                        <!-- Example data, replace with server-side generated data -->


                        <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div> 
 
        </div> 
        
    </main>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="orderreceipt.js"></script>
 
<script>
 
</script>
<?php include '../footer.php'; ?> 