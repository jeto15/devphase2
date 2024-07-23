<?php ?> 
<div class="modal fade" id="productCustModal" tabindex="-1" aria-labelledby="productCustModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productCustModalLabel">Custom Request Here:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="input-customerequest" class="form-label">Custom Request:</label>
                        <input class="form-control" id="input-customerequest" type="text" placeholder="Request Description.." aria-label="default input example">
                    </div>
                    <div class="mb-3">
                        <label for="input-customerequest-amount" class="form-label">Enter Amount:</label>
                        <input class="form-control" id="input-customerequest-amount" type="text" placeholder="0.00" aria-label="default input example">
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel </button>
                <button type="button" class="btn btn-primary" id="Save-Selected-Cust-items" >Save</button>
            </div>
        </div>
    </div>
</div>
