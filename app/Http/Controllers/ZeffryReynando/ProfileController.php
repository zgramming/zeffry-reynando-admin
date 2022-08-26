<?php

namespace App\Http\Controllers\ZeffryReynando;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $keys = [];
        return view('zeffry-reynando.profile.data', $keys);
    }
}
