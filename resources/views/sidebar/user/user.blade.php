@extends('layouts.master')
@section('links') 
<li class="menu-header">Dashboard</li>
<li ><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
@role('admin|kasir')
<li ><a class="nav-link" href="{{route ('show-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
@endrole
@role('admin')
<li ><a class="nav-link" href="{{route ('show-outlet')}}"><i class="fas fa-home"></i> <span>Outlet Laundry</span></a></li>
<li ><a class="nav-link" href="{{route ('show-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endrole
@role('admin|kasir|owner')
<li ><a class="nav-link" href="{{ route('show-transaksi') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
@endrole
@role('admin')
<li class="active"><a class="nav-link" href="{{ route ('show-user') }}"><i class="fas fa-users-cog"></i></i> <span>User Manajemen</span></a></li>
@endrole
@role('owner|admin|kasir')
<li ><a class="nav-link" href="{{route('show-laporan')}}"><i class="fas fa-clipboard-list"></i></i> <span>Laporan Excel</span></a></li>
@endrole
@endsection
@section('konten')
<div class="section-header">
    <h1>Data User</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="{{route ('show-user')}}">User</a></div>
      <div class="breadcrumb-item">Data User</div>
    </div>
  </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <a href="{{route('add-user')}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Data</a>
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                  </tr>
                  
                  @foreach ($data_user as $no => $data)
                  <tr>
                    <td>{{($data_user->currentpage()-1)*$data_user->perpage()+$no+1}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>
                      @if(!empty($data->getRoleNames()))
                        @foreach($data->getRoleNames() as $v)
                          <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                      @endif
                    </td>
                    
                    <td>
                      <form action="{{route('delete-user',$data->id)}}" id="hapus{{$data->id}}"method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{route('edit-user',$data->id)}}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                        <button class="btn btn-icon btn-danger hapus"><i class="fas fa-times"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </table>
                {{$data_user->links()}}
            </div>
         </div>

    </div>
@endsection
