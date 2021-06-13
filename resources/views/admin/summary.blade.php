@extends('layouts.app')
@section('content')
{{-- //////     --}}


     <!-- partial -->
     <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.menu')   
  <!-- partial -->
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <!-- Page Title Header Starts-->
            <div class="row page-title-header">
              <div class="col-md-12">
                <div class="page-header-toolbar">
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Games </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <a class="dropdown-item" href="#">Priemier Lucky</a>
                      <a class="dropdown-item" href="#">Priemier Tota</a>
                      <a class="dropdown-item" href="#">Priemier Bingo</a>
                      <a class="dropdown-item" href="#">Priemier Peoples</a>
                    </div>
                  </div>
                  <div class="filter-wrapper">
                    <div class="dropdown toolbar-item">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownsorting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Day</button>
                      <div class="dropdown-menu" aria-labelledby="dropdownsorting">
                        <a class="dropdown-item" href="#">Last Day</a>
                        <a class="dropdown-item" href="#">Last Month</a>
                        <a class="dropdown-item" href="#">Last Year</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Page Title Header Ends-->
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Agents </th>
                          <th> No. of sales </th>
                          <th>No of Terminals</th>
                          <th> Sales </th>
                          <th> No. of cancelled </th>
                          <th> Cancelled </th>
                          <th> Net sales </th>
                          <th> No. of paid </th>
                          <th> Winnings paid </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($agents as $agent)
                        <tr>
                          <td>{{$agent->name}}</td>
                          <td>
                            {{-- <?php
                              //  foreach(DB::table('cashiers')->where('agent_id', $agent->id)->get() as )

                          ?> --}}
                          </td>
                          <td>0</td>
                          <td>354</td>
                          <td>0 </td>
                          <td> 1120</td>
                          <td> 0 </td>
                          <td> 0</td>
                          <td> 150,000</td>
                        </tr>
                      @endforeach
                                              
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
       @endsection