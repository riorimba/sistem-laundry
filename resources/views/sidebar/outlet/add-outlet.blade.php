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
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Tambah Data Outlet</h4>
                    </div>
                    <form action="{{route ('save-outlet')}}" method="POST">
                      @csrf
                    <div class="card-body">
                      
                      <div class="form-group">
                        <label>Nama Outlet :</label>
                        <input type="text" name="nama" value="{{old('nama')}}" class="form-control">
                        <label 
                        @error('nama') 
                        class="text-danger"
                        @enderror>
                        @error('nama')
                        {{$message}}
                        @enderror
                      </label>
                      </div>
                      
                      <div class="form-group">
                        <label>Alamat Outlet :</label>
                        <textarea name="alamat" value="{{old('alamat')}}" class="form-control" ></textarea>
                        <label 
                        @error('alamat') 
                        class="text-danger"
                        @enderror>
                        @error('alamat')
                        {{$message}}
                        @enderror
                      </label>
                      </div>

                      <div class="form-group">
                        <label>Nomor Telpon :</label>
                        <input type="number" name="telp" value="{{old('telp')}}" class="form-control">
                        <label 
                        @error('telp') 
                        class="text-danger"
                        @enderror>
                        @error('telp')
                        {{$message}}
                        @enderror
                      </label>
                      </div>
                      
                      <button class="btn btn-primary" type="submit">Tambah</button>
                      <button class="btn btn-secondary" type="reset">Reset</button>
                    
                    </form>
              </div>
        </div>
     </div>
</div>
@endsection