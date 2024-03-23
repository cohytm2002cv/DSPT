
<?php if(auth()->guard()->check()): ?>
    <?php if(request()->cookie('user_data')): ?>
        <?php
            $userData = json_decode(request()->cookie('user_data'), true);
        ?>

    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /Users/huytam/Documents/Laravel/blog/resources/views/dashboard/cookie.blade.php ENDPATH**/ ?>