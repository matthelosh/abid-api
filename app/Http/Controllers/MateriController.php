<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {

        try {

            if ($request->file('fileCover')) {
                $file = $request->file('fileCover');
                $store = $file->storePubliclyAs('images', Str::random(10), 'public');
                $cover = env('APP_URL') . Storage::url($store);
            } else {
                $cover = $request->cover ?? null;
            }

            $materi = Materi::updateOrCreate(
                [
                    'id' => $request->id ?? null
                ],
                [
                    'bab_id'  => $request->bab_id,
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'content' => $request->content,
                    'cover' => $cover,
                    // 'user_id' => $request->user()->id
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

            return env('APP_URL') . Storage::url($store);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
