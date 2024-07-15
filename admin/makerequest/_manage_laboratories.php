<?php ?> 
<div class="modal fade" id="productLabModal" tabindex="-1" aria-labelledby="productLabModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productLabModalLabel">Select Laboratories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" id="search" class="form-control mb-3" placeholder="Search products...">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="productTable">
                                <!-- Product items will be dynamically inserted here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h5>Selected Items</h5>
                        <ul class="list-group" id="selectedItems">
                            <!-- Selected items will be dynamically inserted here -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel </button>
                <button type="button" class="btn btn-primary" id="Save-Selected-lab-items" >Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="updateItemModal" tabindex="-1" aria-labelledby="updateItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateItemModalLabel">Add New Laboratory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div class="mb-3">
                    <label for="itemlabDescription" class="form-label">Description:</label>
                    <p id="itemLabDescription" ></p>
                </div>
                <div class="mb-3">
                    <label for="addListPrice" class="form-label">List Price</label>
                    <input type="text" class="form-control" id="itemLabListPrice" required>
                </div>
 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save-lab-cart-change" >Save</button>
            </div>
        </div>
    </div>
</div>