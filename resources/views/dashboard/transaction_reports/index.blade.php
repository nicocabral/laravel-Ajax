@extends('layouts.master')
@section('content')
@include('dashboard.accountsetup.statuschecker')
@include('dashboard.transaction_reports.filterReportsModal')
<div class="card ">
  
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <h3><i class="fas fa-chart-line"></i> Transaction reports</h3> 
      </div>
      <div class="col-md-6">
        <div class="pull-right">
        	<div style="text-align: right;">
          <button class="btn btn-success">Refresh</button>
          <button class="btn btn-success">Export</button>
      </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-4">
        
    
       
        <div class="form-inline">
        <div class="form-group mb-2">
          <div style="text-align: right;"><label><i class="fas fa-filter"></i> Filter by:</label></div>
        </div>
        <div class="form-group mx-sm-3 mb-2">
           <select class="form-control form-control-sm" onchange="showFilterForm(this.value)" id="selectFilter">
          <option value="1">Transaction Date</option>
          <option value="2">Transaction Type</option>
          <option value="3">Payment Type</option>
          <option value="4">Result</option>
        </select>
        </div>
      </div>
      </div>
      <div class="col-md-8">
      	<button id="btnShowFilterModal" class="btn btn-success" onclick="showFilterFormHide()"><i class="fas fa-search"></i> Show filter form</button>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-condensed table-striped" width="100%" id="transaction_report_table" style="max-height: 400px;">
            <thead>
              <tr>
                <th>Date</th>
                <th>Ref #</th>
                <th>Trans Type</th>
                <th>Payment Type</th>
                <th>Amount</th>
                <th>Result</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
         
  </div>
</div>
@endsection

@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{'script/transaction_reports/transaction_reports.js'}}" ></script>
@endsection