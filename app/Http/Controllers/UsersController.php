<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\View\View;


use Illuminate\Http\Request;

class UsersController extends Controller {
    public function index(): View {
        $params = [
            "titlePages"    => 'User List',
            "datas"         => User::latest()->paginate(5),
        ];

        return view('dashboard.users', $params);
    }
    
    public function update(Request $request, $id) {
        $users = User::findOrFail($id);

        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request) {
        User::find($request->id)->delete();
        return response()->json(array('success' => true));
    }
}
