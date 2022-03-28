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
                          <h4>Detail Transaksi</h4>
                        </div>
                        <div class="card">

                          <table class="table">
                            <tr>
                              <th>Outlet</th>
                              <th>Nama Member</th>
                              <th>Jenis Paket</th>
                              <th>Berat</th>
                              <th>Total harga</th>
                              <th>Tanggal Transaksi</th>
                              <th>Batas Waktu</th>
                              <th>Tanggal Bayar</th>
                              <th>Status</th>
                              <th>Pembayaran</th>
                            </tr>
                            
                            
                            <tr>
                              @foreach ($outlet as $outlets)
                              <td>{{$outlets->nama}}</td>
                              @endforeach
                              @foreach ($member as $members)
                              <td>{{$members->nama_member}}</td>
                              @endforeach
                              @foreach ($paket as $pakets)
                              <td>{{$pakets->nama_paket}}</td>
                              @endforeach
                              <td>{{$transaksi->qty}} Kg</td>
                              <td>Rp. {{$detail->subtotal}}</td>
                              <td>{{$transaksi->tgl}}</td>
                              <td>{{$transaksi->batas_waktu}}</td>
                              <td>{{$transaksi->tgl_bayar}}</td>
                              <td>{{$transaksi->status}}</td>
                              <td>{{$transaksi->dibayar}}</td>
                            </tr>
                          </table>

                        </div>
                        <div class="card-footer text-left">
                          <a href="{{route('show-transaksi')}}" class="btn btn-primary">Back</a>
                          {{-- <a href="/" class="btn btn-success">Generate Laporan</a> --}}
                        </div>

                      </div>                
                  </div>
                        </form>
            </div>
         </div>

    </div>
@stop



@push('scripts')

@endpush