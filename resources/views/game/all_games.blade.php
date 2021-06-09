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
                      
                      <th> Day </th>
                      <th> Game Name </th>
                      <th> Draw </th>
                      <th> Game Code </th>
                      <th> Game Time </th>
                      <th> 2 combination </th>
                      <th> 3 combination </th>
                      <th> 4 combination </th>
                      <th> 5 combination </th>
                      {{-- <th> Edit </th> --}}
                      <th> edit </th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($games as $game)
                       
                
                    <tr>
                      <td>{{$game->day}}</td>
                      <td>{{$game->game_name}}</td>
                      <td>{{$game->draw}}</td>
                      <td>{{$game->game_code}}</td>
                      
                      <td>{{$game->time}}</td>
                      <td>{{$game->2}}</td>
                      <td>{{$game->3}}</td>
                      <td>{{$game->4}}</td>
                      <td>{{$game->5}}</td>
               
                      
            
                      <td><button type="button" class="btn btn-secondary btn-sm">block</button></td>
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