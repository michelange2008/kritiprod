<?php

namespace App\Http\Controllers;

use App\Traits\LitJson;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use LitJson;

    public function index()
    {
        return view('menus.menu-index');
    }
}
