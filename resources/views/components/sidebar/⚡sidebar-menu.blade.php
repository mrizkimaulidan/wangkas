<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
  <div class="sidebar-menu">
    <ul class="menu">
      <li class="sidebar-title">Menu</li>

      <livewire:sidebar.sidebar-item url="{{ route('dashboard.index') }}" :active="request()->routeIs('dashboard.*')"
        icon="bi bi-grid-fill" title="Beranda" />

      <livewire:sidebar.sidebar-item url="{{ route('pelajar.index') }}" :active="request()->routeIs('pelajar.*')"
        icon="bi bi-backpack-fill" title="Pelajar" />

      <livewire:sidebar.sidebar-item url="{{ route('kelas.index') }}" :active="request()->routeIs('kelas.*')"
        icon="bi bi-bookmarks-fill" title="Kelas" />

      <livewire:sidebar.sidebar-item url="{{ route('jurusan.index') }}" :active="request()->routeIs('jurusan.*')"
        icon="bi bi-briefcase-fill" title="Jurusan" />

      <livewire:sidebar.sidebar-sub-menu icon="bi bi-cash-stack" title="Kas" :active="request()->routeIs('kas.*')">

        <livewire:sidebar.sidebar-sub-menu-item url="{{ route('kas.index') }}" :active="request()->routeIs('kas.index')"
          title="Kas Minggu Ini" />

        {{--
        <livewire:sidebar.sidebar-sub-menu-item url="{{ route('kas.riwayat') }}" title="Riwayat Kas" /> --}}

        {{--
        <livewire:sidebar.sidebar-sub-menu-item url="{{ route('kas.laporan') }}" title="Laporan Kas" /> --}}

        </livewire:sidebar.sidebar-submenu>

        <livewire:sidebar.sidebar-item url="{{ route('pengguna.index') }}" icon="bi bi-person-badge-fill"
          title="Pengguna" />

        <livewire:sidebar.sidebar-item url="{{ route('profil.edit') }}" icon="bi bi-person-fill-gear"
          title="Pengaturan Profil" />

        <li class="sidebar-item">
          @livewire('pages::auth.logout')
        </li>
    </ul>
  </div>
</div>
