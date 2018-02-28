var token = localStorage.getItem('token');
$.ajaxSetup({
	headers:{'Authorization': 'Bearer '+token}
});
$('#already_expired_table').DataTable();
$('#contract_status_table').DataTable();
$('#contractexpirationtable').DataTable();

function showContractStatus(){
	return false;
}