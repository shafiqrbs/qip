<!doctype html>
<html lang="<?php echo e(session()->get('locale')); ?>">
<head>

    <!-- meta item -->
    <?php echo $__env->make('backend.layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Favicons -->
    <?php echo $__env->make('backend.layouts.headimage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Bootstrap core CSS -->
    <?php echo $__env->make('backend.layouts.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('CustomStyle'); ?>
</head>
<body id="<?php echo e(session()->get('locale')); ?>" class="app is-collapsed">



<div class="sidebar">
    <div class="sidebar-inner">
        <!-- logo part -->
       <?php echo $__env->make('backend.layouts.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- menu part -->
        <?php echo $__env->make('backend.layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>

<div class="container-wide">
    <!-- top nav part -->
    <?php echo $__env->make('backend.layouts.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- body part -->
    <?php echo $__env->yieldContent('body'); ?>

    <!-- footer part -->
    <?php echo $__env->make('backend.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- js part -->
    <?php echo $__env->make('backend.layouts.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('PerPageCustomJs'); ?>

</div>
</body>
</html>
<?php /**PATH /var/www/html/survey/resources/views/backend/layouts/master.blade.php ENDPATH**/ ?>