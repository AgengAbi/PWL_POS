{{-- @extends('layout.app')
@section('subtitle', 'User')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'User')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex align-items-center">
                <p class="d-inline m-0">Manage Users</p>
                <a href={{ route('kategori.create') }} class="btn btn-success ml-auto">Add Data</a>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush --}}

{{--  --}}

{{-- @extends('user/template')
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>CRUD user</h2>
            </div>
            <div class="float-right">
                <a href="{{ route('user.create') }}" class="btn btn-success">Input User</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th width="20px" class="text-center">User_id</th>
            <th width="150px" class="text-center">Level_id</th>
            <th width="200px" class="text-center">Username</th>
            <th width="200px" class="text-center">nama</th>
            <th width="150px" class="text-center">password</th>
        </tr>
        @foreach ($m_user as $user)
            <tr>
                <td>{{ $user->user_id }}</td>
                <td>{{ $user->level_id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->password }}</td>
                <td class="text-center d-flex">
                    <form action="{{ route('user.destroy', $user->user_id) }}" method="post">
                        <a href="{{ route('user.show', $user->user_id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('user.show', $user->user_id) }}" class="btn btn-primary btn-sm">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda ingin menghapus data ini?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection --}}

@extends('user/template')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="m-0">CRUD User</h2>
                        <a href="{{ route('user.create') }}" class="btn btn-success">Input User</a>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success mt-3 mb-0">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">Level ID</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Password</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($m_user as $user)
                                    <tr>
                                        <td>{{ $user->user_id }}</td>
                                        <td>{{ $user->level_id }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->password }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('user.destroy', $user->user_id) }}" method="post">
                                                <a href="{{ route('user.show', $user->user_id) }}"
                                                    class="btn btn-info btn-sm">Show</a>
                                                <a href="{{ route('user.edit', $user->user_id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card-header {
            background-color: #007bff;
            color: #fff;
        }

        .card-body {
            background-color: #f8f9fa;
        }

        .btn {
            margin-right: 5px;
        }

        .alert {
            margin-top: 10px;
        }
    </style>
@endpush
