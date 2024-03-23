<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <a href="<?php echo e(route('show', $new->id)); ?>"> <h2><?php echo e($new->title); ?></h2></a>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
trang chu

</body>
</html>
<?php /**PATH /Users/huytam/Documents/Laravel/blog/resources/views/news/index.blade.php ENDPATH**/ ?>