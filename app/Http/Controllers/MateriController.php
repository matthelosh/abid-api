<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        try {
            $babId = $request->bab;
            return Materi::whereBabId($babId)->with('soals')->get();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
