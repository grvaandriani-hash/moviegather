<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Menampilkan semua event
    public function index(Request $request)
    {
        $search = $request->search;

        $events = Event::with('participants')
            ->when($search, function ($query) use ($search) {
                $query->where('event_name', 'like', '%' . $search . '%')
                      ->orWhere('movie_title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('events.index', compact('events'));
    }

    // Form tambah event
    public function create()
    {
        return view('events.create');
    }

    // Simpan event
    public function store(Request $request)
    {
        $request->validate([
           'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'movie_title'   => 'required|max:255',
            'genre'         => 'required|max:100',
            'duration'      => 'required|numeric|min:1',
            'release_year'  => 'required|digits:4',
            'synopsis'      => 'nullable',
            'event_name'    => 'required|max:255',
            'event_date'    => 'required|date|after_or_equal:today',
            'event_time'    => 'required',
            'description'   => 'nullable',
        ]);

        $poster = null;

        if ($request->hasFile('poster')) {
            $poster = time() . '.' . $request->poster->extension();
            $request->poster->move(public_path('poster'), $poster);
        }

        Event::create([
            'user_id'       => Auth::id(),
            'poster'        => $poster,
            'movie_title'   => $request->movie_title,
            'genre'         => $request->genre,
            'duration'      => $request->duration,
            'release_year'  => $request->release_year,
            'synopsis'      => $request->synopsis,
            'event_name'    => $request->event_name,
            'event_date'    => $request->event_date,
            'event_time'    => $request->event_time,
            'description'   => $request->description,
        ]);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    // Detail Event
    public function show(Event $event)
    {
        $event->load('participants');

        return view('events.show', compact('event'));
    }

    // Form Edit
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Update Event
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'movie_title'   => 'required|max:255',
            'genre'         => 'required|max:100',
            'duration'      => 'required|numeric|min:1',
            'release_year'  => 'required|digits:4',
            'synopsis'      => 'nullable',
            'event_name'    => 'required|max:255',
            'event_date'    => 'required|date|after_or_equal:today',
            'event_time'    => 'required',
            'description'   => 'nullable',
        ]);

        $poster = $event->poster;

        if ($request->hasFile('poster')) {

            if ($event->poster && file_exists(public_path('poster/' . $event->poster))) {
                unlink(public_path('poster/' . $event->poster));
            }

            $poster = time() . '.' . $request->poster->extension();
            $request->poster->move(public_path('poster'), $poster);
        }

        $event->update([
            'poster'        => $poster,
            'movie_title'   => $request->movie_title,
            'genre'         => $request->genre,
            'duration'      => $request->duration,
            'release_year'  => $request->release_year,
            'synopsis'      => $request->synopsis,
            'event_name'    => $request->event_name,
            'event_date'    => $request->event_date,
            'event_time'    => $request->event_time,
            'description'   => $request->description,
        ]);

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    // Hapus Event
    public function destroy(Event $event)
    {
        if ($event->poster && file_exists(public_path('poster/' . $event->poster))) {
            unlink(public_path('poster/' . $event->poster));
        }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus.');
    }

    // Gabung Event
    public function join(Event $event)
    {
        if ($event->participants()->where('user_id', Auth::id())->exists()) {
            return back()->with('success', 'Kamu sudah bergabung di event ini.');
        }

        $event->participants()->attach(Auth::id(), [
            'attendance_status' => 'Joined'
        ]);

        return back()->with('success', 'Berhasil bergabung ke event!');
    }
}