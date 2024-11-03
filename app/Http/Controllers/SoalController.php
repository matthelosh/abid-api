<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SoalController extends Controller
{
    public function store(Request $request)
    {

        try {

            if ($request->file('cover')) {
                $file = $request->file('cover');
                $store = $file->storePubliclyAs('images', Str::random(10), 'public');
                $cover = Storage::url($store);
            } else {
                $cover = $request->cover ?? null;
            }

            $materi = Soal::updateOrCreate(
                [
                    'id' => $request->id ?? null
                ],
                [
                    'materi_id' => $request->materi_id,
                    'pertanyaan' => $request->pertanyaan,
                    'a' => $request->a,
                    'b' => $request->b,
                    'c' => $request->c,
                    'd' => $request->d,
                    'kunci' => $request->kunci
                ]
            );

            return response()->json([
                'message' => 'Materi disimpan',
                'data' => $materi
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function uploadImage(Request $request)
    {
        try {
            $file = $request->file('file');
            $store = $file->storePubliclyAs('images', Str::random(10), 'public');

            return Storage::url($store);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
