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
                      <h4>Edit Data User</h4>
                    </div>
                    <form action="{{route ('update-user', Auth::user()->id)}}" method="POST">
                      @csrf
                      @method('put')
                    <div class="card-body">
                      
                      <div class="form-group">
                        <label for="name" class="form-label">Name :</label>
                        <input value="{{ $user->name }}" 
                          type="text" 
                          class="form-control" 
                          name="name"
                          placeholder="Name" required>

                        @if ($errors->has('name'))
                          <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                      </div>
                      
                      <div class="form-group">
                        <label for="email" class="form-label">Email :</label>
                        <input value="{{ $user->email }}"
                          type="email" 
                          class="form-control" 
                          name="email" 
                          placeholder="Email address" required>
                        @if ($errors->has('email'))
                          <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                        @endif
                      </label>
                      </div>

                      {{-- <div class="form-group">
                        <label>Role</label>
                        <input type="text" class="form-control" name="role"
                        @if (old('role'))
                        value="{{old('role')}}" 
                        @else
                        value="{{$user->getRoleNames()}}" 
                        @endif
                        disabled>
                      </div> --}}

                      <div class="form-group">
                        <label for="role" class="form-label">Role :</label>
                        <select class="form-control" 
                          name="role" required>
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ in_array($role->name, $userRole) 
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
                        @endforeach
                        </select>
                        @if ($errors->has('role'))
                          <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                        @endif
                      </div>
                      
                      <div class="form-group">
                        <label for="password" class="form-label">Password :</label>
                        <input value="{{ $user->password }}"
                          type="password" 
                          class="form-control" 
                          name="password" 
                          placeholder="Password" required>
                        @if ($errors->has('password'))
                          <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                        @endif
                      </label>
                      </div>

                      <button class="btn btn-primary" type="submit">Simpan</button>
                      <button class="btn btn-secondary" type="reset">Reset</button>
                    
                    </form>
              </div>
        </div>
     </div>

</div>
@endsection
