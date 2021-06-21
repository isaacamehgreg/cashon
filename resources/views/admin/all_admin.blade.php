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
                      <th> Amount Allocated </th>
                      <th> Amount Remited </th>
                      <th> Amount Pending </th>
                      <th> Resolve </th>
                      <th> block </th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($admins as $admin)
                       
                
                    <tr>
                   
                      <td>{{$admin->name}}</td>
                      <td>{{$admin->email}}</td>
                      <td>{{$admin->phone}}</td>
                      <td>{{$admin->state}}</td>
                      <td>{{count(DB::table('cashiers')->where('agent_id', $admin->id)->get())}}</td>
                      <td>{{DB::table('agent_credits')->where('agent_id', $admin->id)->value('cash_allocated') ?? 0}}</td>
                      <td>{{DB::table('agent_credits')->where('agent_id', $admin->id)->value('cash_remitted') ?? 0}}</td>
                      <td>{{DB::table('agent_credits')->where('agent_id', $admin->id)->value('pending') ?? 0}}</td>
                      <td><button type="button" class="btn btn-success btn-sm">Resolve</button></td>
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