<div class="modal fade" id="filterModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-search"></i> Filter</h5>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12">
      			<div id="filterTitle"></div>
      		</div>
      	</div>
        <div id="filterModalContent"></div>
      </div>
      <div class="modal-footer card-header">
        <button type="button" class="btn btn-primary" onclick="searchData()"><i class="fas fa-spin fa-spinner" id="searchSpinner"></i> Search</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="showBtnFilter()">Close</button>
      </div>
    </div>
  </div>
</div>