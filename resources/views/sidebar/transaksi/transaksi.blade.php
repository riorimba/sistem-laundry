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
<div class="section-header">
    <h1>Transaksi Laundry</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
      <div class="breadcrumb-item">Form</div>
    </div>
  </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                @role('admin|kasir')
                <form action="{{ route('delete-all') }}" method="POST">
                  <a href="{{route ('add-transaksi')}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Data</a>
                  @csrf
                  @method('delete')
                  <button type="submit"  class="btn btn-danger"><i class="fa fa-trash"></i>  Hapus Semua Transaksi</button>
                </form>
                @endrole
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
                    <th>Outlet</th>
                    <th>Nama Member</th>
                    <th>Tanggal Transaksi</th>
                    <th>Aksi</th>
                  </tr>
                  
                  @foreach ($transaksi as $no => $data)
                  
                  <tr>
                    <td>{{$transaksi->firstItem()+$no}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->nama_member}}</td>
                    <td>{{$data->tgl}}</td>
                    
                    <td>
                      <form action="{{route('delete-transaksi',$data->id_transaksi)}}" id="hapus{{$data->id}}"method="POST">
                        @csrf
                        @method('delete')
                          <a href=" {{route('show-detail',$data->id_transaksi)}}" class="btn btn-icon btn-success" ><i class="fas fa-eye"></i><a>
                          @role('admin|kasir')
                          <a href="{{route('edit-transaksi',$data->id_transaksi)}}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                          <button class="btn btn-icon btn-danger hapus"><i class="fas fa-times"></i></button>
                        </form>
                        @endrole
                    </td>
                  </tr>
                  @endforeach

                </table>
                {{$transaksi->links()}}
            </div>
         </div>

    </div>
@stop

@push('scripts')
<script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@push('after-scripts')
<script>
$(".hapus").click(function(hapus) {
  id = hapus.target.dataset.id;
  swal({
      title: 'Hapus data?',
      text: 'Data yang dihapus tidak bisa dikembalikan!',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
      // swal('Poof! Your imaginary file has been deleted!', {
      //   icon: 'success',
      // });
      $(`#hapus${id}`).submit();
      } else {
      // swal('Your imaginary file is safe!');
      }
    });
});
</script>
@endpush