{{-- @extends('layout.app')

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

@section('content_body')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
@endpush

@push('js')
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@endpush --}}

@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Hallo, apakabar!!!</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            Selamat datang semua, ini adalah halaman utama dari aplikasi ini.
        </div>
    </div>
@endsection
