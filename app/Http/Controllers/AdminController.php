<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        $service=Service::with('departements')->get();
        return view('backend.index',['services'=>$service]);
    }
}
