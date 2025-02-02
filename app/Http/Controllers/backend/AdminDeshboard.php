<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDeshboard extends Controller
{
    public function deshboard(){
        return view('backend.master');
    }
}
