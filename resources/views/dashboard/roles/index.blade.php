@extends('layouts.master')
@section('content')
@include('dashboard.roles.create')
@include('dashboard.permissions.index')
	<div class="card">
	  <div class="card-body">
	  	<div class="row">
	  		<div class="col-md-9">
	  			<h3><i class="fas fa-cog"></i> Roles</h3>
	  		</div>
	  		<div class="col-md-3">
	  			<center>
	  			<button class="btn btn-success" id="btnAddRole">Add role</button>
	  			<button class="btn btn-success pull-right" id="btnRefreshTable">Refresh table</button>
	  		</center>
	  		   
	  		</div>
	  	</div>
	  	<hr>
	  	

	  	<div class="row">
	  		<div class="col-md-12 col-xs-12">
	  			<table class="table  table-bordered table-striped table-condensed" width="100%" id="roles_table">
	  				<thead>
	  					<tr>
	  						<th>Role Type</th>
	  						<th>Name</th>
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
<script src="{{'script/roles/roles.js'}}" ></script>
@endsection