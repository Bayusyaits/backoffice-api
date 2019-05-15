<?php

namespace App\Http\Controllers\Exceptions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExceptionsController extends Controller
{
    //
    public function index() {
    	throw new \App\Exceptions\CustomException('Something Went Wrong.');
    }
}
