<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Customers;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all(); // Ambil semua data video dari model Video
        $customers = Customers::all(); // Ambil semua data customer dari model Customer
        return view('admin.video.index', compact('videos', 'customers')); // Teruskan data ke tampilan index.blade.php
    }



    public function tambah()
    {
        return view('admin.video.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm|max:20000'
        ]);

        $filePath = null;

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $filePath = $file->store('public/videos');
        }

        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'nullable|mimes:mp4,ogx,oga,ogv,ogg,webm|max:20000',
        ]);

        $video = Video::findOrFail($id);

        if ($request->hasFile('video_file')) {
            // Hapus file lama jika ada
            if ($video->file_path) {
                Storage::delete($video->file_path);
            }
            $filePath = $request->file('video_file')->store('public/videos');
            $video->file_path = $filePath;
        }

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $video->file_path,
        ]);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        if ($video->file_path) {
            Storage::delete($video->file_path);
        }

        $video->delete();

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil dihapus.');
    }

    public function tampil()
    {
        $videos = Video::latest()->get();
        return view('index', compact('videos'));
    }

    public function show()
    {
        $videos = Video::latest()->get();
        return view('tampilan', compact('videos'));
    }

    public function requestAccess(Request $request, Video $video)
    {
        // Implementasi logika untuk permintaan akses
        // Contoh: kirim notifikasi ke admin
        // $admin = User::where('role', 'admin')->first();
        // Notification::send($admin, new AccessRequestNotification($video, auth()->user()));

        return back()->with('message', 'Permintaan akses dikirim ke admin.');
    }
}
