<div class="modal fade bd-example-modal-lg" id="view_customer_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <input type="hidden" id="txtCustomerId">
        <input type="hidden" id="txtCid">
        <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#customerinfo" onclick="customerinfo()"><strong>Customer info</strong></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#paymentmethod"><strong>Payment method</strong></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#customercontract" onclick="customerContract()"><strong>Contract</strong></a>
  </li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade show active" id="customerinfo">
    <div class="row">
      <div class="col-md-12">
        <button class="btn btn-success" onclick="editCustomer()">Edit customer</button>
        <button class="btn btn-success">Add payment method</button>
        <button class="btn btn-success">Add contract</button>
      </div>
    </div>
    <div class="card" style="margin-top: 10px;">
      <div class="card-body">

        <div id="customerInfoContent"></div>
      </div>
    </div>
    
  </div>
  <div class="tab-pane fade" id="paymentmethod">
    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
  </div>
  <div class="tab-pane fade" id="customercontract">
      <div class="row">
      <div class="col-md-12">
        <button class="btn btn-success" onclick="editCustomer()">Edit customer</button>
        <button class="btn btn-success">Add payment method</button>
        <button class="btn btn-success">Add contract</button>
      </div>
    </div>
    <br>
    <table class="table table-bordered table-striped table-hover table-condensed" width="100%">
      <thead>
        <tr>
          <th>Contract ID</th>
          <th>Status</th>
          <th>Next Bill Date</th>
          <th>Payment History</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
 
</div>
      </div>
      <div class="modal-footer card-header">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>