@extends('layouts.master')


@section('content')
@include('dashboard.accountsetup.statuschecker')
<div class="card ">
  
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <h3><i class="far fa-folder-open"></i> Contracts Expiration</h3> 
      </div>
      
    </div>
    <hr>
          <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#expiringSoon"><strong>Expiring Soon</strong></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#alreadyExpired"><strong>Already Expired</strong></a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#contractStatus" onclick="showContractStatus()"><strong>Contract Status</strong></a>
                </li>
               
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade show active" id="expiringSoon">
                 <div class="row">
                   <div class="col-md-10">
                    <select class="form-control col-md-2" onchange="showResults(this.value)">
                      <option value="7">Next 7 days</option>
                      <option value="14">Next 14 days</option>
                      <option value="30">Next 30 days</option>
                    </select>
                      
                   </div>
                   <div class="col-md-2">
                   	<div style="text-align: right;">
                     <button class="btn btn-success pull-right" onclick="showResults(7)">Refresh</button>
                     <button class="btn btn-success">Export</button>
                 </div>
                   </div>
                 </div>
                 <!-- table -->
                 <div class="row" style="margin-top: 10px;">
                   <div class="col-md-12">
                     <div class="table-responsive">
                       <table class="table table-hover table-condensed table-striped table-bordered" width="100%" id="contractexpirationtable">
                         <thead>
                           <tr>
                            <th>Customer ID</th>
                            <th>Contract ID</th>
                            <th>Customer</th>
                            <th>Account Number</th>
                            <th>Contract End</th>
                          </tr>
                         </thead>
                       </table>
                     </div>
                   </div>
                 </div>
                </div>
                <div class="tab-pane fade" id="alreadyExpired">
                  <div class="row">
                  	<div class="col-md-10"></div>
                    <div class="col-md-2">
                    	<div style="text-align: right;">
                       <button class="btn btn-success pull-right" id="btnRefresh">Refresh</button>
                       <button class="btn btn-success">Export</button>
                       </div>
                    </div>
                  </div>
                   <div class="row" style="margin-top: 10px;">
                   <div class="col-md-12">

                     <div class="table-responsive">
   <table class="table table-bordered table-hover table-condensed table-striped" id="already_expired_table"  width="100%">
                         <thead>
                           <tr>
                            <th>Customer ID</th>
                            <th>Contract ID</th>
                            <th>Customer</th>
                            <th>Account Number</th>
                            <th>Contract End</th>
                          </tr>
                         </thead>
                         <tbody></tbody>
                       </table>
                     </div>
                   </div>
                 </div>
                </div>
                <div class="tab-pane fade" id="contractStatus">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-inline">
                      <div class="form-group mb-2">
                        <div style="text-align: right;"><label><i class="fas fa-filter"></i> Filter by:</label></div>
                      </div>
                      <div class="form-group mx-sm-3 mb-2">
                         <select class="form-control form-control-sm">
                        <option>Active</option>
                        <option>Suspended</option>
                   
                      </select>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div style="text-align: right;">
                       <button class="btn btn-success pull-right" id="btnRefresh">Refresh</button>
                       <button class="btn btn-success">Export</button>
                       </div>
                    </div>
                  </div>
                   <div class="row" style="margin-top: 10px;">
                   <div class="col-md-12">

                     <div class="table-responsive">
   <table class="table table-bordered table-hover table-condensed table-striped" id="contract_status_table"  width="100%">
                         <thead>
                           <tr>
                            <th>Customer ID</th>
                            <th>Contract ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                          </tr>
                         </thead>
                         <tbody></tbody>
                       </table>
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
<script src="{{'script/contractExpiration/contractexpiration.js'}}" ></script>
@endsection