<?php

namespace App\Http\Controllers;

use DB;

use App\Models\VehicleList;
use App\Models\SubmissionList;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(): View {
        $charts = DB::select(
            "select date_format(created_at,'%M') as Month, COUNT(*) as count from submission_lists group by year(created_at), month(created_at) order by year(created_at), month(created_at);"
        );

        $submissionCount = SubmissionList::count();
        $vehicleCount = VehicleList::count();

        $params = [
            "titlePages"        => 'Dashboard',
            "charts"            => $charts,
            "submissionCount"   => $submissionCount,
            "vehicleCount"      => $vehicleCount,
        ];

        return view('dashboard.home', $params);
    }
}
