<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view('client.index');
    }

    public function about(){
        return view('client.about');
    }

    public function contact(){
        return view('client.contact');
    }

    public function pricing(){
        return view('client.pricing');
    }

    public function service(){
        return view('client.service');
    }

}
