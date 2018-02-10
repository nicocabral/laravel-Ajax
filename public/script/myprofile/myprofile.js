var token = localStorage.getItem('token');
$.ajaxSetup({
	headers:{'Authorization': 'Bearer '+token }
});
$('#myprofileForm .datepicker').datepicker({
	autoclose:true,
	format: 'yyyy/mm/dd',
});

$(window).load(function(){
	$('#btnUpdateProfile').hide();
	$('#btnCancelUpdate').hide();
	$('#btnUpdatePassword').hide();
	$('#btnCancelPassword').hide();

})
$('#btnEditProfile').click(function(){
	$('#btnUpdateProfile').show();
	$('#btnCancelUpdate').show();
	$('#btnEditProfile').hide();
	$('#name').removeAttr('readonly','readonly');
	$('#dob').removeAttr('readonly','readonly');
	$('#email').removeAttr('readonly','readonly');
})
$('#btnCancelUpdate').click(function(){
	$('#btnUpdateProfile').hide();
	$('#btnCancelUpdate').hide();
	$('#btnEditProfile').show();
	$('#name').attr('readonly','readonly');
	$('#dob').attr('readonly','readonly');
	$('#email').attr('readonly','readonly');
})
$('#btnEditPassword').click(function(){
	$('#btnUpdatePassword').show();
	$('#btnCancelPassword').show();
	$('#btnEditPassword').hide();
	$('#newpassword').removeAttr('readonly','readonly');
	$('#confirmpassword').removeAttr('readonly','readonly');
})
$('#btnCancelPassword').click(function(){
	$('#btnUpdatePassword').hide();
	$('#btnCancelPassword').hide();
	$('#btnEditPassword').show();
	$('#newpassword').attr('readonly','readonly');
	$('#confirmpassword').attr('readonly','readonly');
})

$('#myprofileForm').validator().on('submit', function(){
	event.preventDefault();
	$.ajax({
		url:'api/update_myprofile',
		type:'post',
		data:new FormData($('#myprofileForm')[0]),
		cache:false,
		contentType:false,
		processData:false,
		beforeSend:function(){
			$('.loader').show();

		},
		success:function(data){
			$('.loader').fadeOut();
			if(data.success == true){

				swal({
					title:'Success',
					text:data.message,
					type:'success',
					showConfirmButton:false
				})
				window.location.reload();
			}
			else{
				swal({
					title:'Warning',
					text:data.message,
					type:'info'
				})
			}
		}
	})
})
// update password

$('#updateCredentialsForm').validator().on('submit', function(){
	event.preventDefault();
	$.ajax({
		url:'api/update_password',
		type:'post',
		data:new FormData($('#updateCredentialsForm')[0]),
		cache:false,
		contentType:false,
		processData:false,
		beforeSend:function(){
			$('.loader').show();

		},
		success:function(data){
			$('.loader').fadeOut();
			if(data.success == true){

				swal({
					title:'Success',
					text:data.message,
					type:'success',
					showConfirmButton:false
				})
				window.location.reload();
			}
			else if(data.success == false){
				var m ="";
				$.each(data.errors,function(i,val){
					m+=val+'\n'
				})
				swal({
					title:'Warning',
					text:m,
					type:'info'
				})
			}
			else{
				swal({
					title:'Warning',
					text:data.message,
					type:'info'
				})
			}
		}
	})
})

//security question

function securityQuestion(){
	$.ajax({
		url:'api/security_question',
		type:'get',
		cache:false,
		beforeSend:function(){
			$('#securityQuestionContent').html('<center><i class="fas fa-spinner fa-spin fa-3x"></i></center>');			
		},
		success:function(data){
			if(data.success == false){
				var output ="";
				 output+='<div class="alert alert-dismissible alert-danger"><strong><i class="far fa-question-circle"></i> No security question found</strong></div>'
				 output+='<div class="form-group">'
				 output+='<label><strong>Question</strong></label>'
				 output+='<input type="text" class="form-control" required name="question" autofocus><span class="help-block with-errors" style="color:red"></span></div>'
				 output+='<div class="form-group">'
				 output+='<label><strong>Answer</strong></label>'
				 output+='<input type="text" class="form-control" required name="answer" ><span class="help-block with-errors" style="color:red"></span></div>'
				 output+='<div class="form-group">'
				 output+='<button class="btn btn-success" type="submit">Save</button></div>'


				$('#securityQuestionContent').html(output);
			}
			else{
				var output ="";
				 output+='<div class="form-group">'
				 output+='<label><strong>Question</strong></label>'
				 output+='<input type="text" class="form-control" required name="question" id="question" autofocus value="'+data.question+'" readonly><span class="help-block with-errors" style="color:red"></span></div>'
				 output+='<div class="form-group">'
				 output+='<label><strong>Answer</strong></label>'
				 output+='<input type="text" class="form-control" required name="answer" id="answer" value="'+data.answer+'" readonly><span class="help-block with-errors" style="color:red"></span></div>'
				 output+='<div class="form-group">'
				 output+='<button class="btn btn-success" type="button" onclick="editSecurityQuestion()" id="btnEditSecurityQuestion"><i class="far fa-edit"></i> Edit</button> '
				 output+='<button class="btn btn-success" type="button" id="btnUpdateSecurityQuestion"><i class="fas fa-pencil-alt"></i> Update</button> '
				 output+='<button class="btn btn-secondary" type="button" id="btnCancelSecurityQuestion" onclick="cancel()"> Cancel</button>'
				 output+='</div>'


				$('#securityQuestionContent').html(output);
				$('#btnUpdateSecurityQuestion').hide();
				$('#btnCancelSecurityQuestion').hide();
			}
			
		}
	})
}

$('#securityQuestionForm').validator().on('submit', function(){
	event.preventDefault();
	$.ajax({
		url:'api/store_security_question',
		type:'post',
		data: new FormData($('#securityQuestionForm')[0]),
		cache:false,
		contentType:false,
		processData:false,
		beforeSend:function(){
			$('.loader').show()
		},
		success:function(data){
			$('.loader').fadeOut();
			if(data.success == true){
				swal({
					title:'Success',
					text:data.message,
					type:'success'
				})
			}
		}
	})
})
function editSecurityQuestion(){
	$('#btnUpdateSecurityQuestion').show();
	$('#btnCancelSecurityQuestion').show();
	$('#btnEditSecurityQuestion').hide();
	$('#question').removeAttr('readonly')
	$('#answer').removeAttr('readonly')
}
function cancel(){
	$('#btnUpdateSecurityQuestion').hide();
	$('#btnCancelSecurityQuestion').hide();
	$('#btnEditSecurityQuestion').show();
	$('#question').attr('readonly','readonly')
	$('#answer').attr('readonly','readonly')
}
