@extends('layouts.master')
@if(Auth::user()->role == 4)
  @section('unauthorized')
  <div class="container">
    <div class="alert alert-dismissible alert-danger">
     
      <strong>Unauthorized access </strong>
    </div>
  </div>
  @endsection
@else
@section('content')
	
@include('dashboard.accountsetup.statuschecker')

		<div class="card">
	  <div class="card-body">
	  	<div class="row">
	  		<div class="col-md-10">
	  			<h3><i class="far fa-folder-open"></i> Contracts</h3>
	  		</div>
	  		<div class="col-md-2">
	  			<center>
	  			<button class="btn btn-success pull-right" id="btnRefreshTable">Refresh table</button>
	  		</center>
	  		   
	  		</div>
	  	</div>
	  	<hr>
	  	

	  	<div class="row">
	  		<div class="col-md-12 col-xs-12">
	  			<table class="table  table-bordered table-striped table-condensed" width="100%" id="contract_table">
	  				<thead>
	  					<tr>
	  						<th>Contract ID</th>
	  						<th>Customer ID</th>
	  						<th>Type</th>
	  						<th>Next Bill Date</th>
	  						<th>Amount</th>
	  						<th>Payment history</th>
	  						<th>Action</th>
	  					</tr>
	  				</thead>
	  				<tbody></tbody>
	  			</table>
	  		</div>
	  	</div>
	  </div>
	</div>
@endsection


@section('script')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{'script/contracts/contract.js'}}" ></script>
@endsection
@endif