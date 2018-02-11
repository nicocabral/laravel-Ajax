var token = localStorage.getItem('token');
$.ajaxSetup({
	headers:{ 'Authorization' : 'Bearer '+token
	}
})
function loadInactiveStatusModal(){
	$('#statusInactive_modal').modal('show');
	$('#spinner').hide();
	$('#btnSave').hide();
}
function proceed(){
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$('#spinner').show();

	$.ajax({
		url:'api/update_password',
		type:'post',
		data : {'_token' : csrf_token, 'newpassword':$('#newpassword').val(),'confirmpassword': $('#confirmpassword').val()},
		cache:false,
		beforeSend:function(){
			$('#changePasswordContent').hide();
			$('#securityQuestionContent').html('<center><i class="fas fa-3x fa-spin fa-spinner"></i></center>')
		},
		success:function(data){
			$('#spinner').hide();
			if(data.success == false){
				var m = "";
				$.each(data.errors, function(i,val){
					m+=val+'\n';
				})
				swal({
					title:'Warning',
					text:m,
					type:'info'
				})
				$('#changePasswordContent').fadeIn();
				$('#securityQuestionContent').empty();
			}
			else if(data.fail ==true){
				swal({
					title:'Warning',
					text:data.message,
					type:'info'
				})
				$('#changePasswordContent').fadeIn();
				$('#securityQuestionContent').empty();
			}
			else{
				swal({
					title:'Success',
					text:data.message,
					type:'success'
				})
				$('#changePasswordContent').fadeOut();
						$.ajax({
							url:'api/security_question',
							type:'get',
							cache:false,
							beforeSend:function(){
								$('#securityQuestionContent').html('<center><i class="fas fa-3x fa-spin fa-spinner"></i></center>')
							},
							success:function(data){
								if(data.success ==false){
									$('#btnProceed').hide();
									$('#welcomeAlert').hide();
									var output = "";
									output+='<div class="row">'
									output+='<div class="col-md-6">'
									output+='<div class="alert alert-dismissible alert-danger">'
									output+='<i class="far fa-question-circle"></i> You have no security details,<br> Please fill out this form</div>'
									output+='</div></div>'
									output+='<div class="row"><div class="col-md-6">'
									output+='<div class="form-group"><label><strong>Question</strong></label>'
									output+='<input type="text" class="form-control" placeholder="E.g What is my favorite color" id="question"></div>'
									output+='<div class="form-group"><label><strong>Answer</strong></label>'
									output+='<input type="text" class="form-control" placeholder="E.g Banana" id="answer"></div></div><div class="col-md-6"><center><i class="far fa-5x fa-life-ring"></i></center></div></div>'
									$('#securityQuestionContent').html(output);

									$('#btnSave').show();
								}
							}
						})
			}
		}
	})
	
}

function saveSecurityQuestion(){
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url:'api/store_security_question',
		type:'post',
		data : {'_token' : csrf_token, 'question':$('#question').val(),'answer': $('#answer').val()},
		cache:false,
		beforeSend:function(){
			$('.loader').show()
		},
		success:function(data){
			$('.loader').hide();
			if(data.success == true){
				swal({
					title:'Success',
					text:data.message,
					type:'success'
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
}
