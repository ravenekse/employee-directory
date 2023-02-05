@php
    $user = auth()->user();

    $avatar = $user->image_url ?: asset("assets/images/default_avatar.jpg")
@endphp

<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="ri-menu-2-line"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="user-panel d-flex align-items-center" data-toggle="dropdown" href="#">
                <div class="image">
                    <img class="rounded-circle" src="{{ $avatar }}" alt="{{ "{$user->firstname} {$user->surname}" }}">
                </div>
                <div class="info">
                    <div class="d-flex text-white align-items-center">
                        {{ "{$user->firstname} {$user->surname}" }}
                        <i class="ri-arrow-down-s-line ml-1"></i>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <div class="user-panel d-flex align-items-center mb-3">
                    <div class="image">
                        <img class="rounded-circle" src="{{ $avatar }}" alt="{{ "{$user->firstname} {$user->surname}" }}">
                    </div>
                    <div class="info">
                        <div class="d-block">{{ "{$user->firstname} {$user->surname}" }}</div>
                        <div class="small">
                            @if($user->hasRole("user"))
                                Użytkownik
                            @elseif($user->hasRole("admin"))
                                Administrator
                            @endif
                        </div>
                    </div>
                </div>
                <a href="{{ route("account-settings") }}" class="dropdown-item">
                    <i class="ri-user-settings-line mr-2"></i>
                    Ustawienia konta
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route("auth.logout") }}" class="dropdown-item">
                    <i class="ri-logout-circle-line mr-2"></i>
                    Wyloguj się
                </a>
            </div>
        </li>
    </ul>
</nav>
