<!-- resources/views/admin/videos/index.blade.php -->



<?php $__env->startSection('content'); ?>
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
                                <a href="<?php echo e(route('video.tambah')); ?>" class="btn btn-primary">Tambah Video Baru</a>
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
                                    <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td> 
                                        <td><?php echo e($video->title); ?></td>
                                        <td><?php echo e($video->description); ?></td>
                                    
                                            <td>
                                                <?php if($video->file_path): ?>
                                                <video width="320" height="240" controls>
                                                    <source src="<?php echo e(Storage::url($video->file_path)); ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                <?php else: ?>
                                                No video available
                                                <?php endif; ?>
                                            </td>
                                            
                                        
                                        <td>
                                            <a href="<?php echo e(route('video.edit', $video->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="<?php echo e(route('video.destroy', $video->id)); ?>" method="POST" style="display: inline-block;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Video\resources\views/admin/video/index.blade.php ENDPATH**/ ?>