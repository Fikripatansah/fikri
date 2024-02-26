<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request){
        // Validasi data request
        $request->validate([
            'gallery_id' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,heic|max:2048',
            'title' => 'required'
        ]);

        // Ambil file yang di upload
        $file = $request->file('file');

        // Nama file
        $fileName = time() . '.' . $file->extension();

        // Pindahkan file ke folder public/images
        $file->move(public_path('images'), $fileName);

        // Simpan data ke database
        Image::create([
            'gallery_id' => $request->gallery_id,
            'file' => $fileName,
            'title' => $request->title,
        ]);

        // redirect ke halaman sebelumnya
        return back()->with('success', 'Foto berhasil ditambahkan');
    }

    public function destroy($id)
    {
        // Ambil data image berdasarkan id
        $image = Image::find($id);

        // Hapus file dari folder public/images
        unlink(public_path('images/' . $image->file));

        // Hapus data dari database
        $image->delete();

        // Redirect ke halaman sebelumnya
        return back()->with('success', 'Foto Berhasil Dihapus');
    }
}
