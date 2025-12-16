<!--begin::Sidebar-->
@php $role = session('user_role', null); @endphp
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    @if($role == 1)
      <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Panel</span>
      </a>
    @elseif($role == 2)
      <a href="{{ route('dokter.dashboard') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Dokter</span>
      </a>
    @elseif($role == 3)
      <a href="{{ route('perawat.dashboard') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Perawat</span>
      </a>
    @elseif($role == 4)
      <a href="{{ route('resepsionis.dashboard') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Resepsionis</span>
      </a>
    @elseif($role == 5)
      <a href="{{ route('pemilik.dashboard') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP Pemilik</span>
      </a>
    @else
      <a href="{{ route('home') }}" class="brand-link">
        <img src="https://arsip.unair.ac.id/wp-content/uploads/2019/01/logo-unair.png" alt="Logo" class="brand-image opacity-75 shadow" />
        <span class="brand-text fw-light">RSHP</span>
      </a>
    @endif
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">

        @if($role == 1)
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Master Data -->
        <li class="nav-item has-treeview {{ request()->routeIs('admin.kategori.*','admin.kategori-klinis.*','admin.jenis-hewan.*','admin.ras-hewan.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->routeIs('admin.kategori.*','admin.kategori-klinis.*','admin.jenis-hewan.*','admin.ras-hewan.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-box-seam"></i>
            <p>
              Master Data
              <i class="right bi bi-chevron-down"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Data User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.role.index') }}" class="nav-link {{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Role</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.jenis-hewan.index') }}" class="nav-link {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Jenis Hewan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.ras-hewan.index') }}" class="nav-link {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Ras Hewan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.pemilik.index') }}" class="nav-link {{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Data Pemilik</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.datadokter.index') }}" class="nav-link {{ request()->routeIs('admin.datadokter.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Data Dokter</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.dataperawat.index') }}" class="nav-link {{ request()->routeIs('admin.dataperawat.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Data Perawat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.pet.index') }}" class="nav-link {{ request()->routeIs('admin.pet.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Data Pet</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Kategori</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.kategori-klinis.index') }}" class="nav-link {{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Kategori Klinis</p>
              </a>
            </li>
          </ul>
        </li>


        <!-- Transaksional -->
        <li class="nav-item has-treeview {{ request()->routeIs('admin.kode-tindakan-terapi.*','admin.rekam-medis.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->routeIs('admin.kode-tindakan-terapi.*','admin.rekam-medis.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-hospital"></i>
            <p>
              Transaksional
              <i class="right bi bi-chevron-down"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.temu-dokter.index') }}" class="nav-link {{ request()->routeIs('admin.temu-dokter.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Temu Dokter</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.rekam-medis.index') }}" class="nav-link {{ request()->routeIs('admin.rekam-medis.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Rekam Medis</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="nav-link {{ request()->routeIs('admin.kode-tindakan-terapi.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-dot"></i>
                <p>Data Tindakan</p>
              </a>
            </li>
          </ul>
        </li>
        @endif

        @if($role == 2)
        <li class="nav-item">
          <a href="{{ route('dokter.dashboard') }}" class="nav-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dokter.rekam-medis.index') }}" class="nav-link {{ request()->routeIs('dokter.rekam-medis.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-file-medical"></i>
            <p>Rekam Medis</p>
          </a>
        </li>
        @endif

        @if($role == 3)
        <li class="nav-item">
          <a href="{{ route('perawat.dashboard') }}" class="nav-link {{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('perawat.rekam-medis.index') }}" class="nav-link {{ request()->routeIs('perawat.rekam-medis.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-file-medical"></i>
            <p>Rekam Medis</p>
          </a>
        </li>
        @endif

        @if($role == 4)
        <li class="nav-item">
          <a href="{{ route('resepsionis.dashboard') }}" class="nav-link {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('resepsionis.datapemilik.index') }}" class="nav-link {{ request()->routeIs('resepsionis.datapemilik.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-people-fill"></i>
            <p>Data Pemilik</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('resepsionis.datapet.index') }}" class="nav-link {{ request()->routeIs('resepsionis.datapet.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-paw"></i>
            <p>Data Pet</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('resepsionis.temu-dokter.index') }}" class="nav-link {{ request()->routeIs('resepsionis.temu-dokter.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-calendar-check"></i>
            <p>Temu Dokter</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('resepsionis.rekam-medis.index') }}" class="nav-link {{ request()->routeIs('resepsionis.rekam-medis.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-file-medical"></i>
            <p>Rekam Medis</p>
          </a>
        </li>
        @endif

        @if($role == 5)
        <li class="nav-item">
          <a href="{{ route('pemilik.dashboard') }}" class="nav-link {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pemilik.pet.index') }}" class="nav-link {{ request()->routeIs('pemilik.pet.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-heart"></i>
            <p>My Pets</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pemilik.rekam-medis.index') }}" class="nav-link {{ request()->routeIs('pemilik.rekam-medis.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-file-medical"></i>
            <p>Rekam Medis</p>
          </a>
        </li>
        @endif

        @if(!in_array($role, [1,2,3,4,5]))
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon bi bi-house"></i>
              <p>Home</p>
            </a>
          </li>
        @endif

      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
