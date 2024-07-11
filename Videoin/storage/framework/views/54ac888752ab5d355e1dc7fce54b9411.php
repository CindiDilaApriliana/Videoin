<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Shop in style with this shop homepage template featuring videos." />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
    <style>
        .header-right {
            position: absolute;
            top: 10px;
            right: 20px;
        }
        @keyframes move {
            0% { transform: rotate(10deg) translateY(0); }
            50% { transform: rotate(10deg) translateY(-10px); }
            100% { transform: rotate(10deg) translateY(0); }
        }
        .text-curve {
            display: inline-block;
            font-family: Arial, sans-serif;
            font-size: 40px;
            font-weight: bolder;
            animation: move 2s infinite;
        }
        .text-curve span {
            display: inline-block;
            transform: rotate(-10deg);
        }
        .notification {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <!-- Header-->
    <header class="bg-dark py-5 position-relative">
       <div class="text-center text-white">
           <div class="text-curve">
               <img src="/img/logo.png" alt="Logo" class="d-inline-block align-text-top" style="width: 100px;">
           </div>
    <h1 class="display-4 fw-bolder">
        <span class="text-curve">V</span>
        <span class="text-curve">I</span>
<span class="text-curve">D</span>
<span class="text-curve">E</span>
<span class="text-curve">O</span>
<span class="text-curve">I</span>
<span class="text-curve">N</span>
    </h1>
    <p class="lead fw-normal text-white-50 mb-0">Temukan Video Favorit Anda di Sini!</p>
</div>

        </div>
        <div class="header-right">
            <a class="btn btn-outline-light" href="login">Login</a>
        </div>
    </header>
    
    <!-- Section-->
    <section class="py-5">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Search videos..." aria-label="Search videos" aria-describedby="button-search">
            <button class="btn btn-outline-dark" type="button" id="button-search">Search</button>
        </div>
        <div class="container px-4 px-lg-5 mt-5">
            <!-- Search form -->
            
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="videoList">
                <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col mb-5 video-item"> <!-- Add 'video-item' class here -->
                    <div class="notification" id="notification-<?php echo e($video->id); ?>">
                        Jika anda ingin melihat video ini harus meminta akses terlebih dahulu.
                        Klik request agar dapat melihat video ini
                    </div>
                    <div class="card h-80"> <!-- Change 'h-200' to 'h-100' for better display -->
                        <div class="card-body">
                            <?php if($video->file_path): ?>
                            <video width="100%" height="80%" class="restricted-video" data-video-id="<?php echo e($video->id); ?>"> <!-- Use 'width="100%"' for responsive width -->
                                <source src="<?php echo e(Storage::url($video->file_path)); ?>">
                                    Your browser does not support the video tag.
                                </video>
                                <?php else: ?>
                                No video available
                                <?php endif; ?>
                            </div>
                            
                            <!-- Video details -->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-start">
                                <!-- Title -->
                                <h5 class="fw-bolder">Title: <?php echo e($video->title); ?></h5>
                                <!-- Description -->
                                <p>Description: <?php echo e($video->description); ?></p>
                                <!-- Upload date -->
                                <p>Uploaded: <?php echo e($video->created_at->format('F j, Y')); ?></p>
                                <!-- Product actions-->
                                <a class="btn btn-outline-dark mt-auto" href="login">Request</a>
                            </div>
                            
                        </div>
                        <!-- Notification -->
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">WEBSITE VIDEO 2024</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script>
        document.getElementById('button-search').addEventListener('click', function() {
            var input = document.getElementById('searchInput').value.toLowerCase();
            var videos = document.getElementsByClassName('video-item');
            
            Array.from(videos).forEach(function(video) {
                var title = video.querySelector('.fw-bolder').innerText.toLowerCase();
                var description = video.querySelector('p:nth-of-type(2)').innerText.toLowerCase();

                if (title.includes(input) || description.includes(input)) {
                    video.style.display = 'block';
                } else {
                    video.style.display = 'none';
                }
            });
        });

        // Reset search when input is cleared
        document.getElementById('searchInput').addEventListener('input', function() {
            var input = document.getElementById('searchInput').value.trim().toLowerCase();
            var videos = document.getElementsByClassName('video-item');
            
            if (input === '') {
                Array.from(videos).forEach(function(video) {
                    video.style.display = 'block';
                });
            }
        });

        // Handle click on video
        var restrictedVideos = document.querySelectorAll('.restricted-video');

        restrictedVideos.forEach(function(video) {
            video.addEventListener('click', function(event) {
                event.preventDefault();
                var videoId = video.getAttribute('data-video-id');
                var notification = document.getElementById('notification-' + videoId);
                notification.style.display = 'block';
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 4000);
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Video\resources\views/index.blade.php ENDPATH**/ ?>