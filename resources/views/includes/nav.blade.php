 <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
      <div class="container">
        <a href="{{url('/')}}" class="navbar-brand"><img src="{{ asset('assets/images/logo-b.png')}}" class="img-fluid" alt="Responsive image"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav">
            @if(Auth::user()->role == 1 && Auth::user()->permission == 1 || Auth::user()->role == 2 &&Auth::user()->permission == 1 || Auth::user()->role == 3 && Auth::user()->permission == 1)
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/customers')}}"><i class="far fa-user"></i> Customers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/contracts')}}"><i class="far fa-bookmark"></i> Contracts</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download"><i class="fas fa-chart-bar"></i> Reports <span class="caret"></span></a>
              <div class="dropdown-menu" aria-labelledby="download">
                <a class="dropdown-item" href="{{ url('/billing_reports')}}">Billing Reports</a>
                <a class="dropdown-item" href="{{url('/contract_expiration')}}">Contract Expiration</a>
                <a class="dropdown-item" href="{{url('/card_expiration')}}">Card Expiration</a>
                <a class="dropdown-item" href="{{url('/transaction_reports')}}">Transaction Report</a>
            
              </div>
            </li>
             <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download"><i class="fas fa-cogs"></i> Configuration <span class="caret"></span></a>
              <div class="dropdown-menu" aria-labelledby="download">
                @if(Auth::user()->role == 1 && Auth::user()->permission == 1)
                <a class="dropdown-item" href="{{url('/settings')}}">Settings</a>
                <a class="dropdown-item" href="{{ url('/merchants')}}">Merchants</a>
                <a class="dropdown-item" href="{{ url('/roles')}}">Roles</a>
                @endif
                @if(Auth::user()->role==2 && Auth::user()->permission == 1 || Auth::user()->role == 3 &&Auth::user()->permission == 1)
                <a class="dropdown-item" href="{{url('/settings')}}">Settings</a>
                <a class="dropdown-item" href="{{ url('/users')}}">Users</a>
                @endif
            
              </div>
            </li>
             @endif
            <!-- user read only and report only -->
            @if(Auth::user()->role == 4 && Auth::user()->permission == 2 || Auth::user()->role == 4 && Auth::user()->permission ==3)
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download"><i class="fas fa-chart-bar"></i> Reports <span class="caret"></span></a>
              <div class="dropdown-menu" aria-labelledby="download">
                <a class="dropdown-item" href="{{ url('/billing_reports')}}">Billing Reports</a>
                <a class="dropdown-item" href="{{url('/contract_expiration')}}">Contract Expiration</a>
                <a class="dropdown-item" href="{{url('/card_expiration')}}">Card Expiration</a>
                <a class="dropdown-item" href="{{url('/transaction_reports')}}">Transaction Report</a>
              </div>
            </li>
              @endif
          </ul>

          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download"> {{Auth::user()->name}} <span class="caret"></span></a>
              <div class="dropdown-menu" aria-labelledby="download">
                <a class="dropdown-item" href="{{ url('/myprofile')}}"><i class="fas fa-user-circle"></i> My profile</a>
                <a class="dropdown-item" href="javascript:void(0)" id="btnLogMeOut"><i class="fas fa-sign-out-alt"></i> Logout</a>
            
              </div>
            </li>
         
          </ul>

        </div>
      </div>
    </div>