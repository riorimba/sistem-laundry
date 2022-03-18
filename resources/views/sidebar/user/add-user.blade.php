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
                      <h4>Tambah User</h4>
                    </div>
                    <form action="{{route ('save-user')}}" method="POST">
                      @csrf
                    <div class="card-body">
                      
                      <div class="form-group">
                        <label>Nama User :</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control">
                        <label 
                        @error('name') 
                        class="text-danger"
                        @enderror>
                        @error('name')
                        {{$message}}
                        @enderror
                      </label>
                      </div>
                      
                      <div class="form-group">
                        <label>Email :</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" >
                        <label 
                        @error('email') 
                        class="text-danger"
                        @enderror>
                        @error('email')
                        {{$message}}
                        @enderror
                      </label>
                      </div>

                      <div class="form-group">
                        <label>Password :</label>
                        <input type="password" name="password" value="{{old('password')}}" class="form-control" >
                        <label 
                        @error('password') 
                        class="text-danger"
                        @enderror>
                        @error('password')
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
