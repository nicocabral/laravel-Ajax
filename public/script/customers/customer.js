var token = localStorage.getItem('token');
$.ajaxSetup({
	headers:{'Authorization' : 'Bearer '+token }
});
var table = $('#customers_table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax:  'api/customers' ,
                      columns: [
                        {data: 'customerid', name: 'customerid',
                        "render":function(data,type,row,name){
                        	if(data == 2){
                        		return '<a href="javascript:void(0)" onclick="viewPermission('+data+')"><strong>Admin</strong></a>';
                        	}
                        	else{
                        		return '<a href="javascript:void(0)" onclick="viewPermission('+data+')"><strong>User</strong></a>';
                        	}
                        }
                    },
                    {data: 'customercode', name: 'customercode'},
                    {data: 'merchant', name: 'merchant'},
                    {data: 'fname', name: 'fname'},
                    {data: 'lname', name: 'lname'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status',
                    "render":function(data,type,row,name){
                    	if(data == 1){
                    		return '<p class="text-success"><strong >Active</strong></p>';
                    	}
                    	else{
                    		return '<p class="text-danger"><strong>Inactive</strong></p>';
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

$('#btnAddRole').click(function(){
	$('#create_modal').modal('show');
	$('.modal-title').text('Create customer');
	$('input[name=_method]').val('POST');
	$('#customerForm')[0].reset();
	$('#customerid').removeAttr('disabled', 'disabled');
	$('#customerid').focus();
	$('#customerid').attr('required', 'required');
	loadMerchant()
})
function loadMerchant(){
	$.ajax({
		url:'api/loadmerchants',
		type:'get',
		cache:false,
		beforeSend:function(){
			$('#merchantlist').html('<center><i class="fas fa-spin fa-spinner"></i></center>');
		},
		success:function(data){
			var output="";
					output+= '<select class="form-control" name="merchant" id="merchant">'
			$.each(data, function(i,val){
		
				output+= '<option value="'+val.name+'">'+val.name+'</option>'
				
			})
			output+= '</select>'
			$('#merchantlist').html(output)

		}
	})
}
//save customer

$('#customerForm').validator().on('submit', function(){
	event.preventDefault();
	var url = "";
	var id = $('#id').val();
	var method = $('input[name=_method]').val();
	if(method == "POST")
		url = 'api/customer'
	else
		url = 'api/customer/'+id
	$.ajax({
		url:url,
		type:'post',
		data:new FormData($('#customerForm')[0]),
		cache:false,
		contentType:false,
		processData:false,
		beforeSend:function(){
			$('.loader').show()
		},
		success:function(data){
			$('.loader').fadeOut();
			console.log(data)
		
			if(data.success == true){
				swal({
					title:'Success',
					text:data.message,
					type:'success'
				})
				 $('#customerForm')[0].reset();
				 	table.ajax.reload();
			}
			else if(data.success == false){
				var m = "";
				$.each(data.errors, function(i,val){
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

//delete customer

function deleteData(id){
	 var csrf_token = $('meta[name="csrf-token"]').attr('content');
	swal({
	  title: "Confirmation",
	  text: "Are you sure you want to delete this customer?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn btn-danger",
	  confirmButtonText: "Delete",
	  closeOnConfirm: true
	},
	function(){
	  $.ajax({
	  	url:'api/customer/'+id,
	  	type:'post',
	  	data : {'_method' : 'DELETE', '_token' : csrf_token},
	  	cache:false,
	  	beforeSend:function(){
	  		$('.loader').show();
	  	},
	  	success:function(data){
	  		$('.loader').fadeOut();
	  		table.ajax.reload();
	  	}
	  })
	});
}

//edit customer
function editData(id){

	$.ajax({
		url:'api/customer/'+id+'/edit',
		type:'get',
		cache:false,
		beforeSend:function(){
			$('.loader').show();
		},
		success:function(data){
			loadMerchant();
			$('.loader').fadeOut();
			$('#create_modal').modal('show');
			$('.modal-title').text('Edit customer');
			$('input[name=_method]').val('PATCH');
			$('#id').val(data.customer.id);
			$('#customerid').val(data.customer.customerid);
			$('#customerid').attr('disabled', 'disabled');
			$('#customerid').removeAttr('required', 'required');
			$('#fname').val(data.customer.fname);
			$('#fname').focus();
			$('#lname').val(data.customer.lname);
			$('#email').val(data.customer.email);
			$('#company').val(data.company.name);
			$('#title').val(data.company.title);
			$('#dep').val(data.company.department);
			$('#dphone').val(data.contact.d_phone);
			$('#mphone').val(data.contact.m_phone);
			$('#ephone').val(data.contact.e_phone);
			$('#fax').val(data.contact.fax);
			$('#status').val(data.customer.status);
			$('#merchant').val(data.customer.merchant);

		}
	})
}