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
                
            
                </div>
                <form method='post' class="w-50" action="/track_terminal">
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
                          <h3 class="mb-0 font-weight-semibold">{{DB::table('users')->where('role','agent')->count()}}</h3>
                          <h5 class="mb-0 font-weight-medium text-primary">No. of Agents</h5>
                        </div>
                        <div class="wrapper my-auto ml-auto ml-lg-4">
                            <canvas height="50" width="100" id="stats-line-graph-1"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">{{DB::table('cashiers')->get()->count()}}</h3>
                          <h5 class="mb-0 font-weight-medium text-primary">No. of Terminals</h5>
                        </div>
                        <div class="wrapper my-auto ml-auto ml-lg-4">
                          <canvas height="50" width="100" id="stats-line-graph-2"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">N <?php
                            $cash = 0;
                            foreach (DB::table('bets')->get() as $bet ) {
                              $cash = $cash + $bet->stake;
                            }
                          echo number_format($cash);
                          ?></h3>
                          <h5 class="mb-0 font-weight-medium text-primary">Revenue</h5>
                        </div>
                        <div class="wrapper my-auto ml-auto ml-lg-4">
                          <canvas height="50" width="100" id="stats-line-graph-3"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                      <div class="d-flex">
                        <div class="wrapper">
                          <h3 class="mb-0 font-weight-semibold">{{DB::table('bets')->get()->count()}}</h3>
                          <h5 class="mb-0 font-weight-medium text-primary">Total bets</h5>
                        </div>
                        <div class="wrapper my-auto ml-auto ml-lg-4">
                          <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
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
                <div class="card-body table-responsive">
                 <table class="table table-striped">
                  <thead>
                    <tr>
                      
                     
                      <th> Game Name </th>
                      <th> Draw </th>
                      <th> Game Code </th>
                       <th> Day </th>
                      <th> Game Time </th>
                      <th> 2 combination </th>
                      <th> 3 combination </th>
                      <th> 4 combination </th>
                      <th> 5 combination </th> 
                       <th> Edit </th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   @foreach (DB::table('games')->get() as $game)
                       
                
                    <tr>
                     
                      <td>{{$game->game_name}}</td>
                      <td>{{$game->draw}}</td>
                      <td>{{$game->game_code}}</td>
                      <td>{{$game->day}}</td>
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
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
                  <h4 class="card-title mb-0">BET Overview</h4>
                  <id id="pie-chart-legend" class="mr-4">{{DB::table('bets')->get()->count()}}</id>
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
                        <h4 class="card-title mb-0">Amount Raked</h4>

                        <p class="font-weight-semibold mb-0">Raked Percentage {{DB::table('rakes')->where('id',1)->value('percentage_raked') ?? 60 }}%</p>
                      </div>
                      <h3 class="font-weight-medium mb-4">N{{ number_format(DB::table('rakes')->where('id',1)->value('total_raked'))}}</h3>
                    </div>
                    <canvas class="mt-n4" height="90" id="total-revenue"></canva>
                  </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body pb-0">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Total Amount Pooled</h4>
                        <p class="font-weight-semibold mb-0">{{number_format(DB::table('pools')->where('id',1)->value('percentage_pool'))}}%</p>
                      </div>
                      <h3 class="font-weight-medium">N {{number_format(DB::table('pools')->where('id',1)->value('total_pool'))}}</h3>
                    </div>
                    <canvas class="mt-n3" height="90" id="total-transaction"></canvas>
                  </div>
                </div>
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">All tickets</h4>
                        <a href="#"><small>Show All</small></a>
                      </div>
                      <p></p>
                      <div class="table-responsive">
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              
                              <th>Game Code</th>
                              <th>Ticket Number</th>
                              <th>Bet Code</th>
                              <th>Stake</th>
                              <th>Status</th>
                              <th>Result Status</th>
                              <th>Payouts</th>
                              {{-- //win or loss --}}
                             
                              
                            </tr>
                          </thead>
                          <tbody>
                            @foreach(DB::table('bets')->orderBy('created_at', 'DESC')->get() as $bet)
                            <tr>
                         
                              
                              <td >{{$bet->game_code}}</td>
                              <td >{{$bet->ticket_number}}</td>
                              <td class="text-primary">{{$bet->bet_code}}</td>
                              <td class="text-danger">{{$bet->stake}}</td>
                              <td class="text-info">{{$bet->status ?? 'pending'}}</td>
                              @if ($bet->result_status == "won")
                              <td class="text-success">{{$bet->result_status ?? 'not yet played'}}</td>
                              @else
                              <td class="text-danger">{{$bet->result_status ?? 'not yet played'}}</td>
                              @endif
                              <td class="text-info">{{$bet->payout ?? 'N 0'}}</td>

                             
                              
                            
                            </tr>
                            @endforeach
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
                      <h4 class="card-title mb-0">Top Agents.</h4>
                      <?php $_agents = DB::table('users')->where('role', 'agent')->get();?>
                      @foreach($_agents as $agent)
                      <div class="d-flex mt-3 py-2 border-bottom">
                        <img class="img-sm rounded-circle" src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" alt="profile image">
                        <div class="wrapper ml-2">
                          <p class="mb-n1 font-weight-semibold">{{$agent->name}}</p>
                          <small>{{$agent->address}}</small>
                        </div>
                        <small class="text-muted ml-auto">Terminals owned: {{DB::table('cashiers')->where('agent_id',$agent->id)->get()->count()}}</small>
                      </div>
                      @endforeach
                   
                    
                    </div>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title mb-0">Top Terminals </h4>
                      <?php $_cashiers = DB::table('cashiers')->get();?>
                      @foreach($_cashiers as $cashier)
                      <div class="d-flex mt-3 py-2 border-bottom">
                        <img class="img-sm rounded-circle" src="http://www.imakusvisiontech.com/wp-content/uploads/2021/03/s90.jpg" alt="profile image">
                        <div class="wrapper ml-2">
                          <small>Cashier Code: {{$cashier->cashier_code}}</small>
                          <p class="mb-n1 font-weight-semibold">Total Bet Placed: {{DB::table('bets')->where('cashier_id',$cashier->cashier_id)->get()->count()}}</p>
                          <small>Location: {{$cashier->area}}</small>
                        </div>
                        <small class="mb-n1 font-weight-semibold">Revenue Generated: {{DB::table('users')->where('id',$cashier->agent_id)->get()->count()}}</small>
                        <small class="text-muted ml-auto">Owner: {{DB::table('users')->where('id',$cashier->agent_id)->value('name')}}</small>
                      </div>
                      @endforeach
                   
                    
                    </div>
                  </div>
                </div>
              </div>

              <div>
                <table border="0" cellspacing="5" cellpadding="5">
                  <tbody><tr>
                      <td>Minimum age:</td>
                      <td><input type="text" id="min" name="min"></td>
                  </tr>
                  <tr>
                      <td>Maximum age:</td>
                      <td><input type="text" id="max" name="max"></td>
                  </tr>
              </tbody></table>
              <table id="example" class="display" style="width:100%">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Position</th>
                          <th>Office</th>
                          <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>Tiger Nixon</td>
                          <td>System Architect</td>
                          <td>Edinburgh</td>
                          <td>61</td>
                          <td>2011/04/25</td>
                          <td>$320,800</td>
                      </tr>
                      <tr>
                          <td>Garrett Winters</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                          <td>63</td>
                          <td>2011/07/25</td>
                          <td>$170,750</td>
                      </tr>
                      <tr>
                          <td>Ashton Cox</td>
                          <td>Junior Technical Author</td>
                          <td>San Francisco</td>
                          <td>66</td>
                          <td>2009/01/12</td>
                          <td>$86,000</td>
                      </tr>
                      <tr>
                          <td>Cedric Kelly</td>
                          <td>Senior Javascript Developer</td>
                          <td>Edinburgh</td>
                          <td>22</td>
                          <td>2012/03/29</td>
                          <td>$433,060</td>
                      </tr>
                      <tr>
                          <td>Airi Satou</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                          <td>33</td>
                          <td>2008/11/28</td>
                          <td>$162,700</td>
                      </tr>
                      <tr>
                          <td>Brielle Williamson</td>
                          <td>Integration Specialist</td>
                          <td>New York</td>
                          <td>61</td>
                          <td>2012/12/02</td>
                          <td>$372,000</td>
                      </tr>
                      <tr>
                          <td>Herrod Chandler</td>
                          <td>Sales Assistant</td>
                          <td>San Francisco</td>
                          <td>59</td>
                          <td>2012/08/06</td>
                          <td>$137,500</td>
                      </tr>
                      <tr>
                          <td>Rhona Davidson</td>
                          <td>Integration Specialist</td>
                          <td>Tokyo</td>
                          <td>55</td>
                          <td>2010/10/14</td>
                          <td>$327,900</td>
                      </tr>
                      <tr>
                          <td>Colleen Hurst</td>
                          <td>Javascript Developer</td>
                          <td>San Francisco</td>
                          <td>39</td>
                          <td>2009/09/15</td>
                          <td>$205,500</td>
                      </tr>
                      <tr>
                          <td>Sonya Frost</td>
                          <td>Software Engineer</td>
                          <td>Edinburgh</td>
                          <td>23</td>
                          <td>2008/12/13</td>
                          <td>$103,600</td>
                      </tr>
                      <tr>
                          <td>Jena Gaines</td>
                          <td>Office Manager</td>
                          <td>London</td>
                          <td>30</td>
                          <td>2008/12/19</td>
                          <td>$90,560</td>
                      </tr>
                      <tr>
                          <td>Quinn Flynn</td>
                          <td>Support Lead</td>
                          <td>Edinburgh</td>
                          <td>22</td>
                          <td>2013/03/03</td>
                          <td>$342,000</td>
                      </tr>
                      <tr>
                          <td>Charde Marshall</td>
                          <td>Regional Director</td>
                          <td>San Francisco</td>
                          <td>36</td>
                          <td>2008/10/16</td>
                          <td>$470,600</td>
                      </tr>
                      <tr>
                          <td>Haley Kennedy</td>
                          <td>Senior Marketing Designer</td>
                          <td>London</td>
                          <td>43</td>
                          <td>2012/12/18</td>
                          <td>$313,500</td>
                      </tr>
                      <tr>
                          <td>Tatyana Fitzpatrick</td>
                          <td>Regional Director</td>
                          <td>London</td>
                          <td>19</td>
                          <td>2010/03/17</td>
                          <td>$385,750</td>
                      </tr>
                      <tr>
                          <td>Michael Silva</td>
                          <td>Marketing Designer</td>
                          <td>London</td>
                          <td>66</td>
                          <td>2012/11/27</td>
                          <td>$198,500</td>
                      </tr>
                      <tr>
                          <td>Paul Byrd</td>
                          <td>Chief Financial Officer (CFO)</td>
                          <td>New York</td>
                          <td>64</td>
                          <td>2010/06/09</td>
                          <td>$725,000</td>
                      </tr>
                      <tr>
                          <td>Gloria Little</td>
                          <td>Systems Administrator</td>
                          <td>New York</td>
                          <td>59</td>
                          <td>2009/04/10</td>
                          <td>$237,500</td>
                      </tr>
                      <tr>
                          <td>Bradley Greer</td>
                          <td>Software Engineer</td>
                          <td>London</td>
                          <td>41</td>
                          <td>2012/10/13</td>
                          <td>$132,000</td>
                      </tr>
                      <tr>
                          <td>Dai Rios</td>
                          <td>Personnel Lead</td>
                          <td>Edinburgh</td>
                          <td>35</td>
                          <td>2012/09/26</td>
                          <td>$217,500</td>
                      </tr>
                      <tr>
                          <td>Jenette Caldwell</td>
                          <td>Development Lead</td>
                          <td>New York</td>
                          <td>30</td>
                          <td>2011/09/03</td>
                          <td>$345,000</td>
                      </tr>
                      <tr>
                          <td>Yuri Berry</td>
                          <td>Chief Marketing Officer (CMO)</td>
                          <td>New York</td>
                          <td>40</td>
                          <td>2009/06/25</td>
                          <td>$675,000</td>
                      </tr>
                      <tr>
                          <td>Caesar Vance</td>
                          <td>Pre-Sales Support</td>
                          <td>New York</td>
                          <td>21</td>
                          <td>2011/12/12</td>
                          <td>$106,450</td>
                      </tr>
                      <tr>
                          <td>Doris Wilder</td>
                          <td>Sales Assistant</td>
                          <td>Sydney</td>
                          <td>23</td>
                          <td>2010/09/20</td>
                          <td>$85,600</td>
                      </tr>
                      <tr>
                          <td>Angelica Ramos</td>
                          <td>Chief Executive Officer (CEO)</td>
                          <td>London</td>
                          <td>47</td>
                          <td>2009/10/09</td>
                          <td>$1,200,000</td>
                      </tr>
                      <tr>
                          <td>Gavin Joyce</td>
                          <td>Developer</td>
                          <td>Edinburgh</td>
                          <td>42</td>
                          <td>2010/12/22</td>
                          <td>$92,575</td>
                      </tr>
                      <tr>
                          <td>Jennifer Chang</td>
                          <td>Regional Director</td>
                          <td>Singapore</td>
                          <td>28</td>
                          <td>2010/11/14</td>
                          <td>$357,650</td>
                      </tr>
                      <tr>
                          <td>Brenden Wagner</td>
                          <td>Software Engineer</td>
                          <td>San Francisco</td>
                          <td>28</td>
                          <td>2011/06/07</td>
                          <td>$206,850</td>
                      </tr>
                      <tr>
                          <td>Fiona Green</td>
                          <td>Chief Operating Officer (COO)</td>
                          <td>San Francisco</td>
                          <td>48</td>
                          <td>2010/03/11</td>
                          <td>$850,000</td>
                      </tr>
                      <tr>
                          <td>Shou Itou</td>
                          <td>Regional Marketing</td>
                          <td>Tokyo</td>
                          <td>20</td>
                          <td>2011/08/14</td>
                          <td>$163,000</td>
                      </tr>
                      <tr>
                          <td>Michelle House</td>
                          <td>Integration Specialist</td>
                          <td>Sydney</td>
                          <td>37</td>
                          <td>2011/06/02</td>
                          <td>$95,400</td>
                      </tr>
                      <tr>
                          <td>Suki Burks</td>
                          <td>Developer</td>
                          <td>London</td>
                          <td>53</td>
                          <td>2009/10/22</td>
                          <td>$114,500</td>
                      </tr>
                      <tr>
                          <td>Prescott Bartlett</td>
                          <td>Technical Author</td>
                          <td>London</td>
                          <td>27</td>
                          <td>2011/05/07</td>
                          <td>$145,000</td>
                      </tr>
                      <tr>
                          <td>Gavin Cortez</td>
                          <td>Team Leader</td>
                          <td>San Francisco</td>
                          <td>22</td>
                          <td>2008/10/26</td>
                          <td>$235,500</td>
                      </tr>
                      <tr>
                          <td>Martena Mccray</td>
                          <td>Post-Sales support</td>
                          <td>Edinburgh</td>
                          <td>46</td>
                          <td>2011/03/09</td>
                          <td>$324,050</td>
                      </tr>
                      <tr>
                          <td>Unity Butler</td>
                          <td>Marketing Designer</td>
                          <td>San Francisco</td>
                          <td>47</td>
                          <td>2009/12/09</td>
                          <td>$85,675</td>
                      </tr>
                      <tr>
                          <td>Howard Hatfield</td>
                          <td>Office Manager</td>
                          <td>San Francisco</td>
                          <td>51</td>
                          <td>2008/12/16</td>
                          <td>$164,500</td>
                      </tr>
                      <tr>
                          <td>Hope Fuentes</td>
                          <td>Secretary</td>
                          <td>San Francisco</td>
                          <td>41</td>
                          <td>2010/02/12</td>
                          <td>$109,850</td>
                      </tr>
                      <tr>
                          <td>Vivian Harrell</td>
                          <td>Financial Controller</td>
                          <td>San Francisco</td>
                          <td>62</td>
                          <td>2009/02/14</td>
                          <td>$452,500</td>
                      </tr>
                      <tr>
                          <td>Timothy Mooney</td>
                          <td>Office Manager</td>
                          <td>London</td>
                          <td>37</td>
                          <td>2008/12/11</td>
                          <td>$136,200</td>
                      </tr>
                      <tr>
                          <td>Jackson Bradshaw</td>
                          <td>Director</td>
                          <td>New York</td>
                          <td>65</td>
                          <td>2008/09/26</td>
                          <td>$645,750</td>
                      </tr>
                      <tr>
                          <td>Olivia Liang</td>
                          <td>Support Engineer</td>
                          <td>Singapore</td>
                          <td>64</td>
                          <td>2011/02/03</td>
                          <td>$234,500</td>
                      </tr>
                      <tr>
                          <td>Bruno Nash</td>
                          <td>Software Engineer</td>
                          <td>London</td>
                          <td>38</td>
                          <td>2011/05/03</td>
                          <td>$163,500</td>
                      </tr>
                      <tr>
                          <td>Sakura Yamamoto</td>
                          <td>Support Engineer</td>
                          <td>Tokyo</td>
                          <td>37</td>
                          <td>2009/08/19</td>
                          <td>$139,575</td>
                      </tr>
                      <tr>
                          <td>Thor Walton</td>
                          <td>Developer</td>
                          <td>New York</td>
                          <td>61</td>
                          <td>2013/08/11</td>
                          <td>$98,540</td>
                      </tr>
                      <tr>
                          <td>Finn Camacho</td>
                          <td>Support Engineer</td>
                          <td>San Francisco</td>
                          <td>47</td>
                          <td>2009/07/07</td>
                          <td>$87,500</td>
                      </tr>
                      <tr>
                          <td>Serge Baldwin</td>
                          <td>Data Coordinator</td>
                          <td>Singapore</td>
                          <td>64</td>
                          <td>2012/04/09</td>
                          <td>$138,575</td>
                      </tr>
                      <tr>
                          <td>Zenaida Frank</td>
                          <td>Software Engineer</td>
                          <td>New York</td>
                          <td>63</td>
                          <td>2010/01/04</td>
                          <td>$125,250</td>
                      </tr>
                      <tr>
                          <td>Zorita Serrano</td>
                          <td>Software Engineer</td>
                          <td>San Francisco</td>
                          <td>56</td>
                          <td>2012/06/01</td>
                          <td>$115,000</td>
                      </tr>
                      <tr>
                          <td>Jennifer Acosta</td>
                          <td>Junior Javascript Developer</td>
                          <td>Edinburgh</td>
                          <td>43</td>
                          <td>2013/02/01</td>
                          <td>$75,650</td>
                      </tr>
                      <tr>
                          <td>Cara Stevens</td>
                          <td>Sales Assistant</td>
                          <td>New York</td>
                          <td>46</td>
                          <td>2011/12/06</td>
                          <td>$145,600</td>
                      </tr>
                      <tr>
                          <td>Hermione Butler</td>
                          <td>Regional Director</td>
                          <td>London</td>
                          <td>47</td>
                          <td>2011/03/21</td>
                          <td>$356,250</td>
                      </tr>
                      <tr>
                          <td>Lael Greer</td>
                          <td>Systems Administrator</td>
                          <td>London</td>
                          <td>21</td>
                          <td>2009/02/27</td>
                          <td>$103,500</td>
                      </tr>
                      <tr>
                          <td>Jonas Alexander</td>
                          <td>Developer</td>
                          <td>San Francisco</td>
                          <td>30</td>
                          <td>2010/07/14</td>
                          <td>$86,500</td>
                      </tr>
                      <tr>
                          <td>Shad Decker</td>
                          <td>Regional Director</td>
                          <td>Edinburgh</td>
                          <td>51</td>
                          <td>2008/11/13</td>
                          <td>$183,000</td>
                      </tr>
                      <tr>
                          <td>Michael Bruce</td>
                          <td>Javascript Developer</td>
                          <td>Singapore</td>
                          <td>29</td>
                          <td>2011/06/27</td>
                          <td>$183,000</td>
                      </tr>
                      <tr>
                          <td>Donna Snider</td>
                          <td>Customer Support</td>
                          <td>New York</td>
                          <td>27</td>
                          <td>2011/01/25</td>
                          <td>$112,000</td>
                      </tr>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th>Name</th>
                          <th>Position</th>
                          <th>Office</th>
                          <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th>
                      </tr>
                  </tfoot>
              </table>
              </div>




            </div>

        

          </div>
        </div>
        <!-- content-wrapper ends -->
{{-- ///////// --}}


<Script>
  //table filter
  /* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[3] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    var table = $('#example').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    } );
} );
</Script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


@endsection