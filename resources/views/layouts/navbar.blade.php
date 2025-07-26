<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light"><b>SMPN 1 KREJENGAN</b> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/photo/' . Auth::user()->photo) }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::user()->username }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Beranda</p>
                    </a>
                </li>

                <!-- Walikelas Management Links -->
                @if (Auth::user()->role_user == 'admin')
                    <li
                        class="nav-item {{ request()->routeIs('siswa.index') || request()->routeIs('walikelas.index') || request()->routeIs('kelas.index') || request()->routeIs('jenis_pelanggaran.index') || request()->routeIs('kelas.siswa') || request()->routeIs('kesiswaan.index') || request()->routeIs('tahunajaran.index') ? 'menu-open' : '' }}"">
                        <a href="#"
                            class="nav-link {{ request()->routeIs('walikelas.index') || request()->routeIs('kelas.index') || request()->routeIs('jenis_pelanggaran.index') || request()->routeIs('siswa.index') || request()->routeIs('kelas.siswa') || request()->routeIs('kesiswaan.index') || request()->routeIs('tahunajaran.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('tahunajaran.index') }}"
                                    class="nav-link {{ request()->routeIs('tahunajaran.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>Tahun Ajaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('kelas.index') }}"
                                    class="nav-link {{ request()->routeIs('kelas.index') || request()->routeIs('kelas.siswa') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-school"></i>
                                    <p>Kelas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('walikelas.index') }}"
                                    class="nav-link {{ request()->routeIs('walikelas.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Wali Kelas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('siswa.index') }}"
                                    class="nav-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>Siswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jenis_pelanggaran.index') }}"
                                    class="nav-link {{ request()->routeIs('jenis_pelanggaran.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                                    <p>Jenis Pelanggaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('kesiswaan.index') }}"
                                    class="nav-link {{ request()->routeIs('kesiswaan.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Kesiswaan</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#"
                            class="nav-link {{ request()->routeIs('kasus_pelanggaran.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>
                                Pengolahan Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('kasus_pelanggaran.index') }}"
                                    class="nav-link {{ request()->routeIs('kasus_pelanggaran.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-exclamation-circle"></i>
                                    <p>Pelanggaran</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#"
                            class="nav-link {{ request()->routeIs('laporankasus_pelanggaran.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Laporan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('laporankasus_pelanggaran.index') }}"
                                    class="nav-link {{ request()->routeIs('laporankasus_pelanggaran.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>Laporan Pelanggaran</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role_user == 'user')
                    <li class="nav-item">

                        <a href="#"
                            class="nav-link {{ request()->routeIs('siswa.index') || request()->routeIs('walikelas.index') || request()->routeIs('kelas.index') || request()->routeIs('jenis_pelanggaran.index') || request()->routeIs('kelas.siswa') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('siswa.index') }}"
                                    class="nav-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>Siswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('kelas.index') }}"
                                    class="nav-link {{ request()->routeIs('kelas.index') || request()->routeIs('kelas.siswa') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-school"></i>
                                    <p>Kelas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jenis_pelanggaran.index') }}"
                                    class="nav-link {{ request()->routeIs('jenis_pelanggaran.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                                    <p>Jenis Pelanggaran</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#"
                            class="nav-link {{ request()->routeIs('kasus_pelanggaran.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>
                                Pengolahan Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('kasus_pelanggaran.index') }}"
                                    class="nav-link {{ request()->routeIs('kasus_pelanggaran.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-exclamation-circle"></i>
                                    <p>Pelanggaran</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#"
                            class="nav-link {{ request()->routeIs('laporankasus_pelanggaran.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Laporan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('laporankasus_pelanggaran.index') }}"
                                    class="nav-link {{ request()->routeIs('laporankasus_pelanggaran.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>Laporan Pelanggaran</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <!-- Logout Link -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" id="logout-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
<script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault();
        var confirmation = confirm('Apakah anda yakin ingin keluar?');
        if (confirmation) {
            document.getElementById('logout-form').submit();
        }
    });
</script>
