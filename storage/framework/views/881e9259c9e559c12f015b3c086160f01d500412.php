<?php if($message = Session::get('message')): ?>
    <div class="alert alert-primary" role="alert">
        <strong><?php echo e($message); ?></strong>
    </div>
<?php endif; ?>

<?php if($validate = Session::get('validate')): ?>
    <div class="alert alert-warning" role="alert">
        <strong><?php echo e($validate); ?></strong>
    </div>
<?php endif; ?>

<?php if($delete = Session::get('delete')): ?>
    <div class="alert alert-danger" role="alert">
        <strong><?php echo e($delete); ?></strong>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/survey/resources/views/backend/layouts/message.blade.php ENDPATH**/ ?>