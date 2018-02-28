<div class="modal fade" id="create_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="createRoleForm" data-toggle="validator">
      	{{csrf_field()}} {{ method_field('POST') }}
      	<input type="hidden" id="id" >
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-6">
	      		<div class="form-group">
	        		<label><strong>Role Type</strong></label>
	        		<select class="form-control" name="roletype" id="roletype" required style="color:#000000;">
	        			<option value="3">Admin</option>
	        			<option value="4">User</option>
	        		</select>
	        		<span class="help-block with-errors" style="color:red"></span>
	        	</div>
        	</div>
        	<div class="col-md-6">
	      		<div class="form-group">
	        		<label><strong>Role Name</strong></label>
	        		<input class="form-control" name="rolename" id="rolename" type="text" required style="color:#000000;">
	        		<span class="help-block with-errors" style="color:red"></span>
	        	</div>
        	</div>
      	</div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
  	</form>
    </div>
  </div>
</div>