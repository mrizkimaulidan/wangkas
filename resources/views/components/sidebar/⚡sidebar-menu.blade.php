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

      <livewire:sidebar.sidebar-item url="{{ route('dashboard.index') }}" icon="bi bi-grid-fill" title="Beranda" />

      <livewire:sidebar.sidebar-item url="{{ route('pelajar.index') }}" icon="bi bi-backpack-fill" title="Pelajar" />

      <livewire:sidebar.sidebar-item url="{{ route('kelas.index') }}" icon="bi bi-bookmarks-fill" title="Kelas" />

      <livewire:sidebar.sidebar-item url="{{ route('jurusan.index') }}" icon="bi bi-briefcase-fill" title="Jurusan" />

      <livewire:sidebar.sidebar-sub-menu icon="bi bi-cash-stack" title="Kas" :subMenuRoutes="['kas.index']">

        <livewire:sidebar.sidebar-sub-menu-item url="{{ route('kas.index') }}" title="Kas Minggu Ini" />

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
          <form method="POST" action="#">
            @csrf
            <a href="{#" class='sidebar-link' onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="bi bi-box-arrow-left"></i>
              <span>Logout</span>
            </a>
          </form>
        </li>
    </ul>
  </div>
</div>
