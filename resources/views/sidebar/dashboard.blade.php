@extends('layouts.master')
@section('links') 
<li class="menu-header">Dashboard</li>
<li class="active"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
@role('admin|kasir')
<li ><a class="nav-link" href="{{route ('show-member')}}"><i class="fas fa-user"></i> <span>Register Member</span></a></li>
@endrole
@role('admin')
<li ><a class="nav-link" href="{{route ('show-outlet')}}"><i class="fas fa-home"></i> <span>Outlet Laundry</span></a></li>
<li ><a class="nav-link" href="{{route ('show-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endrole
@role('admin|kasir|owner')
<li ><a class="nav-link" href="{{ route('show-transaksi') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
@endrole
@role('admin')
<li ><a class="nav-link" href="{{ route ('show-user') }}"><i class="fas fa-users-cog"></i></i> <span>User</span></a></li>
@endrole
@role('owner|admin|kasir')
<li ><a class="nav-link" href="{{route('show-laporan')}}"><i class="fas fa-clipboard-list"></i></i> <span>Laporan Excel</span></a></li>
@endrole
@endsection
@section('konten')
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-home"></i>
          </div>
          <div class="card-wrap"><a href="{{ route('show-outlet') }}">
            <div class="card-header">
              <h4>Total Outlet</h4>
            </div>
            <div class="card-body">
              {{ $outlet->count() }}
            </div>
          </a>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Member</h4>
            </div>
            <div class="card-body">
              {{ $member->count() }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-box"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Paket</h4>
            </div>
            <div class="card-body">
              {{ $paket->count() }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-file-invoice-dollar"></i>
          </div>
          <div class="card-wrap ">
            <div class="card-header">
              <h4>Proses Pesanan</h4>
            </div>
            <div class="card-body">
              {{ $transaksi->count() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop
