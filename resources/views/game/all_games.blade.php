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
      </div>
    </div>

        <!-- content-wrapper ends -->
{{-- ///////// --}}
@endsection