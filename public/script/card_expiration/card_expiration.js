var token = localStorage.getItem('token');
$.ajaxSetup({
	headers:{'Authorization':'Bearer '+token}
});
$('#card_expiration_table').DataTable();
$('#already_expired_card_table').DataTable();