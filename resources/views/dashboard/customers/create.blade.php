
<div class="modal fade bd-example-modal-lg" id="create_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="customerForm" data-toggle="validator">
      <div class="modal-body">
       	{{ csrf_field()}} {{ method_field('POST') }}
       	<input type="hidden" id="id">
       	<div class="row">
       		<div class="col-md-6">
       			<div class="form-group">
       				<label><strong>Customer ID</strong></label>
       				<input type="text" class="form-control" required autofocus name="customerid" id="customerid">
       				<span class="help-block with-errors" style="color:red"></span>
       			</div>
       			<div class="form-group">
       				<label><strong>Firstname</strong></label>
       				<input type="text" class="form-control" required autofocus name="fname" id="fname">
       				<span class="help-block with-errors" style="color:red"></span>
       			</div>
       			<div class="form-group">
       				<label><strong>Lastname</strong></label>
       				<input type="text" class="form-control" required name="lname" id="lname">
       				<span class="help-block with-errors" style="color:red"></span>
       			</div>
       			
       			<div class="form-group">
       				<label><strong>Company</strong></label>
       				<input type="text" class="form-control" required name="company" id="company">
       				<span class="help-block with-errors" style="color:red"></span>
       			</div>
       			<div class="form-group">
       				<label><strong>Title</strong></label>
       				<input type="text" class="form-control" name="title" id="title">
       			</div>
       			<div class="form-group">
       				<label><strong>Department</strong></label>
       				<input type="text" class="form-control" name="dep" id="dep">
       			</div>
       		</div>
       		<div class="col-md-6">
            <div class="form-group">
              <label><strong>Email</strong></label>
              <input type="text" class="form-control" required name="email" id="email">
              <span class="help-block with-errors" style="color:red"></span>
            </div>
       			<div class="form-group">
       				<label><strong>Daytime Phone</strong></label>
       				<input type="text" class="form-control" name="dphone" id="dphone">
       			</div>
       			<div class="form-group">
       				<label><strong>Evening Phone</strong></label>
       				<input type="text" class="form-control" name="ephone" id="ephone">
       			</div>
       			<div class="form-group">
       				<label><strong>Mobile Phone</strong></label>
       				<input type="text" class="form-control" name="mphone" id="mphone">
       			</div>
       			<div class="form-group">
       				<label><strong>Fax</strong></label>
       				<input type="text" class="form-control" name="fax" id="fax">
       			</div>
       			<div class="form-group">
       				<label><strong>Status</strong></label>
       				<select class="form-control" name="status" id="status">
       					<option value="1">Active</option>
       					<option value="2">Inactive</option>
       				</select>
       			</div>
       			<div class="form-group" id="merchant">
       				<label><strong>Merchant</strong></label>
       				<div id="merchantlist">
       			</div>
       			</div>
       		</div>
       	</div>
      </div>
      <div class="modal-footer card-header">
        <button type="submit" class="btn btn-success">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
  </form>
    </div>
  </div>
</div>