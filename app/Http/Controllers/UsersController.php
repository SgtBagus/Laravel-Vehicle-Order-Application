<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {
    public function index(): View {
        $params = [
            "titlePages"    => 'User List',
            "datas"         => User::latest()->paginate(5),
        ];

        return view('dashboard.users', $params);
    }
    
    public function store(Request $request) {
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'role'          => $request->role,
            'password'      => Hash::make($request->password),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back();
    }
    
    public function update(Request $request, $id) {
        $users = User::findOrFail($id);

        $users->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'role'          => $request->role,
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request) {
        User::find($request->id)->delete();
        return response()->json(array('success' => true));
    }
}
