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
                      <th> S/n </th>
                      <th> Name </th>
                      <th> Area in Charge </th>
                      <th> No. of terminals </th>
                      <th> revenue paid </th>
                      <th> payment due </th>
                      <th> Edit </th>
                      <th> Delete </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td> 1 </td>
                      <td>Leggo</td>
                      <td>Lekki-Epe</td>
                      <td>25</td>
                      <td>36,675</td>
                      <td><a href="#">20,000</a></td>
                      <td><button type="button" class="btn btn-primary btn-sm">edit</button></td>
                      <td><button type="button" class="btn btn-danger btn-sm">block</button></td>
                    </tr>
                    <tr>
                      <td> 1 </td>
                      <td>Leggo</td>
                      <td>Lekki-Epe</td>
                      <td>25</td>
                      <td>36,675</td>
                      <td><a href="#">20,000</a></td>
                      <td><button type="button" class="btn btn-primary btn-sm">edit</button></td>
                      <td><button type="button" class="btn btn-danger btn-sm">block</button></td>
                    </tr>
                    <tr>
                      <td> 1 </td>
                      <td>Leggo</td>
                      <td>Lekki-Epe</td>
                      <td>25</td>
                      <td>36,675</td>
                      <td><a href="#">20,000</a></td>
                      <td><button type="button" class="btn btn-primary btn-sm">edit</button></td>
                      <td><button type="button" class="btn btn-danger btn-sm">block</button></td>
                    </tr>
                    <tr>
                      <td> 1 </td>
                      <td>Leggo</td>
                      <td>Lekki-Epe</td>
                      <td>25</td>
                      <td>36,675</td>
                      <td><a href="#">20,000</a></td>
                      <td><button type="button" class="btn btn-primary btn-sm">edit</button></td>
                      <td><button type="button" class="btn btn-danger btn-sm">block</button></td>
                    </tr>
                    <tr>
                      <td> 1 </td>
                      <td>Leggo</td>
                      <td>Lekki-Epe</td>
                      <td>25</td>
                      <td>36,675</td>
                      <td><a href="#">20,000</a></td>
                      <td><button type="button" class="btn btn-primary btn-sm">edit</button></td>
                      <td><button type="button" class="btn btn-danger btn-sm">block</button></td>
                    </tr>
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