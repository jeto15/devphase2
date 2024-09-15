<?php include '../header.php'; ?>
 
   <!-- summernote -->
 
    <link href="med-reports.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"> Reports  </h1>
           
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
            
        <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link  " href="../sales-reports">Sales Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"  aria-current="page" href="../med-reports">Medicine Reports</a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link" href="../lab-reports">Laboratory Reports</a>
                </li> 
            </ul>

            <div class="row"> 
                <div class="container mt-5 align-items-center">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="dateInterval" class="form-label">Select Interval:</label>
                            <select id="dateInterval" class="form-select"> 
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="datePicker" class="form-label">Select Date:</label>
                            <input type="text"  autocomplete=off  id="datePicker" class="form-control" placeholder="Select a date"> 
                        </div>
                        <div class="col-md-4">
                            <div class="mt-4"> 
                                <button type="button" class="btn btn-primary" id="handle-run-report" style="margin-top: 4px;" >Run Report</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            

            <h2 class="mt-4 mb-2">Medicine Report</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead >
                        <tr>
                            <th scope="col" width="195">Date</th>
                            <th scope="col" width="120">Total QTY OUT</th> 
                            <th scope="col">Name</th>
                            <th scope="col">Brand</th>  
                            <th scope="col">Dosage Form</th>  
                            <th scope="col">Strength</th>  
                            <th scope="col">Manufacturer</th>  
                            <th scope="col">Descriptions</th>  
                  
                        </tr>
                    </thead>
                    <tbody id="sales-reulst-list-table"  >
                     
                        <!-- Add more rows as needed -->
                    </tbody> 
                </table>
            </div>

        </div> 

        <!-- Add Modal -->
        <input type="hidden" id="hd_recordid"  value="<?php echo  isset($_GET['pid'])? $_GET['pid']:''; ?>" />     
    </main>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="med-reports.js"></script>
 
<script>
 
</script>
<?php include '../footer.php'; ?> 