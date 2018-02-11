@extends('layouts.master')
@section('content')
@include('dashboard.accountsetup.statuschecker')
@include('dashboard.users.create')
	<div class="card">
	  <div class="card-body">
	  	<div class="row">
	  		<div class="col-md-9">
	  			<h3><i class="fas fa-users"></i> Users</h3>
	  		</div>
	  		<div class="col-md-3">
	  			<center>
	  			<button class="btn btn-success" id="btnAddUser">Add user</button>
	  			<button class="btn btn-success pull-right" id="btnRefreshTable">Refresh table</button>
	  		</center>
	  		   
	  		</div>
	  	</div>
	  	<hr>
	  	

	  	<div class="row">
	  		<div class="col-md-12 col-xs-12">
	  			<table class="table  table-bordered table-striped table-condensed" width="100%" id="users_table">
	  				<thead>
	  					<tr>
	  						<th>Name</th>
	  						<th>Email</th>
	  						<th>Contact</th>
	  						<th>Role</th>
	  						<th>Permission</th>
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
<script src="{{'script/users/user.js'}}" ></script>
@endsection