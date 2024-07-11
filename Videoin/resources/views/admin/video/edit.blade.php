<!-- resources/views/admin/video/edit.blade.php -->

@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Video</h1>
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
                            <h3 class="card-title">Edit Data Video</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title', $video->title) }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description">{{ old('description', $video->description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Current Video</label><br>
                                    @if ($video->file_path)
                                    <video width="320" height="240" controls>
                                        <source src="{{ Storage::url($video->file_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    @else
                                    No video available<br><br>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Upload New Video (Optional)</label><br>
                                    <input type="file" name="video_file" accept="video/mp4,video/x-m4v,video/*">
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.video.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
