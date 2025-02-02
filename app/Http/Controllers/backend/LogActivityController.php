<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function LogActivity(){
        return view('backend.LogActivity.log-activity');
    }
}
