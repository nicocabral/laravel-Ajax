@extends('layouts.master')
@section('content')
@include('dashboard.accountsetup.statuschecker')
<div class="card ">
  
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <h3><i class="fa fa-list-alt"></i> Card Expiration</h3> 
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
               
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade show active" id="expiringSoon">
                 <div class="row">
                   <div class="col-md-2">
                    <select class="form-control">
                      <option>Next 7 days</option>
                      <option>Next 14 days</option>
                      <option>Next 30 days</option>
                    </select>
                      
                   </div>
                   <div class="col-md-10">
                   	<div style="text-align: right;">
                   		<button class="btn btn-success">Refresh</button>
                      <button class="btn btn-success">Export</button>
                   	</div>
                   </div>
                 </div>
                 <!-- table -->
                 <div class="row" style="margin-top: 10px;">
                   <div class="col-md-12">
                     <div class="table-responsive">
                       <table class="table table-bordered table-hover table-condensed table-striped" width="100%" id="card_expiration_table">
                         <thead>
                           <tr>
                            <th>Exp Date</th>
                            <th>Credit Card</th>
                            <th>Contract ID</th>
                            <th>Customer ID</th>
                            <th>Customer</th>
                            <th>Account Number</th>
                          </tr>
                         </thead>
                       </table>
                     </div>
                   </div>
                 </div>
                </div>
                <div class="tab-pane fade" id="alreadyExpired">
                <div class="row">
                	<div class="col-md-12">
                		<div style="text-align: right;">
                   		<button class="btn btn-success">Refresh</button>
                   	</div>
                	</div>
                </div>
                   <div class="row" style="margin-top: 10px;">
                   <div class="col-md-12">
                     <div class="table-responsive">
                       <table class="table table-bordered table-hover table-condensed table-striped" width="100%" id="already_expired_card_table">
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
               
              
              </div>
  </div>
</div>
@endsection

@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{'script/card_expiration/card_expiration.js'}}" ></script>
@endsection