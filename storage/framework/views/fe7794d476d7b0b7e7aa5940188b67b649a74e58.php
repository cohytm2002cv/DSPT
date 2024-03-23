<!-- Trong view hoặc blade template -->
<?php if(auth()->guard()->check()): ?>
    <a href="<?php echo e(route('logout')); ?>">logout</a>
<?php endif; ?>

log

<?php /**PATH /Users/huytam/Documents/Laravel/blog/resources/views/dashboard/logout.blade.php ENDPATH**/ ?>