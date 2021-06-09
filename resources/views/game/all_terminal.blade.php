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
                      
                      <th> Terminal id </th>
                      <th> owner </th>
                      <th> terminal_phone </th>
                      <th> Area in Charge </th>
                      <th> No. of terminals </th>
                      <th> revenue paid </th>
                      <th> payment due </th>
                      <th> Edit </th>
                      <th> Delete </th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($terminals as $terminal)
                       
                
                    <tr>
                   
                      <td>{{$terminal->id}}</td>
                      <td>{{DB::table('users')->where('id',$terminal->own_by)->value('name')}}</td>
                      <td>{{$terminal->phone}}</td>
                      <td>{{$terminal->state}}</td>
                      <td>agents own terminal but then terminal are users</td>
                      <td>agents own terminal but then terminal are users</td>
                      <td>agents own terminal but then terminal are users</td>
                      <td><button type="button" class="btn btn-primary btn-sm">edit</button></td>
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