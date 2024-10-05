<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use Illuminate\Http\Request;

class BabController extends Controller
{
    public function index(Request $request)
    {
        $kelas = $request->query('kelas');
        return Bab::whereTingkat($kelas)->get();
    }
}
