@extends('layouts.app')
@section('content')
{{-- //////     --}}


     <!-- partial -->
     <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.agent_menu')  


     
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <!-- Page Title Header Ends-->
            <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-danger mr-2"></div>
                          <p class="mb-0">Amount Allocated(N{{DB::table('agent_credits')->where('agent_id',Auth::user()->id)->value('cash_allocated') ?? 0}})</p>
                        </div>
                        <h4 class="font-weight-semibold">N{{DB::table('agent_credits')->where('agent_id',Auth::user()->id)->value('cash_allocated') ?? 0}}</h4>
                        <div class="progress progress-md">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-danger mr-2"></div>
                          <p class="mb-0">Amount Remitted(N{{DB::table('agent_credits')->where('agent_id',Auth::user()->id)->value('cash_remitted') ?? 0}})</p>
                        </div>
                        <h4 class="font-weight-semibold">N{{DB::table('agent_credits')->where('agent_id',Auth::user()->id)->value('cash_remitted') ?? 0}}</h4>
                        <div class="progress progress-md">
                          <div class="progress-bar bg-info" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-danger mr-2"></div>
                          <p class="mb-0">Pending Fines</p>
                        </div>
                        <h4 class="font-weight-semibold">N 0</h4>
                        <div class="progress progress-md">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-danger mr-2"></div>
                          <p class="mb-0">Total Games Played</p>
                        </div>
                        <h4 class="font-weight-semibold">N 0</h4>
                        <div class="progress progress-md">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-danger mr-2"></div>
                          <p class="mb-0">Total Winnings</p>
                        </div>
                        <h4 class="font-weight-semibold">N0</h4>
                        <div class="progress progress-md">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-danger mr-2"></div>
                          <p class="mb-0">Total Lost</p>
                        </div>
                        <h4 class="font-weight-semibold">N0</h4>
                        <div class="progress progress-md">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
 
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex mb-1 align-items-center justify-content-between">
                        <h4 class="card-title mb-0">Due statement of account</h4>
                        
                      </div>
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="form-group" style="width: 100px;">
                          
                       
                        </div>
                        <form class="ml-auto search-form d-none d-md-block" action="#">
                          <div class="form-group">
                            <input type="search" class="form-control" placeholder="Search Here">
                          </div>
                        </form>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              
                              <th>Cashier Name</th>
                              <th>Cashier Code</th>
                              <th>Cash Allocated</th>
                              <th>Cash Remitted</th>
                              <th>State</th>
                              <th>Status</th>
                              <th>Total Games</th>
                              <th>Wins</th>
                              <th>Lost</th>
                              <th></th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($cashiers as $cashier)
                            <tr>
                              <td>{{$cashier->cashier_name}}</td>
                              <td>{{$cashier->cashier_code}}</td>
                              <td class="text-danger">N {{$cashier->cash_allocated ?? 0}}</td>
                              <td class="text-success">N {{$cashier->cash_remitted  ?? 0}}</td>
                              <td >{{$cashier->area}}</td>
                              <td>{{$cashier->status ?? 'active'}}</td>
                              <td class="text-primary">{{count(DB::table('bets')->where('cashier_id', $cashier->cashier_id)->get())}}</td>
                              <td>{{count(DB::table('bets')->where('cashier_id', $cashier->cashier_id)->where('status', 'won')->get())}}</td>
                              <td>{{count(DB::table('bets')->where('cashier_id', $cashier->cashier_id)->where('status', 'lost')->get())}}</td>
                              
                              <td><button class="btn btn-primary">block</button></td>
                             
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            </div>


           <div class="row">
                <div class="col-md-6 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex mb-1 align-items-center justify-content-between">
                        <h4 class="card-title mb-0">Winnings</h4>
                        
                      </div>
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="form-group" style="width: 100px;">
                          
                       
                        </div>
                        <form class="ml-auto search-form d-none d-md-block" action="#">
                          <div class="form-group">
                            <input type="search" class="form-control" placeholder="Search Here">
                          </div>
                        </form>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              
                              <th>Game Code</th>
                              <th>Ticket Number</th>
                              <th>Bet Code</th>
                              <th>Stake</th>
                              <th>Status</th>
                              <th>result Status</th>
                              {{-- //win or loss --}}
                             
                              
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($bets as $bet)
                            <tr>
                              
                              <td >{{$bet->game_code}}</td>
                              <td >{{$bet->ticket_number}}</td>
                              <td class="text-primary">{{$bet->bet_code}}</td>
                              <td class="text-danger">{{$bet->stake}}</td>
                              <td class="text-warning">{{$bet->status ?? 'pending'}}</td>
                              <td class="text-success">{{$bet->result_status ?? 'not yet played'}}</td>
                             
                              
                             
                             
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
     
                <div class="col-md-6 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex mb-1 align-items-center justify-content-between">
                        <h4 class="card-title mb-0">Losts</h4>
                        
                      </div>
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="form-group" style="width: 100px;">
                          
                       
                        </div>
                        <form class="ml-auto search-form d-none d-md-block" action="#">
                          <div class="form-group">
                            <input type="search" class="form-control" placeholder="Search Here">
                          </div>
                        </form>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              
                              <th>Game Code</th>
                              <th>Ticket Number</th>
                              <th>Bet Code</th>
                              <th>Stake</th>
                              <th>Status</th>
                              <th>result Status</th>
                              <th>result Status</th>
                              {{-- //win or loss --}}
                             
                              
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($bets as $bet)
                            <tr>
                              
                              <td >{{$bet->game_code}}</td>
                              <td >{{$bet->ticket_number}}</td>
                              <td class="text-primary">{{$bet->bet_code}}</td>
                              <td class="text-danger">{{$bet->stake}}</td>
                              <td class="text-info">{{$bet->status ?? 'pending'}}</td>
                              @if ($bet->result_status == "won")
                              <td class="text-success">{{$bet->result_status ?? 'not yet played'}}</td>
                              @else
                              <td class="text-danger">{{$bet->result_status ?? 'not yet played'}}</td>
                              @endif
                              
                             
                              
                             
                             
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            </div>



          </div>
          <!-- content-wrapper ends -->
          
        @endsection