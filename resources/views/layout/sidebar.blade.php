<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            @if (isset(auth()->user()->img) && auth()->user()->img !== "")
              <img class="" src="{{ url('pro_pic/'. auth()->user()->img) }}" onerror="this.onerror=null;this.src='assets/images/faces/face8.jpg';" alt="Profile image">
            @else
              <img class="" src="{{ url('assets/images/faces/face8.jpg') }}" alt="Profile image">
            @endif
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{ auth()->user()->name }}</p>
            <div class="dropdown" data-display="static">
              <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <small class="designation text-muted">Manager</small>
                <span class="status-indicator online"></span>
              </a>
              {{-- <div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                <a class="dropdown-item p-0">
                  <div class="d-flex border-bottom">
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                      <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item mt-2"> Manage Accounts </a>
                <a class="dropdown-item"> Change Password </a>
                <a class="dropdown-item"> Check Inbox </a>
                <a class="dropdown-item"> Sign Out </a>
              </div> --}}
            </div>
          </div>
        </div>
        <button class="btn btn-success btn-block">New Project <i class="mdi mdi-plus"></i>
        </button>
      </div>
    </li>
    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('/home') }}">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{ request()->is('inventory*') ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#inventory" aria-expanded="{{ request()->is('users*') ? 'true' : 'false' }}" aria-controls="inventory">
        <i class="menu-icon mdi mdi-poll-box"></i>
        <span class="menu-title">Inventory</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ request()->is('inventory*') ? 'show' : '' }}" id="inventory">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ request()->is('inventory/brands*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('inventory/brands') }}"><i class="submenu-icon mdi mdi-copyright"></i> Brands</a>
          </li>
          <li class="nav-item {{ request()->is('inventory/categories*') ? 'active' : '' }}">
          <li class="nav-item {{ request()->is('inventory/categories*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('inventory/categories') }}"><i class="submenu-icon mdi mdi-file-tree"></i> Categories</a>
          </li>
          <li class="nav-item {{ request()->is('inventory/products*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('inventory/products') }}"><i class="submenu-icon mdi mdi-store"></i> Products</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ request()->is('accounts*') ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#accounts" aria-expanded="{{ request()->is('users*') ? 'true' : 'false' }}" aria-controls="accounts">
        <i class="menu-icon mdi mdi-account-card-details"></i>
        <span class="menu-title">Accounts</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ request()->is('accounts*') ? 'show' : '' }}" id="accounts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ request()->is('accounts/users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('accounts/users') }}"><i class="submenu-icon mdi mdi-account-multiple"></i> Purchase</a>
          </li>
          <li class="nav-item {{ request()->is('accounts/role*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('accounts/role') }}"><i class="submenu-icon mdi mdi-file-tree"></i> Bulk Purchase</a>
          </li>
          <li class="nav-item {{ request()->is('accounts/typography') }}">
            <a class="nav-link" href="{{ url('/accounts/typography') }}"> </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ request()->is('settings*') ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="{{ request()->is('users*') ? 'true' : 'false' }}" aria-controls="settings">
        <i class="menu-icon mdi mdi-settings"></i>
        <span class="menu-title">Settings</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ request()->is('settings*') ? 'show' : '' }}" id="settings">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ request()->is('settings/users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('settings/users') }}"><i class="submenu-icon mdi mdi-account-multiple"></i> All Users</a>
          </li>
          <li class="nav-item {{ request()->is('settings/role*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('settings/role') }}"><i class="submenu-icon mdi mdi-file-tree"></i> Role Management</a>
          </li>
          <li class="nav-item {{ request()->is('settings/typography') }}">
            <a class="nav-link" href="{{ url('/settings/typography') }}">Typography</a>
          </li>
        </ul>
      </div>
    </li>
  </ul>
</nav>