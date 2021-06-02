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
              <p class="mb-1 mt-3 font-weight-semibold">Allen Moreno</p>
              <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p>
            </div>
            <a class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
            <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
            <a class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
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
          <a href="#" class="nav-link">
            <div class="profile-image">
              <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="profile image">
              <div class="dot-indicator bg-success"></div>
            </div>
            <div class="text-wrapper">
              <p class="profile-name">Allen Moreno</p>
              <p class="designation">Agent</p>
            </div>
          </a>
        </li>
        <li class="nav-item nav-category">Main Menu</li>
        <li class="nav-item">
          <a class="nav-link" href="index.html">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="summary-sheets.html">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Summary Sheets</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="debt-summary.html">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Debt Summary</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="payment-history.html">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Payment History</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sub-agents.html">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Sub Agents</span>
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
                <a class="nav-link" href="all-agents.html"> All Agents </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/create_agent"> Add Agent </a>
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
                <a class="nav-link" href="all-terminals.html"> All Terminals </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="add-terminal.html"> Add Terminal </a>
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
                <a class="nav-link" href="all-games.html"> All Games </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="games-played.html"> Games Played </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="create-games.html"> Create Games </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="edit-games.html"> Edit Game Winning </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="agt">
            <i class="menu-icon typcn typcn-document-add"></i>
            <span class="menu-title">Admin</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="admin">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="all-admins.html"> All Admins </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="add-admin.html"> Add Admin </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>