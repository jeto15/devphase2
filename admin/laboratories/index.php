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
            <div class="modal fade" id="laboratoryformModal" tabindex="-1" aria-labelledby="laboratoryformModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
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