<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class FrontEndController extends Controller
{
    //
    public function index() {
		return view('welcome');
    }
}
