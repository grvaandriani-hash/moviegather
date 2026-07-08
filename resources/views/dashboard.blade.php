@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">🎬 Dashboard MovieGather</h2>

    <div class="row">

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h5>Total Event</h5>

                    <h1 class="fw-bold text-primary">

                        {{ $totalEvent }}

                    </h1>

                </div>

            </div>

        </div>

    </div>

   <div class="card-header bg-dark text-white">

    <h5 class="mb-0">

        📅 Event Terbaru

    </h5>

</div>

        <div class="card-body">

            @forelse($recentEvents as $event)

                <div class="mb-3">

                    <h5>{{ $event->event_name }}</h5>

                    <p class="mb-1">

                        🎬 {{ $event->movie_title }}

                    </p>

                    <small>

                        📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}

                        |

                        🕒 {{ $event->event_time }}

                    </small>

                    <hr>

                </div>

            @empty

                <p>Belum ada event.</p>

            @endforelse

        </div>

    </div>

</div>

@endsection