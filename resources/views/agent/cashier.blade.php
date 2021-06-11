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
                          <p class="mb-0">Amount Allocated(N{{DB::table('cashiers')->where('agent_id',Auth::user()->id)->value('cash_allocated') ?? 0}})</p>
                        </div>
                        <h4 class="font-weight-semibold">N{{DB::table('cashiers')->where('agent_id',Auth::user()->id)->value('cash_allocated') ?? 0}}</h4>
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
                          <p class="mb-0">Amount Remitted(N{{DB::table('cashiers')->where('agent_id',Auth::user()->id)->value('cash_remitted') ?? 0}})</p>
                        </div>
                        <h4 class="font-weight-semibold">N{{DB::table('cashiers')->where('agent_id',Auth::user()->id)->value('cash_remitted') ?? 0}}</h4>
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
                          <p class="mb-0">Bet Played</p>
                        </div>
                        
                          <h4 class="font-weight-semibold">{{count(DB::table('bets')->where('cashier_id',$cashiers->cashier_id)->get())}}</h4>
                        
        
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
                        <h4 class="card-title mb-0">Cashier code:</h4>
                        
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
            </div>
          </div>
          <!-- content-wrapper ends -->
          
        @endsection