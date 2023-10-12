<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(): View {
        $params = [
            "titlePages"    =>  ''
        ];

        return view('dashboard.adminHome', $params);
    }

    public function approvalHome(): View {
        $params = [
            "titlePages"    =>  ''
        ];
        return view('dashboard.approvalHome', $params);
    }
}
