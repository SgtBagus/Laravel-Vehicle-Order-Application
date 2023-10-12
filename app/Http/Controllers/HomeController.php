<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    
    public function index() {
        $params = [
            "titlePages"    =>  'Home'
        ];

        return view('index', $params);
    }
}
