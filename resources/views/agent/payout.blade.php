@extends('layouts.app')
@section('content')
{{-- //////     --}}


     <!-- partial -->
     <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.agent_menu')

      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-md-6 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Reconcile Your Debt</h4>
                  <form method="post" action="_payout" class="forms-sample">
                    @csrf
                    
                

                    
                    <input type="text" name="agent" class="form-control" id="exampleInputName1" placeholder="Name" value="{{Auth::user()->id}}" hidden>
                    

                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>
                
                    <div class="form-group">
                      <label for="exampleInputEmail3">Cashier Code</label>
                      <input type="number" name="code" class="form-control" id="exampleInputEmail3" max-length="6" placeholder="Cashier code">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                    </div>
                  
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
               
                  </form>
                </div>
              </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
{{-- ///////// --}}
@endsection