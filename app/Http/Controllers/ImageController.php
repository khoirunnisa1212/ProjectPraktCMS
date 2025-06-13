<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function create()
    {
        return view('obat.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $image = Image::create([
            'title' => $request->title,
            'image_path' => $imagePath,
        ]);

        return view('upload', ['image' => $image])->with('success', 'Gambar berhasil diupload.');
    }
}