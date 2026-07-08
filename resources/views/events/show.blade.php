@extends('layouts.app')

@section('content')

<div class="container">

    <a href="{{ route('events.index') }}" class="btn btn-secondary mb-3">
        ← Kembali
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">

        <div class="row g-0">

            <div class="col-md-4">

                @if($event->poster)

                    <img src="{{ asset('poster/'.$event->poster) }}"
                        class="img-fluid rounded-start"
                        style="height:100%; object-fit:cover;">

                @else

                    <img src="https://via.placeholder.com/400x550?text=No+Poster"
                        class="img-fluid rounded-start">

                @endif

            </div>

            <div class="col-md-8">

                <div class="card-body">

                    <h2 class="fw-bold">
                        {{ $event->event_name }}
                    </h2>

                    <hr>

                    <p><strong>🎬 Judul Film :</strong> {{ $event->movie_title }}</p>

                    <p><strong>🎭 Genre :</strong> {{ $event->genre }}</p>

                    <p><strong>⏱ Durasi :</strong> {{ $event->duration }} Menit</p>

                    <p><strong>📅 Tahun Rilis :</strong> {{ $event->release_year }}</p>

                    <p>
                        <strong>🗓 Tanggal Event :</strong>
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                    </p>

                    <p>
                        <strong>🕒 Jam :</strong>
                        {{ $event->event_time }}
                    </p>

                    <p>
                        <strong>👥 Jumlah Peserta :</strong>
                        {{ $event->participants->count() }} Orang
                    </p>

                    <hr>

                    <h5>📖 Sinopsis</h5>

                    <p>
                        {{ $event->synopsis ?: '-' }}
                    </p>

                    <div class="mb-3">
    <h4>📝 Deskripsi Event</h4>

    <div style="white-space: pre-line;">
        {!! preg_replace(
            '/(https?:\/\/[^\s]+)/',
            '<a href="$1" target="_blank" rel="noopener noreferrer" class="text-info">$1</a>',
            e($event->description)
        ) !!}
    </div>
</div>

                    <hr>

                    <h5>👥 Daftar Peserta</h5>

                    @if($event->participants->count())

                        <ul class="list-group mb-3">

                            @foreach($event->participants as $participant)

                                <li class="list-group-item">
                                    👤 {{ $participant->name }}
                                </li>

                            @endforeach

                        </ul>

                    @else

                        <div class="alert alert-warning">
                            Belum ada peserta yang bergabung.
                        </div>

                    @endif


                    @if($event->participants->contains(Auth::id()))

                        <button class="btn btn-success" disabled>
                            ✅ Kamu Sudah Bergabung
                        </button>

                    @else

                        <form action="{{ route('events.join',$event->id) }}" method="POST">

                            @csrf

                            <button class="btn btn-primary">
                                🙋 Gabung Event
                            </button>

                        </form>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection