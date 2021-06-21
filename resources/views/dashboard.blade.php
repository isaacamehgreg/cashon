@extends('layouts.app')
@section('content')
{{-- //////     --}}


     <!-- partial -->
     <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.menu')

      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Page Title Header Starts-->
          <div class="row page-title-header">
            <div class="col-12">
            </div>
            <div class="col-md-12">
              <div class="d-flex justify-content-between align items center">
                <div class="page-header-toolbar">
                
            
                </div>
                <form method='post' class="w-50" action="/track_terminal">
                  <div class="form-group mb-0 row">
                    <label class="col-sm-4 col-form-label">Track terminal</label>
                    <div class="col-sm-8">
                      <input type="search" class="form-control" placeholder="Enter Terminal ID" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Page Title Header Ends-->
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-6">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">{{DB::table('users')->where('role','agent')->count()}}</h3>
                          <h5 class="mb-0 font-weight-medium text-primary">No. of Agents</h5>
                        </div>
                        <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-1"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">{{DB::table('cashiers')->get()->count()}}</h3>
                          <h5 class="mb-0 font-weight-medium text-primary">No. of Terminals</h5>
                        </div>
                        <div class="wrapper my-auto ml-auto ml-lg-4">
                          <canvas height="50" width="100" id="stats-line-graph-2"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">N <?php
                            $cash = 0;
                            foreach (DB::table('bets')->get() as $bet ) {
                              $cash = $cash + $bet->stake;
                            }
                          echo number_format($cash);
                          ?></h3>
                          <h5 class="mb-0 font-weight-medium text-primary">Revenue</h5>
                        </div>
                        <div class="wrapper my-auto ml-auto ml-lg-4">
                          <canvas height="50" width="100" id="stats-line-graph-3"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">{{DB::table('bets')->get()->count()}}</h3>
                          <h5 class="mb-0 font-weight-medium text-primary">Total bets</h5>
                        </div>
                        <div class="wrapper my-auto ml-auto ml-lg-4">
                          <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body table-responsive">
                 <table class="table table-striped">
                  <thead>
                    <tr>
                      
                     
                      <th> Game Name </th>
                      <th> Draw </th>
                      <th> Game Code </th>
                       <th> Day </th>
                      <th> Game Time </th>
                      <th> 2 combination </th>
                      <th> 3 combination </th>
                      <th> 4 combination </th>
                      <th> 5 combination </th> 
                       <th> Edit </th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   @foreach (DB::table('games')->get() as $game)
                       
                
                    <tr>
                     
                      <td>{{$game->game_name}}</td>
                      <td>{{$game->draw}}</td>
                      <td>{{$game->game_code}}</td>
                      <td>{{$game->day}}</td>
                      <td>{{$game->time}}</td>
                       <td>{{$game->combo2}}</td>
                      <td>{{$game->combo3}}</td>
                      <td>{{$game->combo4}}</td>
                      <td>{{$game->combo5}}</td> 
               
                      
            
                      <td><a href="/edit_game/{{$game->id}}" class="btn btn-warning btn-sm">Edit</a></td>
                    </tr>

                   @endforeach
                  </tbody>
                </table>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
                  <h4 class="card-title mb-0">BET Overview</h4>
                  <id id="pie-chart-legend" class="mr-4">{{DB::table('bets')->get()->count()}}</id>
                </div>
                <div class="card-body d-flex">
                  <canvas class="my-auto" id="pieChart" height="130"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body pb-0">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Amount Raked</h4>

                        <p class="font-weight-semibold mb-0">Raked Percentage {{DB::table('rakes')->where('id',1)->value('percentage_raked') ?? 60 }}%</p>
                      </div>
                      <h3 class="font-weight-medium mb-4">N{{ number_format(DB::table('rakes')->where('id',1)->value('total_raked'))}}</h3>
                    </div>
                    <canvas class="mt-n4" height="90" id="total-revenue"></canva>
                  </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body pb-0">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Total Amount Pooled</h4>
                        <p class="font-weight-semibold mb-0">{{number_format(DB::table('pools')->where('id',1)->value('percentage_pool'))}}%</p>
                      </div>
                      <h3 class="font-weight-medium">N {{DB::table('pools')->where('id',1)->value('total_pool')}}</h3>
                    </div>
                    <canvas class="mt-n3" height="90" id="total-transaction"></canvas>
                  </div>
                </div>
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">All tickets</h4>
                        <a href="#"><small>Show All</small></a>
                      </div>
                      <p></p>
                      <div class="table-responsive">
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              
                              <th>Game Code</th>
                              <th>Ticket Number</th>
                              <th>Bet Code</th>
                              <th>Stake</th>
                              <th>Status</th>
                              <th>Result Status</th>
                              <th>Payouts</th>
                              {{-- //win or loss --}}
                             
                              
                            </tr>
                          </thead>
                          <tbody>
                            @foreach(DB::table('bets')->orderBy('created_at', 'DESC')->get() as $bet)
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
                              <td class="text-info">{{$bet->payout ?? 'N 0'}}</td>

                             
                              
                            
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
            <div class="col-md-4">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title mb-0">Top Agents.</h4>
                      <?php $_agents = DB::table('users')->where('role', 'agent')->get();?>
                      @foreach($_agents as $agent)
                      <div class="d-flex mt-3 py-2 border-bottom">
                        <img class="img-sm rounded-circle" src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" alt="profile image">
                        <div class="wrapper ml-2">
                          <p class="mb-n1 font-weight-semibold">{{$agent->name}}</p>
                          <small>{{$agent->address}}</small>
                        </div>
                        <small class="text-muted ml-auto">Terminals owned: {{DB::table('cashiers')->where('agent_id',$agent->id)->get()->count()}}</small>
                      </div>
                      @endforeach
                   
                    
                    </div>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title mb-0">Top Terminals </h4>
                      <?php $_cashiers = DB::table('cashiers')->get();?>
                      @foreach($_cashiers as $cashier)
                      <div class="d-flex mt-3 py-2 border-bottom">
                        <img class="img-sm rounded-circle" src="http://www.imakusvisiontech.com/wp-content/uploads/2021/03/s90.jpg" alt="profile image">
                        <div class="wrapper ml-2">
                          <small>Cashier Code: {{$cashier->cashier_code}}</small>
                          <p class="mb-n1 font-weight-semibold">Total Bet Placed: {{DB::table('bets')->where('cashier_id',$cashier->cashier_id)->get()->count()}}</p>
                          <small>Location: {{$cashier->area}}</small>
                        </div>
                        <small class="mb-n1 font-weight-semibold">Revenue Generated: {{DB::table('users')->where('id',$cashier->agent_id)->get()->count()}}</small>
                        <small class="text-muted ml-auto">Owner: {{DB::table('users')->where('id',$cashier->agent_id)->value('name')}}</small>
                      </div>
                      @endforeach
                   
                    
                    </div>
                  </div>
                </div>
              </div>




            </div>

        

          </div>
        </div>
        <!-- content-wrapper ends -->
{{-- ///////// --}}
@endsection