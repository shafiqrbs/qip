<nav class="navbar navbar-expand navbar-light bg-light print-header-content">
    <ul class="navbar-nav me-auto">
        <li class="nav-item active">
            <a id="sidebar-toggle" class="sidebar-toggle nav-link" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" style="font-size: 18px;">
                @if(Auth::user()->hasRole('ADMINISTRATOR') || Auth::user()->hasRole('ADMIN_REPORTER') || Auth::user()->hasRole('ADMIN_OPERATOR'))
                    {{'Gain Bangladesh'}}
                @else
                    Organization Name: {{Auth::user()->UserOrganization->name}}
                @endif
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="#" style="font-size: 18px;">
                <i class="far fa-user"></i>
                {{Auth::user()->name}}
            </a>
        </li>
    </ul>

    <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
{{--            <h3>{{Auth::user()->name}}</h3>--}}
{{--            <li><a class="dropdown-item" href="#">{{Auth::user()->name}}</a></li>--}}
{{--            <img src="{{ asset('backend/image/UserImage/'.Auth::user()->user_image) }}" alt="mdo" class="rounded-circle" width="32" height="32">--}}
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
            <li>
                <a href="{{route('user.password.change')}}" class="dropdown-item">Change Password</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Sign out') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
