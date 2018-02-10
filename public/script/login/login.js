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
			if(data.success == false){
				
				swal({
					title:'Warning',
					text:data.message,
					type:'info'
				});
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