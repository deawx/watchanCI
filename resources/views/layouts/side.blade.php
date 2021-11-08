<style>
    .select2-container--default .select2-results>.select2-results__options {
        overflow-y: auto;
        max-height: 380px;
        font-size: 14px;
    }

</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
        <img src="https://office.wc-hospital.go.th/assets/img/logo.png" alt="WATCHAN eSUPPLIES" class="brand-image"
            style="opacity: .8">
        <span class="brand-text font-weight-light">WATCHAN : CI</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">สวัสดี, {{ Auth::user()->name }}</a>
                <a href="{{ route('logout') }}" class="badge badge-danger">
                    <i class="fa fa-power-off"></i> <span>{{ __('ออกจากระบบ') }}</span>
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <div class="form-inline" hidden>
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">เมนูระบบ</li>
                    <li class="nav-item">
                        <a href="/home" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
                            <i class="fas fa-th-large nav-icon"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/visit" class="nav-link {{ (request()->is('visit*')) ? 'active' : '' }}">
                            <i class="fas fa-folder-open nav-icon"></i>
                            <p>ทะเบียนผู้ป่วย</p>
                        </a>
                    </li>
                    @if (Auth::user()->permission == 'admin' || Auth::user()->permission == 'pharmar')
                    <li class="nav-item">
                        <a href="/order" class="nav-link {{ (request()->is('order*')) ? 'active' : '' }}">
                            <i class="fas fa-notes-medical nav-icon"></i>
                            <p>Order ผู้ป่วย</p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ (request()->is('report*')) ? 'active' : '' }}">
                            <i class="fas fa-print nav-icon"></i>
                            <p>รายงานข้อมูล</p>
                        </a>
                    </li>
                </li>
            </ul>
        </nav>
    </div>
</aside>
