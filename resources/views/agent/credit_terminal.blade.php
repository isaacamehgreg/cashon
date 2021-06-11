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
            <div class="col-md-6 mx-auto grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Allocate Credit to your Cashier</h4>
                    <form method="post" action="/_credit_an_agent" class="forms-sample">@csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select </label>
                            <select name="agent" class="form-control form-control-lg" id="exampleFormControlSelect1">
                              <option>--select cashier to credit--</option>
                              @foreach ($cashiers as $cashier)
                                  <option value="{{$cashier->id}}">{{$cashier->name}}</option>
                              @endforeach
                              
                              
                            </select>
                          </div>
                      <div class="form-group">
                        <label for="amount">Enter Amount</label>
                        <input type="number" name="credit" class="form-control" id="amount" placeholder="Credit allowance">
                      </div>
                      <button type="submit" class="btn btn-success mr-2">Credit</button>
                
                    </form>
                  </div>
                </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
{{-- ///////// --}}
@endsection