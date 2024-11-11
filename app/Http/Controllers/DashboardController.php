<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function home(Request $request)
    {
        $kelas = [];
        for ($i = 1; $i <= 6; $i++) {
            \array_push($kelas, [
                'tingkat' => $i,
                'label' => 'Kelas ' . $i,
                'babs' => Bab::where('tingkat', $i)->with('materis.soals')->get()
            ]);
        }

        return Inertia::render(


            'Dashboard',
            [
                'kelas' => $kelas
            ]
        );
    }
}
