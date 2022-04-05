@extends('layouts.master')
@section('links') 
<li class="menu-header">Dashboard</li>
<li ><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
@role('admin|kasir')
<li class="active"><a class="nav-link" href="{{route ('show-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
@endrole
@role('admin')
<li ><a class="nav-link" href="{{route ('show-outlet')}}"><i class="fas fa-home"></i> <span>Outlet Laundry</span></a></li>
<li ><a class="nav-link" href="{{route ('show-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endrole
@role('admin|kasir|owner')
<li ><a class="nav-link" href="{{ route('show-transaksi') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
@endrole
@role('admin')
<li ><a class="nav-link" href="{{ route ('show-user') }}"><i class="fas fa-users-cog"></i></i> <span>User Manajemen</span></a></li>
@endrole
@role('owner|admin|kasir')
<li ><a class="nav-link" href="{{route('show-laporan')}}"><i class="fas fa-clipboard-list"></i></i> <span>Laporan Excel</span></a></li>
@endrole
@endsection
@section('konten')
<div class="section-header">
    <h1>Data Member</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="{{route ('show-member')}}">Member</a></div>
      <div class="breadcrumb-item">Data Member</div>
    </div>
  </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <a href="{{route('add-member')}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Data</a>
                <hr>
                {{-- message simpan data --}}
                @if (session('message-simpan'))
                <div class="alert alert-success alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    {{(session('message-simpan'))}}
                  </div>
                </div>
                @endif
                {{-- message update data --}}
                @if (session('message-update'))
                <div class="alert alert-info alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    {{(session('message-update'))}}
                  </div>
                </div>
                @endif
                {{-- message hapus data --}}
                @if (session('message-hapus'))
                <div class="alert alert-warning alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    {{(session('message-hapus'))}}
                  </div>
                </div>
                @endif
                <table class="table table-striped table-bordered">
                  <tr>
                    <th>No</th>
                    <th>Nama Member</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomor Telpon</th>
                    <th>Aksi</th>
                  </tr>
                  
                  @foreach ($member as $no => $data)
                  <tr>
                    <td>{{$member->firstItem()+$no}}</td>
                    <td>{{$data->nama_member}}</td>
                    <td>{{$data->alamat}}</td>
                    <td>{{$data->jenis_kelamin}}</td>
                    <td>{{$data->telp}}</td>

                    <td>
                      <form action="{{route('delete-member',$data->id)}}" id="hapus{{$data->id}}"method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{route('edit-member', Crypt::encryptString($data->id))}}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                        <button class="btn btn-icon btn-danger hapus"><i class="fas fa-times"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach

                </table>
                {{$member->links()}}
            </div>
</div>
@endsection