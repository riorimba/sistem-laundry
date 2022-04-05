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
<li class="active"><a class="nav-link" href="{{ route('show-transaksi') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
@endrole
@role('admin')
<li ><a class="nav-link" href="{{ route ('show-user') }}"><i class="fas fa-users-cog"></i></i> <span>User Manajemen</span></a></li>
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
                          <h4>Tambah Data Transaksi</h4>
                        </div>
                        <form action="{{route ('save-transaksi')}}" method="POST">
                          @csrf
                        <div class="card-body">
                          
                            <div class="row">
                              <div class="col-md-4">
                          <div class="form-group">
                            <label>Pilih Outlet :</label>
                            <br>
                            <select class="form-control col-md-6" name="id_outlet">
                            <option value="" selected>--Pilih--</option>  
                            @foreach ($outlet as $data)
                            <option value="{{$data->id}}">{{$data->nama}}</option>            
                            @endforeach
                            </select>  
                            <label 
                            @error('id_outlet') 
                            class="text-danger"
                            @enderror>
                            @error('id_outlet')
                            {{$message}}
                            @enderror
                          </label>
                        </div>
                      </div>
                        
                      <div class="col-md-4">
                          <div class="form-group">
                            <label>Pilih Member :</label>
                            <br>
                            <select class="form-control col-md-6" name="id_member">
                            <option value="" selected>--Pilih--</option>  
                            @foreach ($member as $data_member)
                            <option value="{{$data_member->id}}">{{$data_member->nama_member}}</option>            
                            @endforeach
                            </select>  
                            <label 
                            @error('id_member') 
                            class="text-danger"
                            @enderror>
                            @error('id_member')
                            {{$message}}
                            @enderror
                          </label>
                        </div>
                      </div>
                        
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Pilih Paket :</label>
                          <br>
                          <select class="form-control col-md-6" name="id_paket">
                          <option value="" selected>--Pilih--</option>  
                          @foreach ($paket as $data_paket)
                          <option value="{{$data_paket->id}}">{{$data_paket->nama_paket}}</option>            
                          @endforeach
                          </select>  
                          <label 
                          @error('id_paket') 
                          class="text-danger"
                          @enderror>
                          @error('id_paket')
                          {{$message}}
                          @enderror
                        </label>
                      </div>
                    </div>
                  </div>

                      <div class="form-group">
                        <label>Berat : (Kg)</label>
                        <input type="number" min="1" class="form-control col-md-2" name="qty">
                        <label 
                        @error('qty') 
                        class="text-danger"
                        @enderror>
                        @error('qty')
                        {{$message}}
                        @enderror
                      </label>
                      </div>

                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                            <label>Tanggal Transaksi :</label>
                            <input type="date" value="{{old('tgl')}}" class="form-control col-md-6" name="tgl">
                            <label 
                            @error('tgl') 
                            class="text-danger"
                            @enderror>
                            @error('tgl')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label>Batas Waktu :</label>
                            <input type="date" value="{{old('batas_waktu')}}" class="form-control col-md-6" name="batas_waktu">
                            <label 
                            @error('batas_waktu') 
                            class="text-danger"
                            @enderror>
                            @error('batas_waktu')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>
                          
                          <div class="col-md-4">
                          <div class="form-group">
                            <label>Tanggal Bayar :</label>
                            <input type="date" value="{{old('tgl_bayar')}}"class="form-control col-md-6" name="tgl_bayar">
                            <label 
                            @error('tgl_bayar') 
                            class="text-danger"
                            @enderror>
                            @error('tgl_bayar')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>
                        </div>

                          <div class="form-group">
                            <label>Status :</label>
                            <br>
                            <input class="form-control col-md-2" value="proses" disabled>
                            <input name="status" value="proses" hidden>
                            {{-- <select class="form-control col-md-2" name="status">
                            <option value="" selected dis>--Pilih--</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                            <option value="diambil">Diambil</option>
                            </select>  --}}
                            <label 
                            @error('status') 
                            class="text-danger"
                            @enderror>
                            @error('status')
                            {{$message}}
                            @enderror
                          </label>
                          </div>

                          <div class="form-group">
                            <label>Status Bayar :</label>
                            <br>
                            <select class="form-control col-md-2" name="dibayar">
                            <option value="" selected>--Pilih--</option>
                            <option value="dibayar">Dibayar</option>
                            <option value="belum_dibayar">Belum dibayar</option>
                            </select> 
                            <label 
                            @error('dibayar') 
                            class="text-danger"
                            @enderror>
                            @error('dibayar')
                            {{$message}}
                            @enderror
                          </label>
                          </div>

                          <button class="btn btn-primary" type="submit">Tambah</button>
                          <button class="btn btn-secondary" type="reset">Reset</button>
                        
                  </div>
                        </form>
            </div>
         </div>

    </div>
@stop



@push('scripts')

@endpush