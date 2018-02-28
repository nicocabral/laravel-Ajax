var token = localStorage.getItem('token');
$(window).load(function(){
	$('#searchSpinner').hide();
	$('#btnShowFilterModal').hide();
	var filter = $('#selectFilter').val();
	if(filter == 1){
		showFilterForm(1);
	}
})
$.ajaxSetup({
	headers:{'Authorization' : 'Bearer '+token}
});
$('#transaction_report_table').DataTable();
function showBtnFilter(){
	$('#btnShowFilterModal').show();
}
function showFilterForm(id){
	if(id == 1){
		$('#btnShowFilterModal').hide();
		transactionDate();
	}
	else if(id == 2){
		$('#btnShowFilterModal').hide();
		transactionType();
	}
	else if(id == 3){
		$('#btnShowFilterModal').hide();
		paymentType();
	}
	else{
		$('#btnShowFilterModal').hide();
		result();
	}

}
function showFilterFormHide(){
	var id = $('#selectFilter').val()
	showFilterForm(id);
}
function searchData(){

	$('#searchSpinner').show();
}

function transactionDate(){
		$('#searchSpinner').hide();
		$('#filterModal').modal('show');
		$('#filterTitle').html('<h5><strong>Transaction Date</strong></h5>');
		var output = "";
		// output+='<div class="row">'
		// output+='<div class="col-md-6">'
		// output+='<label><strong>From</strong></label>'
		// output+='<input type="text" class="form-control datepickerFrom"></div>'
		// output+='<div class="col-md-6">'
		// output+='<label><strong>To</strong></label>'
		// output+='<input type="text" class="form-control datepickerFrom"></div></div>'
		output+='<div class="input-group input-daterange">'+
				'<input type="text" class="form-control" placeholder="From">'+
    			'<input type="text" class="form-control" placeholder="to">'+
				'</div>'
		$('#filterModalContent').html(output);
		$('.input-daterange input').each(function() {
		    $(this).datepicker({
		    	autoclose:true,
		    	format:'yyyy/mm/dd'
		    });
		 
		});
		// $('.datepickerFrom').datepicker({
		// 	autoclose:true,
		// 	format:'yyyy/mm/dd'
		// });
}

function transactionType(){
		$('#searchSpinner').hide();
		$('#filterModalContent').empty();
		$('#filterModal').modal('show');
		$('#filterTitle').html('<h5><strong>Transaction Type</strong></h5>');
		var output = "";
		output+='<div class="row">'
		output+='<div class="col-md-6">'
		output+='<select class="form-control">'
		output+='<option>Sale</option>'
		output+='<option>Return</option>'
		output+='</select></div></div>'
	
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

function result(){
		$('#searchSpinner').hide();
		$('#filterModalContent').empty();
		$('#filterModal').modal('show');
		$('#filterTitle').html('<h5><strong>Result</strong></h5>');
		var output = "";
		output+='<div class="row">'
		output+='<div class="col-md-6">'
		output+='<select class="form-control">'
		output+='<option>All</option>'
		output+='<option>Approved</option>'
		output+='<option>Declined</option>'
		output+='</select></div></div>'
		$('#filterModalContent').html(output);
}



