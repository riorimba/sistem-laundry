@extends('layouts.master')
@section('konten')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Outlet</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>  
                    @endif

                    kau berada di Outlet!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
