   <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background: #0c0d50;">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                 
                  <div class="dot-indicator bg-info"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{Auth::user()->name}}</p>
                  <p class="designation">N{{DB::table('agent_credits')->where('agent_id',Auth::user()->id)->value('cash_remitted') ?? 0}}</p>
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
              <a class="nav-link" data-toggle="collapse" href="#terminal" aria-expanded="false" aria-controls="agt">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Terminals</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="terminal">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="/_all_terminal"> All Terminals </a>
                  </li>
                 
                  <li class="nav-item">
                    <a class="nav-link" href="/_credit"> Allocate credit </a>
                  </li>
                </ul>
              </div>
              
              <li class="nav-item">
                <a class="nav-link" href="/_payout">
                  <i class="menu-icon typcn typcn-document-text"></i>
                  <span class="menu-title">Reconcile Dept</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/logout">
                  <i class="menu-icon typcn typcn-document-text"></i>
                  <span class="menu-title">logout</span>
                </a>
              </li>
            </li>
          </ul>
        </nav>