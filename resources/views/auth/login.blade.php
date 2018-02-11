@extends('layouts.login')
@section('content')
@include('auth.forgotpassword')
<div class="row">
	<div class="col-md-6 col-xs-6">
		<img src="{{asset('assets/images/bg.png')}}" class="img-reponsive" width="100%">
	</div>
	<div class="col-md-6 col-xs-6">
		<div class="panel panel-default" style="margin-top: 15%;">
		  <div class="panel-body">
		  	<div class="row">
		  		<div class="col-md-12">
		    		<center><img src="{{asset('assets/images/logo.jpg')}}" class="img-responsive"></center>
				</div>
			</div>
		  </div>
		
		  <div class="row" style="margin-top: 10%;">
		  	<div class="col-md-3 col-xs-6"></div>
		  	<div class="col-md-6 col-xs-6">
		  		<form id="loginForm" data-toggle="validator">
		  			{{ csrf_field() }}
		  			  <div class="form-group">
					    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
					     <span class="help-block with-errors" style="color:red"></span>
					  </div>
					  <div class="form-group">
					    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required> 
					     <span class="help-block with-errors" style="color:red"></span>
					  </div>
					   <div class="form-group">
					    <a href="javascript:void(0)" id="btnForgotPassword"><i class="far fa-question-circle"></i> Forgot password</a>
					  </div>
					  <div class="form-group">
					  	<div class="col-md-4 col-xs-4"></div>
					  	<div class="col-md-4 col-xs-4">
					    <button class="btn btn-success btn-block btn-lg" type="submit">Login</button><br>
						</div>
					  </div>
		  		</form>
		  	</div>
		  </div>
		</div>
	</div>
</div>
@endsection
@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{'script/login/login.js'}}" ></script>
@endsection