@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold text-danger">🎬 MovieGather Event</h2>

        <a href="{{ route('events.create') }}" class="btn btn-danger">
            + Tambah Event
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    {{-- Search --}}
    <form method="GET" action="{{ route('events.index') }}" class="mb-4">

        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari Event..."
                value="{{ request('search') }}">

            <button class="btn btn-danger">
                🔍 Cari
            </button>

        </div>

    </form>

    <div class="row">

        @forelse($events as $event)

        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card h-100">

                {{-- Poster --}}
                @if($event->poster)

                    <img src="{{ asset('poster/'.$event->poster) }}"
                        class="card-img-top"
                        style="height:450px; object-fit:cover;">

                @else

                    <img src="https://via.placeholder.com/400x550?text=No+Poster"
                        class="card-img-top"
                        style="height:450px; object-fit:cover;">

                @endif

                <div class="card-body">

                    <h4 class="fw-bold">
                        {{ $event->event_name }}
                    </h4>

                    <hr class="border-danger">

                    <p class="mb-2">
                        🎬 <strong>{{ $event->movie_title }}</strong>
                    </p>

                    <p class="mb-2">
                        📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                    </p>

                    <p class="mb-0">
                        👥 <strong>{{ $event->participants->count() }}</strong> Peserta
                    </p>

                </div>

                <div class="card-footer border-0">

                    <a href="{{ route('events.show',$event->id) }}"
                        class="btn btn-danger btn-sm">
                        Detail
                    </a>

                    <a href="{{ route('events.edit',$event->id) }}"
                        class="btn btn-outline-light btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('events.destroy',$event->id) }}"
                        method="POST"
                        class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus event ini?')">
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-dark text-center">
                Belum ada event.
            </div>

        </div>

        @endforelse

    </div>

</div>

@endsection