var token = localStorage.getItem('token');

$.ajaxSetup({
	headers:{'Authorization' : 'Bearer '+ token }
});
$(window).load(function(){
	$('#filterSpinner').hide();
	$('#btnShowFilterModal').hide();	
	var id = $('#selectFilter').val();
	showFilterForm(id);
})
$('#billingreports_table').DataTable({
                processing: true,
                serverSide: false,
                async: true,
                destroy: true,
                fixedHeader: {
				            header: true,
				        }
});

function showBtnFilter(){
	$('#btnShowFilterModal').show();
}

function showFilterFormHide(){
	var id = $('#selectFilter').val()
	showFilterForm(id);
}

function searchData(){
	$('#filterSpinner').show();
}

function showFilterForm(id){
	if(id == 1){
		$('#filterSpinner').hide();
		$('#btnShowFilterModal').hide();
		referenceNumber();
	}
	else if(id == 2){
		$('#filterSpinner').hide();
		$('#btnShowFilterModal').hide();
		contractId();
	}
	else if(id == 3){
		$('#filterSpinner').hide();
		$('#btnShowFilterModal').hide();
		transactionDate();	
	}
	else if(id == 4){
		$('#filterSpinner').hide();
		$('#btnShowFilterModal').hide();
		firstName();
	}
	else if(id == 5){
		$('#filterSpinner').hide();
		$('#btnShowFilterModal').hide();
		lastName();
	}
	else{
		$('#filterSpinner').hide();
		$('#btnShowFilterModal').hide();
		paymentType();
	}
}




function referenceNumber(){
		$('#filterModalContent').empty();
		$('#filterModal').modal('show');
		$('#filterTitle').html('<h5><strong>Reference #</strong></h5>');
		var output = "";
		output+='<div class="row">'
		output+='<div class="col-md-8">'
		output+='<input type="text" class="form-control" placeholder="Reference #" autofocus>'
		output+='</div></div>'
	
		$('#filterModalContent').html(output);
}

function contractId(){
		$('#filterModalContent').empty();
		$('#filterModal').modal('show');
		$('#filterTitle').html('<h5><strong>Contract ID</strong></h5>');
		var output = "";
		output+='<div class="row">'
		output+='<div class="col-md-8">'
		output+='<input type="text" class="form-control" placeholder="Contract ID" autofocus>'
		output+='</div></div>'
	
		$('#filterModalContent').html(output);
}

function transactionDate(){
		$('#filterModalContent').empty();
		$('#filterModal').modal('show');
		$('#filterTitle').html('<h5><strong>Transaction Date</strong></h5>');
		var output="";
		output+='<div class="input-group input-daterange">'+
				'<input type="text" class="form-control" placeholder="From">'+
    			'<input type="text" class="form-control" placeholder="to">'+
				'</div>';

		$('#filterModalContent').html(output);

		$('.input-daterange input').each(function() {
		    $(this).datepicker({
		    	autoclose:true,
		    	format:'yyyy/mm/dd'
		    });
		 
		});
	
		
}

function firstName(){
		$('#filterModalContent').empty();
		$('#filterModal').modal('show');
		$('#filterTitle').html('<h5><strong>Firstname</strong></h5>');
		var output = "";
		output+='<div class="row">'
		output+='<div class="col-md-8">'
		output+='<input type="text" class="form-control" placeholder="Firstname" autofocus>'
		output+='</div></div>'
	
		$('#filterModalContent').html(output);
}

function lastName(){
		$('#filterModalContent').empty();
		$('#filterModal').modal('show');
		$('#filterTitle').html('<h5><strong>Lastname</strong></h5>');
		var output = "";
		output+='<div class="row">'
		output+='<div class="col-md-8">'
		output+='<input type="text" class="form-control" placeholder="Lastname" autofocus>'
		output+='</div></div>'
	
		$('#filterModalContent').html(output);
}

function paymentType(){
		$('#searchSpinner').hide();
		$('#filterModalContent').empty();
		$('#filterModal').modal('show');
		$('#filterTitle').html('<h5><strong>Payment Type</strong></h5>');
		var output = "";
		output+='<div class="row">'
		output+='<div class="col-md-6">'
		output+='<select class="form-control">'
		output+='<option>All</option>'
		output+='<option>Amex</option>'
		output+='<option>Discover</option>'
		output+='<option>Mastercard</option>'
		output+='<option>Visa</option>'
		output+='<option>ACH</option>'
		output+='</select></div></div>'
		$('#filterModalContent').html(output);
}