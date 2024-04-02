@extends('layout.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Create')
{{-- Content body: main page content --}}
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Data Level</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="level_kode">Level Kode</label>
                    <input type="text" name="level_kode" class="form-control" id="level_kode"
                        placeholder="Masukan level kode">
                </div>
                <div class="form-group">
                    <label for="level_nama">Level Nama</label>
                    <input type="text" name="level_nama" class="form-control" id="level_nama"
                        placeholder="Masukan level kode">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
