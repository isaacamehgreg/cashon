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
              <div class="col-lg-6 mx-auto grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title text-center">Edit Game</h4>
                      <form method="post" action="create_game" class="form-sample"> @csrf
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Game Name:</label>
                              <div class="col-sm-9">
                                <input type="text" name="game_name" class="form-control" value="" placeholder="Enter game name" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Draw:</label>
                              <div class="col-sm-9">
                                <input name="draw" type="number" class="form-control" value="" placeholder="" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Day:</label>
                                <div class="col-sm-9">
                                  <input name="day" type="text" class="form-control" value="" placeholder="eg monday" />
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Game Code:</label>
                                <div class="col-sm-9">
                                  <input name="game_code" type="number" class="form-control" value="" placeholder="eg 100" />
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Time:</label>
                                <div class="col-sm-9">
                                  <input name="time" type="number" class="form-control" value="" placeholder="eg 9"/>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Two Combo:</label>
                                <div class="col-sm-9">
                                  <input name="2" type="number" class="form-control" value="" placeholder=""/>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Three Combo:</label>
                                <div class="col-sm-9">
                                  <input name="3" type="number" class="form-control" value="" placeholder=""/>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Four Combo:</label>
                                <div class="col-sm-9">
                                  <input name="4" type="number" class="form-control" value="" placeholder=""/>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Five Combo:</label>
                                <div class="col-sm-9">
                                  <input name="5" type="number" class="form-control" value="" placeholder=""/>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-success mr-2">Submit</button>
                        
                        </div>
                        
                      </form>
                    </div>
                  </div>
                </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- content-wrapper ends -->
{{-- ///////// --}}
@endsection