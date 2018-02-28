var token = localStorage.getItem('token');
$.ajaxSetup({
	headers:{'Authorization' : 'Bearer '+token}
})
$('#loginForm').validator().on('submit', function(){
	event.preventDefault();
	$.ajax({
		url:'api/auth/login',
		type:'post',
		data: new FormData($("#loginForm")[0]),
		cache:false,
		contentType:false,
		processData:false,
		beforeSend:function(){
			$('.loader').show();
		},
		success:function(data){
			$('.loader').fadeOut();
			$('#password').val('');
			if(data.success == false){
				
				swal({
					title:'Warning',
					text:data.message,
					type:'info'
				});
				$('#attempRecord').html('<em style="color:red;">Bad Attempt: '+data.attemp+'</em>')
			}
			else if(data.fail == true){
				swal({
					title:'Warning',
					text:data.message,
					type:'info'
				})
			}
			else if(data.success == true){
				localStorage.setItem('token',data.token);
				sessionStorage.setItem('token', data.token);
				swal({
				  title: "Success",
				  text: "Logging in please wait...",
				  type: "success",
				  showConfirmButton: false
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
		},
		error:function(e){
			var m = e.responseJSON;
			swal({
				title:'Warning',
				text:m.message+'\n'+m.exception,
				type:'info'				
			})
		}
	})
})

$('#btnForgotPassword').click(function(){
	$('#forgotpassword_modal').modal('show');
	$('#checkusername_email').show();
	$('#resultContent').empty();
	$('#username_email').val('');
	$('#username_email_fields').show();

})

$('#checkusername_email').click(function(){
	var email = $('#username_email').val();
	 var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url:'/forgotpassword/checkemail',
		type:'post',
		data:{'_token': csrf_token,'email' : email},
		cache:false,
		beforeSend:function(){
			
			$('#resultContent').html('<center><i class="fas fa-spinner fa-spin fa-5x"></i></center>');
		},
		success:function(data){
			if(data.success == false){
		
				$('#resultContent').html('<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="far fa-question-circle"></i> '+data.message+'</strong></div>')
			}
			else if(data.fail == true){
			
				$('#resultContent').html('<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="far fa-question-circle"></i> '+data.message+'</strong></div>')
			}
			else{
				$('#checkusername_email').hide();
				var output = "";
				output+='<label><strong>Security Question</strong><br></label><p>Please answer the question below to proceed with the reset of your password. Thank you!</p>'
				output+='<label><strong>'+data.question+' ?</strong></label>'
				output+='<input type="text"  class="form-control" placeholder="Answer" name="anwer" id="answer">'
				output+='<br><button class="btn btn-success" id="btnSubmit" onclick="submitAnswer()">Submit</button>'
				$('#resultContent').html(output);
				$('#username_email_fields').hide();
			}

		}
	})
})

function submitAnswer(){
	var answer = $('#answer').val();
	var email = $('#username_email').val();
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url:'/forgot_password/verify_answer',
		type:'post',
		data:{'_token': csrf_token,'answer' : answer, 'email':email},
		cache:false,
		beforeSend:function(){
			$('.loader').show();
		},
		success:function(data){
			$('.loader').fadeOut();
			if(data.success == true){
				swal({
					title:'Success',
					text:data.message,
					type:'success'
				})
				$('#forgotpassword_modal').modal('hide');
			}
			else{
				swal({
					title:'Warning',
					text:data.message,
					type:'warning'
				})
			}

		}
	})
}