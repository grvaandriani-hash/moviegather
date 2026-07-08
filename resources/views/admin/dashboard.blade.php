@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">👑 Dashboard Admin</h2>

    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Total User</h5>
                    <h1 class="text-danger fw-bold">
                        {{ $totalUser }}
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Total Admin</h5>
                    <h1 class="text-danger fw-bold">
                        {{ $totalAdmin }}
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Total Event</h5>
                    <h1 class="text-danger fw-bold">
                        {{ $totalEvent }}
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Total Peserta</h5>
                    <h1 class="text-danger fw-bold">
                        {{ $totalParticipant }}
                    </h1>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow">

        <div class="card-header">
            <h5 class="mb-0">👥 Daftar User</h5>
        </div>

        <div class="card-body">

            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama atau email..."
                        value="{{ request('search') }}">

                    <button class="btn btn-danger">
                        🔍 Cari
                    </button>
                </div>
            </form>

            <table class="table table-hover align-middle">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th width="280">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($users as $user)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>

                           @if($user->id == 1)

    <span class="badge bg-warning text-dark">
        👑 Admin Utama
    </span>

@elseif($user->role == 'admin')

    <span class="badge bg-danger">
        Admin
    </span>

@else

    <span class="badge bg-secondary">
        User
    </span>

@endif

                        </td>

                        <td>

                            @if($user->status == 'active')

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-dark">
                                    Banned
                                </span>

                            @endif

                        </td>

                        <td>

                           @if($user->id == 1)

    <span class="badge bg-warning text-dark">
        🔒 Tidak dapat diubah
    </span>

@elseif($user->id != auth()->id())

                                <form action="{{ route('admin.changeRole', $user->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('PATCH')

                                    <button class="btn btn-warning btn-sm">

                                        {{ $user->role == 'admin' ? 'Jadikan User' : 'Jadikan Admin' }}

                                    </button>

                                </form>

                                <form action="{{ route('admin.toggleBan', $user->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        class="btn btn-sm {{ $user->status == 'active' ? 'btn-danger' : 'btn-success' }}">

                                        {{ $user->status == 'active' ? 'Ban' : 'Unban' }}

                                    </button>

                                </form>

                            @else

                                <span class="text-secondary">

                                    Akun Anda

                                </span>

                            @endif

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection