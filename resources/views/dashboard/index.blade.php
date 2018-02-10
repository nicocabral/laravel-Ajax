@extends('layouts.master')
@section('content')

@endsection
@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{'script/dashboard/dashboard.js'}}" ></script>
@endsection
