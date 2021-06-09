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
      <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      
                      <th> Name </th>
                      <th> email </th>
                      <th> phone </th>
                      <th> Area in Charge </th>
                      <th> No. of terminals </th>
                      <th> revenue paid </th>
                      <th> payment due </th>
                      {{-- <th> Edit </th> --}}
                      <th> block </th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($agents as $agent)
                       
                
                    <tr>
                   
                      <td>{{$agent->name}}</td>
                      <td>{{$agent->email}}</td>
                      <td>{{$agent->phone}}</td>
                      <td>{{$agent->state}}</td>
                      <td>{{count(DB::table('users')->where('own_by', $agent->id)->get())}}</td>
                      <td>agents own terminal but then terminal are users</td>
                      <td>{{DB::table('agent_credits')->where('agent_id', $agent->id)->value('credit')}}</td>
                      {{-- <td><button type="button" class="btn btn-primary btn-sm">edit</button></td> --}}
                      <td><button type="button" class="btn btn-danger btn-sm">block</button></td>
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
{{-- ///////// --}}
@endsection