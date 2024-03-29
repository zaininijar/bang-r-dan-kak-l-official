<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $user = Auth::user();

        $today_attendance = Attendance::where('user_id', $user->id)
        ->whereDate('created_at', $today)
        ->first() ? 'Sudah' : 'Belum';

        return view('user.profile', ['today_attendance' => $today_attendance]);
    }
}
