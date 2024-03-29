<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $today = now()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)
                                 ->whereDate('created_at', $today)
                                 ->first();

        if (!$attendance) {
            $attendance = new Attendance();
            $user = User::find($user->id);

            $attendance->user_id = $user->id;
            $attendance->save();

            $consecutiveAttendance = Attendance::where('user_id', $user->id)
                                               ->whereDate('created_at', '>=', now()->subDays(4))
                                               ->count();

            if ($consecutiveAttendance % 5 == 0) {
                $user->point += 3;

            } else {
                $user->point += 1;
            }

            $user->save();

            return redirect()->route('user.profile')->with(['success' => 'Attendance recorded successfully', 'points' => $user->point]);

        }

        return redirect()->route('user.profile')->with(['error' => 'User already attended today', 'points' => $user->point]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
