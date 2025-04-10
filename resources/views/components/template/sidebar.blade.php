<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable ps-theme-dark">
            <br>
            <li class="font-weight-bold ml-3">Menu</li>
            <!-- <li class=" ml-3">Menu</li> -->
            <li class="nav-item {{request()->is('admin/dashboard') ? 'active' : ''}}">
                <a href=" {{ url('admin/dashboard') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-schedule"></i>
                    </span>
                    <span class="title">Event</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{request()->is('admin/event') ? 'active' : ''}} ">
                        <a href="{{ url('admin/event') }}"><i class="anticon anticon-schedule"></i> Manajemen Event</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{request()->is('admin/registration') ? 'active' : ''}} ">
                        <a href="{{ url('admin/registration') }}"><i class="anticon anticon-reconciliation"></i> Registrasi Event</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{request()->is('admin/check-in') ? 'active' : ''}} ">
                        <a href="{{ url('admin/check-in') }}"><i class="anticon anticon-scan"></i> Check In Event</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{request()->is('admin/manage-idcard') ? 'active' : ''}}">
                        <a href="{{ url('admin/manage-idcard') }}"><i class="anticon anticon-idcard"></i> Kelola ID Card</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title">Setting</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{request()->is('admin/logo-idcard') ? 'active' : ''}} ">
                        <a href="{{ url('admin/logo-idcard') }}"><i class="anticon anticon-rocket"></i> Logo ID Card</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{request()->is('admin/pengumuman') ? 'active' : ''}} ">
                        <a href="{{ url('admin/pengumuman') }}"><i class="anticon anticon-bell"></i> Pengumuman</a>
                    </li>
                </ul>
            </li>
            <hr>
            <li class="nav-item {{request()->is('logout') ? 'active' : ''}}">
                <a href=" {{ url('logout') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-logout"></i>
                    </span>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>