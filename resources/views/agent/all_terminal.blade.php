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
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h3>Total No: {{count($cashiers) ?? 0}}</h3>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            
                            <th> Cashier Name </th>
                            <th> Cashier Code </th>
                            <th> Cash Allocated </th>
                            <th> Cash Remitted </th>
                            <th>Area</th>
                            <th> Phone </th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($cashiers as $cashier)
                          <tr>
                            <td> </td>
                            <td>{{$cashier->name}}</td>
                            <td>5 Eru ifa street, Lekki</td>
                            <td>NG-IM-0001</td>
                            <td>$36,675</td>
                            <td>$10,000</td>
                            <td><button type="button" class="btn btn-primary btn-sm">block</button></td>
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