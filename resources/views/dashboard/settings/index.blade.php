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
	<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <h3><i class="fas fa-wrench"></i> Settings</h3>
      </div>
    </div>
    <hr>
    <form id="settingsForm">
      {{csrf_field()}}
        <div class="row">
          <div class="col-md-3">
             <div class="form-group">
                    <label><strong>DEFAULT NUMBER OF MAX FAILURES</strong></label>
                    <select class="form-control" id="no_of_failures" name="no_of_failures">
                      <option>0</option>
                      @for($i = 1; $i<=24; $i++)
                      <option value="{{$i}}">{{$i}}</option>
                      @endfor
                    </select>
                  </div>
          </div>
          <div class="col-md-3">
             <div class="form-group">
                    <label><strong>DEFAULT NUMBER OF FAILURE INTERVALS</strong></label>
                    <select class="form-control" id="no_of_failures_intervals" name="no_of_failures_intervals">
                      @for($i = 1; $i<=2; $i++)
                      <option value="{{$i}}">{{$i}}</option>
                      @endfor
                    </select>
                  </div>
          </div>
           <div class="col-md-3">
             <div class="form-group">
                    <label><strong>DEFAULT RESULT CODE VALUES</strong></label>
                    <select multiple class="form-control" id="defaultresultcode" name="defaultresultcode">
                      <option>-100</option>
                      @for($i = 1; $i<=100; $i++)
                      <option value="{{$i}}">{{$i}}</option>
                      @endfor
                    </select>
                  </div>
          </div>
          <div class="col-md-3">
             <div class="form-group">
              <p class="card-title"><strong>SELECTED CODE VALUES</strong></p>
                    <div class="card border-secondary mb-3" style="max-width: 20rem;">
                  <div class="card-body text-secondary">
                    <div style="color:#000000">
                    <div id="code_values">
                      
                    </div>
                  </div>
                  </div>
                </div>
                  </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
          </div>
          <div class="col-md-6">
            <div class="pull-right">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="reset" class="btn btn-secondary">Clear</button>
          </div>
        </div>
        </div>
      </form>
      
      
  </div>
</div>

@endsection


@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{'script/settings/setting.js'}}" ></script>
@endsection

@endif  