<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagosController extends Controller
{
    public function index()
    {
        return view('pagos.index');
    }
}
