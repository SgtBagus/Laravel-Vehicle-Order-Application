<?php

namespace App\Http\Controllers;

use DB;
use Auth;

use App\Models\VehicleList;
use App\Models\History;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class VehicleController extends Controller {
    public function index(): View {
        $datas =  DB::table('vehicle_lists as a')
        ->select(
            'a.id as id',
            'a.name as name',
            'a.number_vechile as number_vechile',
            'a.fuel as fuel',
            'a.status as status',
            'b.name as created_by',
            'c.name as updated_by',
            'a.created_at as created_at',
            'a.updated_at as updated_at',
        )
        ->leftjoin('users as b', 'b.id', '=', 'a.created_by')
        ->leftjoin('users as c', 'c.id', '=', 'a.updated_by')
        ->get();

        $params = [
            "titlePages"    => 'Vechicle List',
            "datas"         => $datas,
        ];

        return view('dashboard.vehicle', $params);
    }
    
    public function store(Request $request) {
        $userId = Auth::user()->id;

        VehicleList::create([
            'name'          => $request->name,
            'number_vechile'=> $request->number_vechile,
            'fuel'          => $request->fuel,
            'status'        => $request->status,
            'created_by'    => Auth::user()->id,
            'updated_by'    => Auth::user()->id,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        History::create([
            'history_log'   => "Melakukan penambahan Kendaraan",
            'user_id'       => Auth::user()->id,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back();
    }
    
    public function update(Request $request, $id) {
        $vehicleList = VehicleList::findOrFail($id);

        $vehicleList->update([
            'name'          => $request->name,
            'number_vechile'=> $request->number_vechile,
            'fuel'          => $request->fuel,
            'status'        => $request->status,
            'updated_by'    => Auth::user()->id,
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        History::create([
            'history_log'   => "Melakukan Perubahan Kendaraan",
            'user_id'       => Auth::user()->id,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request) {
        VehicleList::find($request->id)->delete();
        
        History::create([
            'history_log'   => "Melakukan Penghapusan Kendaraan",
            'user_id'       => Auth::user()->id,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return response()->json(array('success' => true));
    }
}
