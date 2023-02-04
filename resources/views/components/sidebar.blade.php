<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.departments") }}" class="nav-link {{ request()->routeIs("admin.departments*") ? "active" : "" }}">
                        <i class="nav-icon ri-folder-user-line"></i>
                        <p>Działy</p>
                    </a>
                </li>
                @role('user')
{{--                menu dla użytkownika--}}
                @endrole
                @role('admin')
                <li class="nav-item active">
                    <a href="{{ route("admin.departments") }}" class="nav-link">
                        <i class="nav-icon ri-group-line"></i>
                        <p>Użytkownicy</p>
                    </a>
                </li>
                @endrole
            </ul>
        </nav>
    </div>
</aside>
