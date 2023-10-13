<a href="index3.html" class="brand-link">
    <img src="{{ asset('/') }}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
</a>

<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                @if (Auth::user()->role == 'admin')
                    <a href={{ url('/admin') }} class="nav-link">
                @else
                    <a href={{ url('/approval') }} class="nav-link">
                @endif
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                @if (Auth::user()->role == 'admin')
                    <a href={{ url('/admin/submission-list') }} class="nav-link">
                @else
                    <a href={{ url('/approval/submission-list-approval') }} class="nav-link">
                @endif
                    <i class="fas fa-table nav-icon"></i>
                    <p>Tabel Pengajuan</p>
                </a>
            </li>
            @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a href={{ url('/admin/vehicle') }} class="nav-link">
                        <i class="fas fa-car nav-icon"></i>
                        <p>List Kendaraan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ url('/admin/users') }} class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
            @else
            @endif
            <li class="nav-item">
                <a href={{ url('/history') }} class="nav-link">
                    <i class="fas fa-history nav-icon"></i>
                    <p>Riwayat Kegiatan</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
