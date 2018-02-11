<div class="modal bd-example-modal-lg"  data-backdrop="static" data-keyboard="false" id="statusInactive_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="far fa-user"></i> Account setup</h5>
      </div>
      <form id="changepasswordForm" data-toggle="validator">
        {{csrf_field()}}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="alert alert-dismissible alert-success" id="welcomeAlert">
              <strong>Welcome</strong>, please change your password
            </div>
          </div>
        </div>
        <div id="changePasswordContent" >
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
              <label><strong>New password</strong></label>
              <input type="password" class="form-control" autofocus name="newpassword" id="newpassword">
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label><strong>Confirm password</strong></label>
              <input type="password" class="form-control" name="confirmpassword" id="confirmpassword">
            </div>
            </div>
          </div>
        </div>
        <div id="securityQuestionContent"></div>
      </div>
      <div class="modal-footer card-header">
        <button type="button" class="btn btn-success" onclick="proceed()" id="btnProceed"><i class="fas fa-spin fa-spinner" id="spinner"></i> Proceed</button>
         <button type="button" class="btn btn-success" id="btnSave" onclick="saveSecurityQuestion()"> Save</button>
      </div>
    </form>
    </div>
  </div>
</div>