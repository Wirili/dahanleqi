<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('default.index');
    }

    public function quality()
    {
        return view('default.index_quality');
    }
}
