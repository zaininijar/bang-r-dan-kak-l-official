<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_active', true)
            ->where('end_at', '>=', now())
            ->where('start_at', '<=', now())
            ->orderBy('end_at', 'ASC')
            ->get();

        $userSubmissions = EventSubmission::where('user_id', Auth::id())
            ->whereIn('event_id', $events->pluck('id'))
            ->orderBy('created_at', 'DESC')
            ->get()
            ->keyBy('event_id');

        return view('user.events.index', [
            'events' => $events,
            'userSubmissions' => $userSubmissions,
        ]);
    }

    public function storeSubmission(Request $request)
    {
        $validated = $request->validate([
            'event_id' => ['required', 'exists:events,id'],
            'screenshot' => ['required', 'image', 'max:5120'],
        ]);

        $event = Event::findOrFail($validated['event_id']);

        if (!$event->isActive()) {
            return redirect()->back()->with('error', 'Event sudah tidak aktif.');
        }

        $existing = EventSubmission::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah mengirimkan screenshot untuk event ini. Menunggu persetujuan admin.');
        }

        $approved = EventSubmission::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->where('status', 'approved')
            ->first();

        if ($approved) {
            return redirect()->back()->with('error', 'Anda sudah menyelesaikan event ini.');
        }

        $path = $request->file('screenshot')->store('event-submissions', 'public');

        EventSubmission::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'screenshot_path' => $path,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Screenshot berhasil dikirim. Menunggu persetujuan admin.');
    }

    public function submissionHistory()
    {
        $submissions = EventSubmission::with('event')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('user.events.history', ['submissions' => $submissions]);
    }
}
