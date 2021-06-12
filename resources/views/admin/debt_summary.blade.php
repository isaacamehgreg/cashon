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
                    {{-- <p><span>Pending: 37</span> <span>Cleared: 78</span></p> --}}
                    <table class="table table-striped">
                      <thead>
                        <tr>
                         
                          <th>Agent </th>
                          <th>Dues Paid </th>
                          <th>Deus to be paid </th>
                          <th>Total Fines</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($debts as $debt)

                        <tr>
                      
                          <td>{{$debt->agent_id}}</td>
                          <td>{{$debt->dues_paid}}</td>
                          <td>{{$debt->dues_to_be_paid}}</td>
                          <td>{{$debt->total_fines}}</td>

                          <td>{{$debt->status}}</td>
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