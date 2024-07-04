<?php include '../header.php'; ?>
   <!-- summernote -->
  
    <!-- <link href="makerequest.css" rel="stylesheet">  -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Medicine  </h1>
           
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
            <div class="container mt-5"> 
                <input class="form-control" id="searchInput" type="text" placeholder="Search...">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Dosage Form</th>
                        <th>Strength</th>
                        <th>Manufacturer</th>
                        <!-- <th>Expiry Date</th> -->
                        <th>Price</th> 
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="medicineTable">
                    <!-- Example data, replace with server-side generated data -->


                    <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="modal fade " id="laboratoryformModal" tabindex="-1" aria-labelledby="laboratoryformModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="laboratoryformModalLabel">Medicine Information Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"> 
                         <form action="your-server-endpoint" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="-- e.g Generic Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="brand" class="form-label">Brand</label>
                                        <input type="text" class="form-control" id="brand" name="brand">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="dosageForm" class="form-label">Dosage Form</label>
                                        <input type="text" class="form-control" id="dosageForm" name="dosageForm" placeholder="-- e.g., tablet, liquid, injection">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="strength" class="form-label">Strength</label>
                                        <input type="text" class="form-control" id="strength" name="strength" placeholder="-- e.g., 500 mg, 20 ml">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="manufacturer" class="form-label">Manufacturer</label>
                                        <input type="text" class="form-control" id="manufacturer" name="manufacturer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <div class="mb-3">
                                        <label for="expiryDate" class="form-label">Expiry Date</label>
                                        <input type="date" class="form-control" id="expiryDate" name="expiryDate">
                                    </div> -->
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div> 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-save-change">Submit</button>
                    </div>
                    </div>
                </div>
            </div>
        </div> 
        
    </main>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="medicine.js"></script>
 
<script>
 
</script>
<?php include '../footer.php'; ?> 