var token = localStorage.getItem('token');
$.ajaxSetup({
	headers:{'Authorization':'Bearer ' + token}
})

 var table = $('#merchant_table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax:  'api/merchants' ,
                      columns: [
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'contact', name: 'contact'},
                        {data: 'role', name: 'role',
                        "render":function(data,type,row,name){
                        	if(data == 2){
                        		return '<p><strong>Admin</strong></p>';
                        	}
                        }
                    },
                        {data: 'status', name: 'status',
                        "render":function(data,type,row,name){
                        	if(data == 1){
                        		return '<p style="color:#48B068"><strong>Active</strong></p>';
                        	}else if(data == 2){
                        		return '<p class="text-danger"><strong>Inactive</strong></p>';
                        	}
                        	else{
                        		return '<p class="text-danger"><strong>Lockout</strong></p>';
                        	}

                        }
                    },
                        {data: 'id', name: 'id', orderable: false, searchable: false,
                       	"render": function(data,type,row,name){
                       		return '<button class="btn btn-primary btn-sm" onclick="editData('+data+')"><i class="far fa-edit"></i></button>'+
                       			   ' <button class="btn btn-danger btn-sm" onclick="deleteData('+data+')"><i class="fas fa-trash"></i></button>'
                       	}
                    }
                      ]
                    });
$('#btnRefreshTable').click(function(){
	table.ajax.reload();
})
$('#btnAddMerchant').click(function(){
	$('#create_modal').modal('show');
	$('.modal-title').text('Create merchant');
	$('input[name=_method]').val('POST');
	$('#password_fields').show();
	$('#btnGeneratePassword').hide();
	$('#merchantForm')[0].reset();
	$('#btnGeneratePassword').removeAttr('disabled','disabled');
})
$('#merchantForm .datepicker').datepicker({
	autoclose:true,
	format: 'yyyy/mm/dd'
});
$('#btngenerate').click(function(){
	generate();
});
$('#btnGeneratePassword').click(function(){
	$('#btnGeneratePassword').attr('disabled');
	var id = $('#id').val();
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	var password = randomPassword(8)
	$.ajax({
		url:'api/reset_merchant_password',
		data : {'_token' : csrf_token, 'password': password, 'id':id},
		type:'post',
		cache:false,
		beforeSend:function(){
			$('.loader').show();
		},
		success:function(data){
			$('.loader').fadeOut();
			if(data.success == true ){
				swal({
					title:'Success',
					text:data.message,
					type:'success'
				})
				$('#create_modal').modal('hide');
			}
		},
		error:function(e){
			var m = e.responseJSON;
			$('.loader').fadeOut();
			swal({
				title:'Warning',
				text:m.message,
				type:'info'
			})
		}

	})
})

//generate temp password for users
function randomPassword(length) {
    var chars = "abcdefghijklmnopqrstuvwxyz!@#$&*ABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function generate() {
    merchantForm.password.value = randomPassword(8);
    $('#btngenerate').attr('disabled', 'disabled');

}
//save data
$('#merchantForm').validator().on('submit', function(){
	var url="";
	var merchant = $('input[name=_method]').val();
	var id = $('#id').val();
	if(merchant == "POST")
		url = "api/merchant";
	else
		url = "api/merchant/"+id;
	event.preventDefault();
	$.ajax({
		url:url,
		type:'post',
		data: new FormData($('#merchantForm')[0]),
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
				table.ajax.reload();
				$('#merchantForm')[0].reset();
			}else if(data.fail == true){
				swal({
					title:'Warning',
					text:data.message,
					type:'info'
				})
			}else{
				var m = "";
				$.each(data.errors, function(i,val){
					m+=val+'\n';
				})
				swal({
					title:'Warning',
					text:m,
					type:'info'
				})
			}			
		},
		error:function(e){
			$('.loader').fadeOut();
			var m = e.responseJSON;
			swal({
				title:'Warning',
				text:m.message,
				type:'info'
			})
		}
	})
})

//edit Merchant

function editData(id){
	$('#create_modal').modal('show');
	$('.modal-title').text('Edit merchant');
	$('input[name=_method]').val('PATCH');
	$('#id').val(id);
	$('#password_fields').hide();
	$('#btnGeneratePassword').show();
	$.ajax({
		url:'api/merchant/'+id+'/edit',
		type:'get',
		cache:false,
		beforeSend:function(){
			$('.loader').show();
		},
		success:function(data){
			$('.loader').fadeOut();
			console.log(data);
			$('#name').focus();
			$('#name').val(data.name);
			$('#dob').val(data.dob);
			$('#contact').val(data.contact);
			$('#email').val(data.email);
			$('#status').val(data.status);

		},
		error:function(e){
			var m = e.responseJSON;
			swal({
				title:'Warning',
				text:m.message,
				type:'info'
			})
		}
	})
}
//delete Date

function deleteData(id){
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
		swal({
		  title: "Confirmation",
		  text: "Are you sure you want to delete this merchant?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn btn-danger",
		  confirmButtonText: "Delete",
		  closeOnConfirm: true
		},
		function(){
		  $.ajax({
		  	url:'api/merchant/'+id,
		  	type:'post',
		  	data : {'_method' : 'DELETE', '_token' : csrf_token},
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
		  			});
		  			table.ajax.reload();
		  		}

		  	},
		  	error:function(e){
		  		$('.loader').fadeOut();
		  		var m = e.responseJSON;
		  		swal({
		  			title:'Warning',
		  			text:m.message,
		  			type:'info'
		  		})
		  	}
		  })
		});
}