<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index'); // nanti arahkan ke view role/index.blade.php
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        // logika simpan data ke database
    }
}
