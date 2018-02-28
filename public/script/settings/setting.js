var token = localStorage.getItem('token');
$.ajaxSetup({
	headers:{'Authorization':'Bearer '+token}
})
$(window).load(function(){
	loadSelectedCodes();
})
$('#settingsForm').submit(function(){
	event.preventDefault();
	$.ajax({
		url:'api/setting',
		type:'post',
		data: new FormData($(this)[0]),
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
					type:'success'
				})
				loadSelectedCodes()
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

function loadSelectedCodes(){
	$.ajax({
		url:'api/setting/loadSelectedCodes',
		type:'get',
		cache:false,
		beforeSend:function(){
			$('#code_values').val('<center><i class="fas fa-spinner fa-spin"></i></center>');
		},
		success:function(data){
			$('#code_values').html(data);
		}
	})
}