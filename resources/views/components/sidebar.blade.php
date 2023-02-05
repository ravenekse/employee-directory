<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <nav class="mt-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("departments") }}" class="nav-link {{ request()->routeIs("departments*") ? "active" : "" }}">
                        <i class="nav-icon ri-folder-user-line"></i>
                        <p>Działy</p>
                    </a>
                </li>
                @role('admin')
                    <li class="nav-item">
                        <a href="{{ route("employees") }}" class="nav-link {{ request()->routeIs("employees*") ? "active" : "" }}">
                            <i class="nav-icon ri-group-line"></i>
                            <p>Pracownicy</p>
                        </a>
                    </li>
                @endrole
                <li class="nav-item">
                    <a href="{{ route("account-settings") }}" class="nav-link {{ request()->routeIs("account-settings*") ? "active" : "" }}">
                        <i class="nav-icon ri-user-settings-line"></i>
                        <p>Ustawienia konta</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
