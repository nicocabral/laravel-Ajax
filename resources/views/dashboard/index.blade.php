@extends('layouts.master')
@section('content')
	
@endsection
@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{'script/dashboard/dashboard.js'}}" ></script>
@if(Auth::user()->status == 2)
		@include('dashboard.accountsetup.inactivestatus')
		<script type="text/javascript">
		   	loadInactiveStatusModal()
		  
		</script>

	@endif
@endsection
