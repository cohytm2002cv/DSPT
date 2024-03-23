
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Blog Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/blog/">


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/blog.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/dist/css/bootstrap.min.css')); ?>">
    <style>
        .news-content {
            white-space: pre-line;
        }
    </style>
    <style>
        .news-content {
            white-space: pre-line;
        }

        /* Basic styling for comments */
        .comment {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .comment h3 {
            margin-top: 0;
        }

        .comment p {
            margin-bottom: 0;
        }

        /* Style for comment form */
        #commentForm {
            margin-bottom: 20px;
        }

        #commentForm input,
        #commentForm textarea {
            width: 100%;
            margin-bottom: 10px;
        }

        #commentForm button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        #commentForm button:hover {
            background-color: #0056b3;
        }
    </style>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->

</head>
<body>
<?php if(auth()->guard()->check()): ?>
    <?php if(request()->cookie('user_data')): ?>
        <?php
            $userData = json_decode(request()->cookie('user_data'), true);
        ?>

    <?php endif; ?>
<?php endif; ?>
<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="link-secondary" href="#">Subscribe</a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="<?php echo e(url('/news/')); ?>}">Báo Nhà Làm</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="link-secondary" href="#" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img"
                         viewBox="0 0 24 24"><title>Search</title>
                        <circle cx="10.5" cy="10.5" r="7.5"/>
                        <path d="M21 21l-5.2-5.2"/>
                    </svg>
                </a>
                <a class="btn btn-sm btn-outline-secondary" href="<?php echo e(url('dashboard')); ?>">
                    <?php if(request()->cookie('user_data')): ?>
                        <?php
                            $userData = json_decode(request()->cookie('user_data'), true);
                        ?>

                        <p>Xin Chào, <?php echo e($userData['user_name']); ?>!</p>
                    <?php else: ?>
                        Sign Up
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </header>


</div>

<main class="container">
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark ">
        <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic">Cuộc Sống Hôm Nay</h1>
            <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and
                efficiently about what’s most interesting in this post’s contents.</p>
            <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
        </div>
    </div>


    <div class="row g-5">
        <h1><?php echo e($new->title); ?></h1>
        <p>Author: <?php echo e($new->author); ?></p>
        <div class="news-content"><?php echo e($new->content); ?></div>
        <div>
            <img width="700px" height="auto" src="<?php echo e(asset( $new->image_path)); ?>" alt="ảnh">
        </div>

        <form id="commentForm" action="<?php echo e(route('comments.store')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="news_id" value="<?php echo e($new->id); ?>"> <!-- Trường ẩn lưu trữ id của tin tức -->
            <input type="text" id="name" name="name" placeholder="Your Name" required>
            <textarea id="content" name="cmt" placeholder="Write your comment..." required></textarea>
            <button type="submit">Submit Comment</button>
        </form>
        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                tên: <?php echo e($comment->name); ?> <br>
                nội dung: <?php echo e($comment->cmt); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <!-- Container to display existing comments -->
        <div id="commentsContainer">
            <!-- Comments will be displayed here -->
        </div>

        <script src="script.js"></script>


    </div>

</main>

<footer class="blog-footer">
    <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.
    </p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>

<script>
    $(document).ready(function () {
        $('#commentForm').submit(function (event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    console.log(response.message);
                    // Thêm code để hiển thị thông báo hoặc làm gì đó sau khi comment được gửi thành công
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
</body>
</html>
<?php /**PATH /Users/huytam/Documents/Laravel/blog/resources/views/news/news.blade.php ENDPATH**/ ?>