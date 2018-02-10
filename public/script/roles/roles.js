var token = localStorage.getItem('token');
$.ajaxSetup({
	headers:{'Authorization' : 'Bearer ' +token}
})
 var table = $('#roles_table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax:  'api/roles' ,
                      columns: [
                        {data: 'roleid', name: 'roleid',
                        "render":function(data,type,row,name){
                        	if(data == 2){
                        		return '<a href="javascript:void(0)" onclick="viewPermission('+data+')"><strong>Admin</strong></a>';
                        	}
                        	else{
                        		return '<a href="javascript:void(0)" onclick="viewPermission('+data+')"><strong>User</strong></a>';
                        	}
                        }
                    },
                        {data: 'name', name: 'name'},
                        {data: 'id', name: 'id', orderable: false, searchable: false,
                       	"render": function(data,type,row,name){
                       		return '<button class="btn btn-primary btn-sm" onclick="editData('+data+')"><i class="far fa-edit"></i> Edit</button>'+
                       			   ' <button class="btn btn-danger btn-sm" onclick="deleteData('+data+')"><i class="fas fa-trash"></i> Delete</button>'
                       	}
                    }
                      ]
                    });
$('#btnAddRole').click(function(){
	$('#create_modal').modal('show');
	$('.modal-title').text('Create role');
	$('input[name=_method]').val('POST');
	 $('#createRoleForm')[0].reset();
})
$('#btnRefreshTable').click(function(){
	table.ajax.reload();
})
$('#createRoleForm').validator().on('submit', function(){
	event.preventDefault();
	var url = "";
	var method = $('input[name=_method]').val();
	var id = $('#id').val();
	if(method == 'PATCH')
		url = "api/role/"+id;
	else
		url = "api/role"
	$.ajax({
		url:url,
		type:'post',
		data: new FormData($('#createRoleForm')[0]),
		cache:false,
		contentType:false,
		processData:false,
		beforeSend:function(){
			$('.loader').show();
		},
		success:function(data){
			$('.loader').fadeOut();
			table.ajax.reload();
		
			if(data.success ==true){
				swal({
					title:'Success',
					text:data.message,
					type:'success'
				})
				$('#create_modal').modal('hide');
			}
			else if(data.success == false){

				var m ="";
				$.each(data.errors, function(i, val){
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
		},
		error:function(e){
			$('.loader').fadeOut()
			var m = e.responseJSON;
			swal({
				title:'Warning',
				text:m.message,
				type:'info'
			})
		}
	})
})

function deleteData(id){
	 var csrf_token = $('meta[name="csrf-token"]').attr('content');
	swal({
	  title: "Confirmation?",
	  text: "Are you sure you want to delete this role?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Delete",
	  closeOnConfirm: true
	},
	function(){
	 	$.ajax({
	 		url:'api/role/'+id,
	 		type:'post',
	 		data : {'_method' : 'DELETE', '_token' : csrf_token},
	 		cache:false,
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
					table.ajax.reload();
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
	$.ajax({
		url:'api/role/'+id+'/edit',
		type:'get',
		cache:false,
		beforeSend:function(){
			$('.loader').show();
		},
		success:function(data){
			$('.loader').fadeOut();
			console.log(data);
			$('#create_modal').modal('show');
			$('.modal-title').text('Edit Role');
			$('#roletype').val(data.roleid);
			$('#rolename').val(data.name);
			$('#id').val(data.id);
			$('input[name=_method]').val('PATCH');
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

function viewPermission(id){
	$('#permission_modal').modal('show');
	$('.modal-title').text('Permissions');
	$.ajax({
		url:'api/viewpermission/'+id,
		type:'get',
		cache:false,
		beforeSend:function(){
			$('#permission_table tbody').html('<tr><td colspan="2"><center><i class="fas fa-spinner fa-spin"></i></center></td></tr>');
		},
		success:function(data){
			$('#permission_table tbody').empty();
			var output = "";
			$.each(data,function(i,val){
				output+='<tr>'
				output+='<td>'+val.name+'</td>'
				output+='<td>Active</td>'
				output+='</tr>'
			})
			$('#permission_table tbody').html(output);
		},
		error:function(e){
			var m =e.responseJSON;
			swal({
				title:'Warning',
				text:m.message,
				type:'info'
			})
		}
	})

}