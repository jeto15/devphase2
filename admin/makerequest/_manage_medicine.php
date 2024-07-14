<?php ?> 
<div class="modal fade" id="productMedModal" tabindex="-1" aria-labelledby="productMedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productMedModalLabel">Select Medicines</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" id="search" class="form-control mb-3" placeholder="Search products...">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Generic Name</th>
                                    <th>Brand</th>
                                    <th>Dosage Form</th>
                                    <th>Strength</th>
                                    <th>Manufacturer</th> 
                                    <th>List Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="productMedTable">
                                <!-- Product items will be dynamically inserted here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h5>Selected Items</h5>
                        <table class="table table-hover">
                            <thead>
                               <th>Description</th>
                               <th>Qty.</th>
                               <th>Unite Price</th>
                               <th>Action</th>
                            </thead>
                            <tbody id="selectedMedTable">
                                <!-- Product items will be dynamically inserted here -->
                            </tbody>
                        </table>
                        <ul class="list-group" id="selectedMedTable">
                            <!-- Selected items will be dynamically inserted here -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel </button>
                <button type="button" class="btn btn-primary" id="Save-Selected-Med-items" >Save</button>
            </div>
        </div>
    </div>
</div>

