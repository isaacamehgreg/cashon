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
                      <h3>Total No: 457</h3>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> S/n </th>
                            <th> Terminal Id </th>
                            <th> Location </th>
                            <th> Assigned agent </th>
                            <th> payment due </th>
                            <th>Credit Status</th>
                            <th> Block </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> 1 </td>
                            <td>NG-IM-0001-C0001</td>
                            <td>5 Eru ifa street, Lekki</td>
                            <td>NG-IM-0001</td>
                            <td>$36,675</td>
                            <td>$10,000</td>
                            <td><button type="button" class="btn btn-primary btn-sm">block</button></td>
                          </tr>
                          <tr>
                            <td> 1 </td>
                            <td>NG-IM-0001-C0001</td>
                            <td>5 Eru ifa street, Lekki</td>
                            <td>NG-IM-0001</td>
                            <td>$36,675</td>
                            <td>$10,000</td>
                            <td><button type="button" class="btn btn-primary btn-sm">block</button></td>
                          </tr>
                          <tr>
                            <td> 1 </td>
                            <td>NG-IM-0001-C0001</td>
                            <td>5 Eru ifa street, Lekki</td>
                            <td>NG-IM-0001</td>
                            <td>$36,675</td>
                            <td>$10,000</td>
                            <td><button type="button" class="btn btn-primary btn-sm">block</button></td>
                          </tr>
                          <tr>
                            <td> 1 </td>
                            <td>NG-IM-0001-C0001</td>
                            <td>5 Eru ifa street, Lekki</td>
                            <td>NG-IM-0001</td>
                            <td>$36,675</td>
                            <td>$10,000</td>
                            <td><button type="button" class="btn btn-primary btn-sm">block</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <!-- content-wrapper ends -->
          
        @endsection