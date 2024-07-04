<?php include '../header.php'; ?>
   <!-- summernote -->
 
    <!-- <link href="makerequest.css" rel="stylesheet">  -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Laboratories  </h1>
           
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2"> 
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="add-new-lab-btn"  style="margin-right: 2px;"    > Add New </button>
                    <button type="button" class="btn btn-sm btn-primary"   style="margin-right: 2px;" id="handle-save-prescribe" disabled>Import</button>
                </div>  
            </div>
        </div>

        <div class="container-fluid bootstrap snippets bootdey">
            <div class="container mt-5">
                <input class="form-control" id="searchInput" type="text" placeholder="Search...">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">List Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody id="dataTable">
                    <tr>
                        <td>Example Name 1</td>
                        <td>2024-07-04</td>
                        <td>$100</td>
                        <td>Example Description 1</td>
                        <td><button class="btn btn-primary btn-sm">Edit</button></td>
                    </tr>
                    <tr>
                        <td>Example Name 2</td>
                        <td>2024-07-03</td>
                        <td>$200</td>
                        <td>Example Description 2</td>
                        <td><button class="btn btn-primary btn-sm">Edit</button></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Row</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm">
                    <div class="mb-3">
                        <label for="addName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="addName" required>
                    </div>
                    <div class="mb-3">
                        <label for="addListPrice" class="form-label">List Price</label>
                        <input type="text" class="form-control" id="addListPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="addDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="addDescription" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Row</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        
    </main>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
<script src="laboratories.js"></script>
 
<script>
 
</script>
<?php include '../footer.php'; ?> 