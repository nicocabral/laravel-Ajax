var token = localStorage.getItem('token');
$.ajaxSetup({
	headers:{'Authorization' : 'Bearer '+ token}
});


var table = $('#users_table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax:  'api/users' ,
                      columns: [
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'contact', name: 'contact'},
                        {data: 'role', name: 'role',
                        "render":function(data,type,row,name){
                        	if(data==3){
                        		return '<p>User</p>';
                        	}
                        	else {
                        		return '<p>Admin</p>';
                        	}
                        }
                    },
	                    {data: 'permission', name: 'permission',
	                        "render":function(data,type,row,name){
	                        	if(data==1){
	                        		return '<p>Admin</p>';
	                        	}
	                        	else if(data==2){
	                        		return '<p>Read Only</p>';
	                        	}
	                        	else {
	                        		return '<p>Report Only</p>';
	                        	}
	                        }
	                    },
	                    {data: 'status', name: 'status',
	                        "render":function(data,type,row,name){
	                        	if(data==1){
	                        		return '<p class="text-success">Active</p>';
	                        	}
	                        	else if(data==2){
	                        		return '<p class="text-danger">Inactive</p>';
	                        	}
	                        	else {
	                        		return '<p class="text-danger">Lockout</p>';
	                        	}
	                        }
	                    },
                        {data: 'id', name: 'id', orderable: false, searchable: false,
                       	"render": function(data,type,row,name){
                       		return '<button class="btn btn-primary btn-sm" onclick="editData('+data+')"><i class="far fa-edit"></i> Edit</button>'+
                       			   ' <button class="btn btn-danger btn-sm" onclick="deleteData('+data+')"><i class="fas fa-trash"></i> Delete</button>'
                       	}
                    }
                      ]
                    });

$('#createUserForm .datepicker').datepicker({
	autoclose:true,
	format:'yyyy/mm/dd'
})
$('#btnRefreshTable').click(function(){
	table.ajax.reload();
})
$('#btnAddUser').click(function(){
	$('#create_modal').modal('show');
	$('.modal-title').text('Create user');
	$('#createUserForm')[0].reset();
	loadRoles()
	loadPermission()
	$('#btnGeneratePword').hide();
	$('input[name=_method]').val('POST');
	$('#status').removeAttr('readonly','readonly');

})
$('#btnGenerate').click(function(){
	generate()
})
$('#btnGeneratePword').click(function(){
	var id = $('#id').val();
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	var email = $('#email').val();
	$.ajax({
		url:'api/user/resetpassword',
		type:'post',
		data:{'_token' : csrf_token, 'id': id, 'password': randomPassword(8),'email': email},
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
				$('#create_modal').modal('show');
			}
			else{
				swal({
					title:'Warning',
					text:data.message,
					type:'info'
				})
				$('#create_modal').modal('show');
			}

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
    createUserForm.password.value = randomPassword(8);
    $('#btnGenerate').attr('disabled', 'disabled');

}
function loadRoles(){
	$.ajax({
		url:'api/roles/list',
		type:'get',
		cache:false,
		beforeSend:function(){
			$('#roleList').html('<center><i class="fas fa-spin fa-spinner"></i></center>');
		},
		success:function(data){
			var output ="";
			output+='<select class="form-control" name="role" id="role" onchange="loadRolesPermission(this.value)">'
			$.each(data, function(i,val){
				
				output+='<option value="'+val.roleid+'">'+val.name+'</option>'
				
			})
			output+='</select>'
			$('#roleList').html(output);
			

		}

	})
}
function loadPermission(){
		$.ajax({
		url:'api/permission/list',
		type:'get',
		cache:false,
		beforeSend:function(){
			$('#permissionList').html('<center><i class="fas fa-spin fa-spinner"></i></center>');
		},
		success:function(data){
			var output ="";
			output+='<select class="form-control" name="permission" id="permission">'
			$.each(data, function(i,val){
				
				output+='<option value="'+val.permissionid+'">'+val.name+'</option>'
				
			})
			output+='</select>'
			$('#permissionList').html(output);
			

		}

	})
}
function loadRolesPermission(id){
	$.ajax({
		url:'api/role/permission/list/'+id,
		type:'get',
		cache:false,
		beforeSend:function(){
			$('#permissionList').html('<center><i class="fas fa-spin fa-spinner"></i></center>');
		},
		success:function(data){
			var output = "";
			output+='<select class="form-control" name="permission" id="permission">'
			$.each(data, function(i,val){
				
				output+='<option value="'+val.permissionid+'">'+val.name+'</option>'
				
			})
			output+='</select>'
			$('#permissionList').html(output);
		}
	})
}

$('#createUserForm').validator().on('submit', function(){
	event.preventDefault();
	var id = $('#id').val();
	var url ="";
	var method = $('input[name=_method]').val();
	if(method == 'POST')
		url = 'api/user';
	else
		url = 'api/user/'+id;
	$.ajax({
		url:url,
		type:'post',
		data: new FormData($('#createUserForm')[0]),
		contentType:false,
		processData:false,
		cache:false,
		beforeSend:function(){
			$('.loader').show()
		},
		success:function(data){
			$('.loader').fadeOut()
			if(data.success == true){
				swal({
					title:'Success',
					text:data.message,
					type:'success'
				})
				table.ajax.reload();
				$('#createUserForm')[0].reset();
				method == 'PATCH' ? $('#create_modal').modal('hide') : "";
			}
			else if(data.success==false)
			{	var m ="";
				$.each(data.errors, function(i,val){
					m+=val+'\n';
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

function deleteData(id){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
	swal({
	  title: "Confirmation",
	  text: "Are you sure you want to delete this user?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn btn-danger",
	  confirmButtonText: "Delete",
	  closeOnConfirm: true
	},
	function(){
	   $.ajax({
		  	url:'api/user/'+id,
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

function editData(id){
	$('#create_modal').modal('show');
	$('.modal-title').text('Edit user');
	$('input[name=_method]').val('PATCH');
	loadRoles();
	loadPermission();
	$('#password_fields').hide();

	$.ajax({
		url:'api/user/'+id+'/edit',
		type:'get',
		cache:false,
		beforeSend:function(){
			$('.loader').show();
		},
		success:function(data){
			$('.loader').fadeOut();
			$('#id').val(data.id);
			$('#name').val(data.name);
			$('#email').val(data.email);
			$('#dob').val(data.dob);
			$('#contact').val(data.contact);
			$('#role').val(data.role);
			$('#permission').val(data.permission);
			$('#status').val(data.status);
			$('#status').attr('readonly','readonly');
			$('#btnGeneratePword').show();


		}
	})
}