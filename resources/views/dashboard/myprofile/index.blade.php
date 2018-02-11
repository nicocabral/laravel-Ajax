@extends('layouts.master')
@section('content')
@include('dashboard.accountsetup.statuschecker')
	<div class="card">
	  <div class="card-body">
	  	<div class="row">
	  		<div class="col-md-9">
	  			<h3><i class="far fa-user"></i> {{Auth::user()->name}}</h3>
	  		</div>
	  	</div>
	  	<hr>
	  	

	  	<div class="row">
	  		<div class="col-md-12 col-xs-12">
	  			<ul class="nav nav-tabs">
				  <li class="nav-item">
				    <a class="nav-link active" data-toggle="tab" href="#profileinfo"><strong>Profile info</strong></a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" data-toggle="tab" href="#profile"><strong>Credentials</strong></a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link " data-toggle="tab"  href="#securityquestion" onclick="securityQuestion()"><strong>Security Question</strong></a>
				  </li>
				</ul>
				<div id="myTabContent" class="tab-content">
				  <div class="tab-pane fade show active" id="profileinfo">
				    <form id="myprofileForm" data-toggle="validator">
				    	{{csrf_field()}}
				    	<div class="row">
				    		<div class="col-md-4">
				    			<div class="form-group">
				    				<label><strong>Name</strong></label>
				    				<input type="text" value="{{Auth::user()->name}}" class="form-control" required readonly="" name="name" id="name">
				    				<span class="help-block with-errors" style="color:red"></span>
				    			</div>
				    			<div class="form-group">
				    				<label><strong>Birthdate</strong></label>
				    				<input type="text" value="{{Auth::user()->dob}}" class="form-control datepicker" required readonly="" name="dob" id="dob">
				    				<span class="help-block with-errors" style="color:red"></span>
				    			</div>
				    			<div class="form-group">
				    				<label><strong>Email</strong></label>
				    				<input type="email" value="{{Auth::user()->email}}" class="form-control " required readonly="" name="email" id="email">
				    				<span class="help-block with-errors" style="color:red"></span>
				    			</div>
				    			<div class="form-group">
				    				<button class="btn btn-success" id="btnEditProfile"  type="button"><i class="far fa-edit"></i> Edit</button>
				    				<button class="btn btn-success" id="btnUpdateProfile" type="submit"><i class="fas fa-pencil-alt"></i> Update</button>
				    				<button class="btn btn-secondary" id="btnCancelUpdate"  type="button"> Cancel</button>
				    			</div>
				    		</div>
				    	</div>
				    </form>
				  </div>
				  <div class="tab-pane fade" id="profile">
				   <div class="row">
				   	<div class="col-md-4">
				   		<form id="updateCredentialsForm" data-toggle="validator">
				   			{{csrf_field()}} 
				   		<div class="form-group">

				   		<label><strong>New Password</strong></label>
				   		<input type="password" class="form-control" name="newpassword" id="newpassword"  required autofocus="" readonly="">
				   		<span class="help-block with-errors" style="color:red"></span>
				 		</div>
				   		<div class="form-group">
				   		<label><strong>Confirm Password</strong></label>
				   		<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required readonly="">
				   		<span class="help-block with-errors" style="color:red"></span>
				   		</div>
				   	
				   		<div class="form-group">
				   		<button class="btn btn-success" id="btnEditPassword"  type="button"><i class="far fa-edit"></i> Edit</button>
				    	<button class="btn btn-success" id="btnUpdatePassword" type="submit"><i class="fas fa-pencil-alt"></i> Update</button>
				    	<button class="btn btn-secondary" id="btnCancelPassword"  type="button"> Cancel</button>
				   	</div>
				   </form>
				   </div>
				  </div>
				</div>
				  <div class="tab-pane fade" id="securityquestion">
				  	<div class="row">
				  		<div class="col-md-4">
				  		<form id="securityQuestionForm" data-toggle="validator">
				  			{{csrf_field()}}{{ method_field('POST') }}
				    	<div id="securityQuestionContent"></div>
				    	</form>
				    	</div>
					</div>
				  </div>
				</div>
	  		</div>
	  	</div>
	  </div>
	</div>


@endsection


@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{'script/myprofile/myprofile.js'}}" ></script>
@endsection