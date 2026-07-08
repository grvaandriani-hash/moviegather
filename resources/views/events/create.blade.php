@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">
            <h4>🎉 Tambah Event</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Poster Film</label>
                    <input type="file" name="poster" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Film</label>
                    <input type="text"
                           name="movie_title"
                           class="form-control"
                           value="{{ old('movie_title') }}"
                           maxlength="255"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text"
                           name="genre"
                           class="form-control"
                           value="{{ old('genre') }}"
                           maxlength="100"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Durasi (Menit)</label>
                    <input type="number"
                           name="duration"
                           class="form-control"
                           value="{{ old('duration') }}"
                           min="1"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Rilis</label>
                    <input type="number"
                           name="release_year"
                           class="form-control"
                           value="{{ old('release_year') }}"
                           min="1900"
                           max="{{ date('Y') + 5 }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Event</label>
                    <input type="text"
                           name="event_name"
                           class="form-control"
                           value="{{ old('event_name') }}"
                           maxlength="255"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Event</label>
                    <input type="date"
                           name="event_date"
                           class="form-control"
                           value="{{ old('event_date') }}"
                           min="{{ date('Y-m-d') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Event</label>
                    <input type="time"
                           name="event_time"
                           class="form-control"
                           value="{{ old('event_time') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sinopsis Film</label>
                    <textarea name="synopsis"
                              rows="4"
                              class="form-control"
                              required>{{ old('synopsis') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Event</label>
                    <textarea name="description"
                              rows="4"
                              class="form-control"
                              required>{{ old('description') }}</textarea>

                    <small class="text-muted">
                        Misalnya: Link Discord, aturan nobar, atau informasi tambahan lainnya.
                    </small>
                </div>

                <a href="{{ route('events.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Simpan Event
                </button>

            </form>

        </div>

    </div>

</div>

@endsection