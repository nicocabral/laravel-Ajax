<div class="modal fade bd-example-modal-lg" id="create_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="merchantForm" data-toggle="validator">
      <div class="modal-body">
        {{csrf_field() }} {{ method_field('POST') }}
        <input type="hidden" id="id">
        <div class="row">
          <div class="col-md-6">
        <div class="form-group">
          <label><strong>Name</strong></label>
          <input type="text" class="form-control" required style="color:#000000;" autofocus name="name" id="name">
          <span class="help-block with-errors" style="color:red"></span>
        </div>
        <div class="form-group">
          <label><strong>Birthdate</strong></label>
          <input type="text" class="form-control datepicker" required style="color:#000000;" name="dob" id="dob">
          <span class="help-block with-errors" style="color:red"></span>
        </div>
         <div class="form-group">
          <label><strong>Contact</strong></label>
          <input type="text" class="form-control" required style="color:#000000;" name="contact" id="contact">
          <span class="help-block with-errors" style="color:red"></span>
        </div>
        </div>
  
          <div class="col-md-6">
        <div class="form-group">
          <label><strong>Email</strong></label>
          <input type="email" class="form-control" required style="color:#000000;" name="email" id="email">
          <span class="help-block with-errors" style="color:red"></span>
        </div>
        
         <div class="form-group">
          <label><strong>Status</strong></label>
          <select class="form-control" name="status" style="color:#000000;" id="status">
            <option value="1">Active</option>
            <option value="2">Inactive</option>
            <option value="0">Lock out</option>
          </select>
          <span class="help-block with-errors" style="color:red"></span>
        </div>
        <div class="form-group" id="password_fields">
          <label><strong>Password</strong></label>
          <input type="text" class="form-control" style="color:#000000;" readonly="" name="password">
          <button class="btn btn-primary pull-right" style="margin-top: 5px;" id="btngenerate">Generate</button>
          <span class="help-block with-errors" style="color:red"></span>
        </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnGeneratePassword">Generate password</button>
        <button type="submit" class="btn btn-success">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>