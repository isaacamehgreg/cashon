<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background: #0c0d50;">
      <a class="navbar-brand brand-logo" href="index.html">
        <img src="assets/images/cashonlotto.png" alt="logo" /> </a>
      <a class="navbar-brand brand-logo-mini" href="index.html">
        <img src="assets/images/logo-mini.svg" alt="logo" /> </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
      <form class="ml-auto search-form d-none d-md-block" action="#">
        <div class="form-group">
          <input type="search" class="form-control" placeholder="Search Here">
        </div>
      </form>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
          <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image"> </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
              <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image">
              <p class="mb-1 mt-3 font-weight-semibold">Admin</p>
          
            </div>
    
            <a href='/logout' class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background: #0c0d50;">
      <ul class="nav">
        <li class="nav-item nav-profile">
          <a  class="nav-link">
         
            <div class="text-wrapper">
              <p class="profile-name">{{Auth::user()->name}}</p>
              
            </div>
          </a>
        </li>

        <li class="nav-item nav-category">Main Menu</li>

        <li class="nav-item">
          <a class="nav-link" href="/dashboard">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/summary">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Summary Sheets</span>
          </a>
        </li>
       
   
        
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#agt" aria-expanded="false" aria-controls="agt">
            <i class="menu-icon typcn typcn-document-add"></i>
            <span class="menu-title">Agents</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="agt">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="/all_agents"> All Agents </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/create_agent"> Add Agent </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/credit_agent"> Allocate Credit </a>
              </li>
            </ul>
          </div>
        </li>


      
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#terminal" aria-expanded="false" aria-controls="agt">
            <i class="menu-icon typcn typcn-document-add"></i>
            <span class="menu-title">Terminals</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="terminal">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="_all_terminal"> All Terminals </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="_add_terminal"> Create Terminal </a>
              </li>
            </ul>
          </div>
        </li>


        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#games" aria-expanded="false" aria-controls="games">
            <i class="menu-icon typcn typcn-document-add"></i>
            <span class="menu-title">Games</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="games">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="/all_games"> All Games </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/create_game"> Create Games </a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="/edit_game"> edit Control </a>
              </li> --}}
            </ul>
          </div>
        </li>
       

        {{-- <li class="nav-item">
          <a class="nav-link" href="/rake_pool">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Set Rake and Pool</span>
          </a>
        </li> --}}


        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="agt">
            <i class="menu-icon typcn typcn-document-add"></i>
            <span class="menu-title">Admin</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="admin">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="/all_admin"> All Admins </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/add_admin"> Add Admin </a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/logout">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Logout</span>
          </a>
        </li>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        
        <li class="nav-item" styles="">
          
          <a  class="nav-link  btn btn-danger" style="background-color: red" href="/run_draw">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Run Draw</span>
          </a>
        </li>
      <br>
        <li class="nav-item">
          <a  class="nav-link  btn btn-danger" style="background-color: green" href="/run_raffle">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Run Raffle</span>
          </a>
        </li>

      </ul>





    </nav>


    