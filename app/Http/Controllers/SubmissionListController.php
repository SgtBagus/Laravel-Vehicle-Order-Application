<?php

namespace App\Http\Controllers;

use DB;
use Auth;

use App\Models\SubmissionList;
use App\Models\History;
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class SubmissionListController extends Controller {
    public function index(): View {
        $datas =  DB::table('submission_lists as a')
        ->select(
            'a.id as id',
            'a.submission_name as name',
            'a.reason as reason',
            'b.name as name_vechile',
            'b.number_vechile as number_vechile',
            'b.fuel as fuel_vechile',
            'a.status as status',
            'a.note as note',
            'a.start_date as start_date',
            'a.end_date as end_date',
            'c.name as approve_by',
            'a.created_at as created_at',
            'a.updated_at as updated_at',
        )
        ->leftjoin('vehicle_lists as b', 'b.id', '=', 'a.vehicle_id')
        ->leftjoin('users as c', 'c.id', '=', 'a.approve_by')
        ->get();

        $params = [
            "titlePages"    => 'Submission List',
            "datas"         => $datas,
        ];

        return view('dashboard.submissionList', $params);
    }
    
    public function update(Request $request, $id) {
        $submissionList = SubmissionList::findOrFail($id);

        $submissionList->update([
            'note'          => $request->note,
            'status'        => $request->status,
            'approve_by'    => Auth::user()->id,
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        History::create([
            'history_log'   => "Melakukan Perubahan Status pada Submission",
            'user_id'       => Auth::user()->id,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request) {
        SubmissionList::find($request->id)->delete();
        
        History::create([
            'history_log'   => "Melakukan Penghapusan pada Submission",
            'user_id'       => Auth::user()->id,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return response()->json(array('success' => true));
    }
}
