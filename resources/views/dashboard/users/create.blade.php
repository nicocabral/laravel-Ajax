<div class="modal fade bd-example-modal-lg" id="create_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="createUserForm" data-toggle="validator">
      	{{csrf_field()}}{{ method_field('POST') }}
      	<input type="hidden" id="id">
      <div class="modal-body">
       		<div class="row">
       			<div class="col-md-6">
       				<div class="form-group">
       					<label><strong>Name</strong></label>
       					<input type="text" class="form-control" name="name" id="name" required>
       					<span class="help-block with-errors" style="color:red"></span>
       				</div>
       				<div class="form-group">
       					<label><strong>Email</strong></label>
       					<input type="email" class="form-control" name="email" id="email" required>
       					<span class="help-block with-errors" style="color:red"></span>
       				</div>
       				<div class="form-group">
       					<label><strong>Birthdate</strong></label>
       					<input type="text" class="form-control datepicker" name="dob" id="dob" required>
       					<span class="help-block with-errors" style="color:red"></span>
       				</div>
       				<div class="form-group">
       					<label><strong>Contact</strong></label>
       					<input type="text" class="form-control" name="contact" id="contact" >
       				</div>
       			</div>
       			<div class="col-md-6">
       				<div class="form-group">
       					<label><strong>Role</strong></label>
       					<div id="roleList"></div>
       					
       				</div>
       				<div class="form-group">
       					<label><strong>Permission</strong></label>
						<div id="permissionList"></div>
       				</div>
       				<div class="form-group">
       					<label><strong>Status</strong></label>
       					<select class="form-control" name="status" id="status">
       						<option value="1">Active</option>
       						<option value="2">Inactive</option>
       						<option value="3">Lockout</option>
       					</select>
       					<span class="help-block with-errors" style="color:red"></span>
       				</div>
       				<div class="form-group" id="password_fields">
       					<label><strong>Password</strong></label>
       					<input type="text" class="form-control" name="password" id="password" readonly="">
       					<button class="btn btn-primary" style="margin-top: 5px;" id="btnGenerate">Generate</button>
       				</div>
       			</div>
       		</div>
      </div>
      <div class="modal-footer card-header">
      	<button type="button" class="btn btn-primary" id="btnGeneratePword">Generate password</button>
        <button type="submit" class="btn btn-success">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
  </form>
    </div>
  </div>
</div>