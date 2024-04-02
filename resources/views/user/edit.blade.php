@extends('user/template')
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit User</h2>
            </div>
            <div class="float-right">
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Input gagal <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.update') }}" method="post">
        @csrf
        @method('PUT')
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User_id:</strong>
                <input type="text" name="userid" class="form-control" placeholder="Masukan user id"
                    value="{{ $user->user_id }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Level_id:</strong>
                <input type="text" name="levelid" class="form-control" placeholder="Masukan level">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Username:</strong>
                <input type="text" name="username" class="form-control" placeholder="Masukan username"
                    value="{{ $user->username }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>nama:</strong>
                <input type="text" name="nama" class="form-control" placeholder="Masukan nama"
                    value="{{ $user->nama }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>password:</strong>
                <input type="password" name="password" class="form-control" placeholder="Masukan password"
                    value="{{ $user->password }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
