<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users', ['users' => $users]);
    }

    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'point' => ['required', 'integer'],
            'no_absensi' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
        ])->validate();

        try {
            User::create([
                'name' => $request['name'],
                'username' => $request['username'],
                'point' => $request['point'],
                'no_absensi' => $request['no_absensi'],
                'email' => $request['username'] . "@bangrkaklofficial.com",
                'password' => Hash::make($request['password']),
            ]);

            return redirect()->back()->with('success', 'success create new user');

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    public function update(Request $request)
    {

        $user = User::find($request['id']);

        if ($request['password'] !== null) {
            Validator::make($request->all(), [
                'password' => ['string', 'confirmed'],
            ])->validate();

            $user->password = Hash::make($request['password']);
        }

        try {

            $user->name = $request['name'];
            $user->username = $request['username'];
            $user->point = $request['point'];
            $user->no_absensi = $request['no_absensi'];
            $user->save();

            return redirect()->back()->with('success', 'success create new user');

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function addPoint(Request $request)
    {

        $userIds = explode(',', $request->input('userIdSelected'));
        $users = User::whereIn('id', $userIds)->get();

        foreach ($users as $user) {
            $user->point += $request->input('point');
            $user->save();
        }

        return redirect()->back()->with('success', 'success add new point to user selected');

    }

    public function destroy(string $id)
    {

        try {
            $user = User::find($id);
            $user->delete();
            return redirect()->back()->with('success', 'success delete user with username : ' . $user->username);

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    public function search($query)
    {
        $filteredUser = User::where('username', 'LIKE', '%' . $query . '%')->where('role', '!=', 'admin')
            ->get();

        return response()->json($filteredUser, 200);
    }
}
