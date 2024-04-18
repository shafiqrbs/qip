<nav class="navbar navbar-expand navbar-light bg-light print-header-content">
    <ul class="navbar-nav me-auto">
        <li class="nav-item active">
            <a id="sidebar-toggle" class="sidebar-toggle nav-link" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" style="font-size: 18px;">
                <?php if(Auth::user()->hasRole('ADMINISTRATOR') || Auth::user()->hasRole('ADMIN_REPORTER') || Auth::user()->hasRole('ADMIN_OPERATOR')): ?>
                    <?php echo e('Gain Bangladesh'); ?>

                <?php else: ?>
                    Organization Name: <?php echo e(Auth::user()->UserOrganization->name); ?>

                <?php endif; ?>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="#" style="font-size: 18px;">
                <i class="far fa-user"></i>
                <?php echo e(Auth::user()->name); ?>

            </a>
        </li>
    </ul>

    <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">



        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
            <li>
                <a href="<?php echo e(route('user.password.change')); ?>" class="dropdown-item">Change Password</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <?php echo e(__('Sign out')); ?>

                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH /Users/shafiq/Sites/survey/resources/views/backend/layouts/topnav.blade.php ENDPATH**/ ?>