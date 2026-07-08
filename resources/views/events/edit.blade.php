@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">
            <h4>✏️ Edit Event</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('events.update',$event->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Poster Film</label>

                    @if($event->poster)
                        <img src="{{ asset('poster/'.$event->poster) }}"
                             width="150"
                             class="d-block mb-2 rounded">
                    @endif

                    <input type="file"
                           name="poster"
                           class="form-control"
                           accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Film</label>
                    <input type="text"
                           name="movie_title"
                           class="form-control"
                           value="{{ old('movie_title',$event->movie_title) }}"
                           maxlength="255"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text"
                           name="genre"
                           class="form-control"
                           value="{{ old('genre',$event->genre) }}"
                           maxlength="100"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Durasi (Menit)</label>
                    <input type="number"
                           name="duration"
                           class="form-control"
                           value="{{ old('duration',$event->duration) }}"
                           min="1"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Rilis</label>
                    <input type="number"
                           name="release_year"
                           class="form-control"
                           value="{{ old('release_year',$event->release_year) }}"
                           min="1900"
                           max="{{ date('Y') + 5 }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Event</label>
                    <input type="text"
                           name="event_name"
                           class="form-control"
                           value="{{ old('event_name',$event->event_name) }}"
                           maxlength="255"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Event</label>
                    <input type="date"
                           name="event_date"
                           class="form-control"
                           value="{{ old('event_date',$event->event_date) }}"
                           min="{{ date('Y-m-d') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Event</label>
                    <input type="time"
                           name="event_time"
                           class="form-control"
                           value="{{ old('event_time',$event->event_time) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sinopsis Film</label>
                    <textarea name="synopsis"
                              rows="4"
                              class="form-control"
                              required>{{ old('synopsis',$event->synopsis) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Event</label>
                    <textarea name="description"
                              rows="4"
                              class="form-control"
                              required>{{ old('description',$event->description) }}</textarea>

                    <small class="text-muted">
                        Misalnya: Link Discord, aturan nobar, atau informasi tambahan lainnya.
                    </small>
                </div>

                <a href="{{ route('events.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Update Event
                </button>

            </form>

        </div>

    </div>

</div>

@endsection