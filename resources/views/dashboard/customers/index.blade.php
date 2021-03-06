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
@include('dashboard.customers.create')
@include('dashboard.customers.view_customer')
@include('dashboard.contracts.create')

	<div class="card">
	  <div class="card-body">
	  	<div class="row">
	  		<div class="col-md-8">
	  			<h3><i class="fas fa-users"></i> Customers</h3>
	  		</div>
	  		<div class="col-md-4">
	  			<center>
	  			<button class="btn btn-success" id="btnAddRole">Add customer</button>
	  			<button class="btn btn-success pull-right" id="btnRefreshTable">Refresh table</button>
	  			<button class="btn btn-success pull-right" id="btnExport" onclick="exportCustomer()">Export</button>
	  		</center>
	  		   
	  		</div>
	  	</div>
	  	<hr>
	  	

	  	<div class="row">
	  		<div class="col-md-12 col-xs-12">
	  			<table class="table  table-bordered table-striped table-condensed table-hover" width="100%" id="customers_table">
	  				<thead>
	  					<tr>
	  						<th>Customer ID</th>
	  						<th>Customer Code</th>
	  						<th>First name</th>
	  						<th>Last name</th>
	  						<th>Email</th>
	  						<th>Status</th>
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
<script src="{{'script/customers/customer.js'}}" ></script>
@endsection
@endif