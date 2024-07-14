<?php ?>
  <!-- The Modal -->
  <div class="modal fade" id="productLabModal" tabindex="-1" aria-labelledby="productLabModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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

