<!-- resources/views/admin/videos/index.blade.php -->

@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Video</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <a href="{{ route('video.tambah') }}" class="btn btn-primary">Tambah Video Baru</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Video</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($videos as $index => $video)
                                    <tr>
                                        <td>{{ $index + 1 }}</td> 
                                        <td>{{ $video->title }}</td>
                                        <td>{{ $video->description }}</td>
                                    
                                            <td>
                                                @if ($video->file_path)
                                                <video width="320" height="240" controls>
                                                    <source src="{{ Storage::url($video->file_path) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                @else
                                                No video available
                                                @endif
                                            </td>
                                            
                                        
                                        <td>
                                            <a href="{{ route('video.edit', $video->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('video.destroy', $video->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
