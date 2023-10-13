<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class HistoryListController extends Controller {
    public function index() {
        $datas =  DB::table('histories as a')
        ->select(
            'a.id as id',
            'a.history_log as name',
            'b.name as name_user',
            'a.created_at as created_at',
            'a.updated_at as updated_at',
        )
        ->leftjoin('users as b', 'b.id', '=', 'a.id')
        ->get();

        $params = [
            "titlePages"    => 'History Log',
            "datas"         => $datas,
        ];

        return view('dashboard.hisotry', $params);
    }
}
