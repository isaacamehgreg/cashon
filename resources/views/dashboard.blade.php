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
          <!-- Page Title Header Starts-->
          <div class="row page-title-header">
            <div class="col-12">
            </div>
            <div class="col-md-12">
              <div class="d-flex justify-content-between align items center">
                <div class="page-header-toolbar">
                  <div class="btn-group toolbar-item" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary"><i class="mdi mdi-chevron-left"></i></button>
                    <button type="button" class="btn btn-secondary">03/02/2019 - 20/08/2019</button>
                    <button type="button" class="btn btn-secondary"><i class="mdi mdi-chevron-right"></i></button>
                  </div>
                  <div class="filter-wrapper">
                    <div class="dropdown toolbar-item">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownsorting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Day</button>
                      <div class="dropdown-menu" aria-labelledby="dropdownsorting">
                        <a class="dropdown-item" href="#">Last Day</a>
                        <a class="dropdown-item" href="#">Last Month</a>
                        <a class="dropdown-item" href="#">Last Year</a>
                      </div>
                    </div>
                  </div>
                </div>
                <form class="w-50" action="dotun.php">
                  <div class="form-group mb-0 row">
                    <label class="col-sm-4 col-form-label">Track terminal</label>
                    <div class="col-sm-8">
                      <input type="search" class="form-control" placeholder="Enter Terminal ID" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Page Title Header Ends-->
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-6">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">32,451</h3>
                          <h5 class="mb-0 font-weight-medium text-primary">No. of Agents</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">15,236</h3>
                          <h5 class="mb-0 font-weight-medium text-primary">No. of Terminals</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">120,688</h3>
                          <h5 class="mb-0 font-weight-medium text-primary">Today's Revenue</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">1,553</h3>
                          <h5 class="mb-0 font-weight-medium text-primary">Today's Transactions</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th> S/N </th>
                        <th> Counter ID </th>
                        <th> Max Limit </th>
                        <th> Edit </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> 1 </td>
                        <td>
                          653
                        </td>
                        <td> 300,000</td>
                        <td><a href="#"> edit </a></td>
                      </tr>
                      <tr>
                        <td> 2 </td>
                        <td>
                          567
                        </td>
                        <td> 865 </td>
                        <td><a href="#"> edit </a></td>
                      </tr>
                      <tr>
                        <td>3 </td>
                        <td>
                          566
                        </td>
                        <td> 234,000 </td>
                        <td><a href="#"> edit </a></td>
                      </tr>
                      <tr>
                        <td> 4 </td>
                        <td>
                          766
                        </td>
                        <td> 675,000 </td>
                        <td><a href="#"> edit </a></td>
                      </tr>
                      <tr>
                        <td> 5 </td>
                        <td>
                          323
                        </td>
                        <td> 445,089 </td>
                        <td><a href="#"> edit </a></td>
                      </tr>
                      <tr>
                        <td> 6 </td>
                        <td>
                          788
                        </td>
                        <td> 657,089 </td>
                        <td><a href="#"> edit </a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
                  <h4 class="card-title mb-0">Pie chart</h4>
                  <id id="pie-chart-legend" class="mr-4"></id>
                </div>
                <div class="card-body d-flex">
                  <canvas class="my-auto" id="pieChart" height="130"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body pb-0">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">No. of Bets</h4>
                        <p class="font-weight-semibold mb-0">+1.37%</p>
                      </div>
                      <h3 class="font-weight-medium mb-4">184.42K</h3>
                    </div>
                    <canvas class="mt-n4" height="90" id="total-revenue"></canva>
                  </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body pb-0">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">No. of Total Transactions</h4>
                        <p class="font-weight-semibold mb-0">-2.87%</p>
                      </div>
                      <h3 class="font-weight-medium">147.7K</h3>
                    </div>
                    <canvas class="mt-n3" height="90" id="total-transaction"></canva>
                  </div>
                </div>
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Invoice</h4>
                        <a href="#"><small>Show All</small></a>
                      </div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quod cupiditate esse fuga</p>
                      <div class="table-responsive">
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th>Invoice ID</th>
                              <th>Customer</th>
                              <th>Status</th>
                              <th>Due Date</th>
                              <th>Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>INV-87239</td>
                              <td>Viola Ford</td>
                              <td>Paid</td>
                              <td>20 Jan 2019</td>
                              <td>$755</td>
                            </tr>
                            <tr>
                              <td>INV-87239</td>
                              <td>Dylan Waters</td>
                              <td>Unpaid</td>
                              <td>23 Feb 2019</td>
                              <td>$800</td>
                            </tr>
                            <tr>
                              <td>INV-87239</td>
                              <td>Louis Poole</td>
                              <td>Unpaid</td>
                              <td>25 Mar 2019</td>
                              <td>$463</td>
                            </tr>
                            <tr>
                              <td>INV-87239</td>
                              <td>Vera Howell</td>
                              <td>Paid</td>
                              <td>27 Mar 2019</td>
                              <td>$235</td>
                            </tr>
                            <tr>
                              <td>INV-87239</td>
                              <td>Allie Goodman</td>
                              <td>Unpaid</td>
                              <td>1 Apr 2019</td>
                              <td>$657</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title mb-0">Top Agents</h4>
                      <div class="d-flex mt-3 py-2 border-bottom">
                        <img class="img-sm rounded-circle" src="assets/images/faces/face3.jpg" alt="profile image">
                        <div class="wrapper ml-2">
                          <p class="mb-n1 font-weight-semibold">Ray Douglas</p>
                          <small>162543</small>
                        </div>
                        <small class="text-muted ml-auto">#1,000,000</small>
                      </div>
                      <div class="d-flex py-2 border-bottom">
                        <span class="img-sm rounded-circle bg-warning text-white text-avatar">OH</span>
                        <div class="wrapper ml-2">
                          <p class="mb-n1 font-weight-semibold">Ora Hill</p>
                          <small>162543</small>
                        </div>
                        <small class="text-muted ml-auto">#560,000</small>
                      </div>
                      <div class="d-flex py-2 border-bottom">
                        <img class="img-sm rounded-circle" src="assets/images/faces/face4.jpg" alt="profile image">
                        <div class="wrapper ml-2">
                          <p class="mb-n1 font-weight-semibold">Brian Dean</p>
                          <small>162543</small>
                        </div>
                        <small class="text-muted ml-auto">#200,000</small>
                      </div>
                      <div class="d-flex pt-2">
                        <span class="img-sm rounded-circle bg-success text-white text-avatar">OB</span>
                        <div class="wrapper ml-2">
                          <p class="mb-n1 font-weight-semibold">Olive Bridges</p>
                          <small>162543</small>
                        </div>
                        <small class="text-muted ml-auto">#90,000</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
{{-- ///////// --}}
@endsection