<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventSubmission;
use App\Models\User;
use Illuminate\Http\Request;

class EventSubmissionController extends Controller
{
    public function index()
    {
        $submissions = EventSubmission::with(['event', 'user'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.event-submissions.index', ['submissions' => $submissions]);
    }

    public function approve(EventSubmission $submission)
    {
        $submission->update([
            'status' => 'approved',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        $user = User::find($submission->user_id);
        $user->point += $submission->event->point_reward;
        $user->save();

        return redirect()->back()->with('success', 'Submission disetujui. Poin telah ditambahkan ke member.');
    }

    public function reject(Request $request, EventSubmission $submission)
    {
        $submission->update([
            'status' => 'rejected',
            'admin_notes' => $request->input('admin_notes'),
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Submission ditolak.');
    }
}
