<style>
    body {
        top: 0px !important;
    }
</style>
<header class="main-header hide">
    <!-- Logo -->
    <!-- mini logo for sidebar mini 50x50 pixels -->

    <!-- logo for regular state and mobile devices -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <span id="show_date_time" class="show_date_time" style="color:#303841; font-size:16px; line-height: 46px;"></span>
        <div class="navbar-custom-menu">


            <?php
                if (LOGIN_USER_TYPE == 'company') {
                    $user = Auth::guard('company')->user();
                    $company_user = true;
                } else {
                    $user = Auth::guard('admin')->user();
                    $company_user = false;
                }
            ?>
            <ul class="nav navbar-nav">



                <input type="hidden" id="current_time" value="<?php echo e(date('F d, Y H:i:s', time())); ?>">


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <?php if (isset($component)) { $__componentOriginal606b6d7eddc2e418f11096356be15e19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal606b6d7eddc2e418f11096356be15e19 = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Icon::resolve(['name' => 'flag-language-'.e($default_language[0]->value).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Icon::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal606b6d7eddc2e418f11096356be15e19)): ?>
<?php $attributes = $__attributesOriginal606b6d7eddc2e418f11096356be15e19; ?>
<?php unset($__attributesOriginal606b6d7eddc2e418f11096356be15e19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal606b6d7eddc2e418f11096356be15e19)): ?>
<?php $component = $__componentOriginal606b6d7eddc2e418f11096356be15e19; ?>
<?php unset($__componentOriginal606b6d7eddc2e418f11096356be15e19); ?>
<?php endif; ?>
                        <?php echo e($default_language[0]->name); ?>

                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key != App::getLocale()): ?>
                                <li> <a class="dropdown-item inline" href="<?php echo e(route('lang.switch', $key)); ?>">
                                        <?php if (isset($component)) { $__componentOriginal606b6d7eddc2e418f11096356be15e19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal606b6d7eddc2e418f11096356be15e19 = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Icon::resolve(['name' => 'flag-language-'.e($key).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Icon::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal606b6d7eddc2e418f11096356be15e19)): ?>
<?php $attributes = $__attributesOriginal606b6d7eddc2e418f11096356be15e19; ?>
<?php unset($__attributesOriginal606b6d7eddc2e418f11096356be15e19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal606b6d7eddc2e418f11096356be15e19)): ?>
<?php $component = $__componentOriginal606b6d7eddc2e418f11096356be15e19; ?>
<?php unset($__componentOriginal606b6d7eddc2e418f11096356be15e19); ?>
<?php endif; ?>
                                        <?php echo e($lang); ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <?php if(!$company_user || $user->profile == null): ?>
                            <img src="<?php echo e(url('admin_assets/dist/img/avatar04.png')); ?>" class="user-image"
                                alt="User Image">
                        <?php else: ?>
                            <img src="<?php echo e($user->profile); ?>" class="user-image" alt="User Image">
                        <?php endif; ?>

                        <span class="hidden-xs"><?php echo e(!$company_user ? $user->username : $user->name); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">

                            <?php if(!$company_user || $user->profile == null): ?>
                                <img src="<?php echo e(url('admin_assets/dist/img/avatar04.png')); ?>" class="img-circle"
                                    alt="User Image">
                            <?php else: ?>
                                <img src="<?php echo e($user->profile); ?>" class="img-circle" alt="User Image">
                            <?php endif; ?>

                            <p>
                                <?php echo e(!$company_user ? $user->username : $user->name); ?>

                                <small>Member since <?php echo e(date('M. Y', strtotime($user->created_at))); ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <?php if($company_user): ?>
                                <div class="pull-left">
                                    <a href="<?php echo e(url('company/profile')); ?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                            <?php endif; ?>

                            <div class="pull-right">
                                <a href="<?php echo e(url($company_user ? 'company/logout' : 'admin/logout')); ?>"
                                    class="btn btn-primary btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <!--  <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
            </ul>
        </div>
        <?php if($company_user): ?>
            <select id="js-currency-select" class="form-control" style="display: none;">
                <?php $__currentLoopData = $currency_select; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($code); ?>" <?php if(session('currency') == $code): ?> selected="selected" <?php endif; ?>>
                        <?php echo e($code); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        <?php endif; ?>
    </nav>
</header>

<div class="flash-container hide">
    <?php if(Session::has('message')): ?>
        <div class="alert text-center <?php echo e(Session::get('alert-class')); ?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
</div>

<style type="text/css">
    #js-currency-select {
        padding: 1px 7px;
        float: right;
        font-size: 13px;
        display: inline-block;
        color: #000;
        height: auto;
        margin: 13px 6px 3px;
        border-color: rgb(169, 169, 169);
        width: auto;
    }
</style>
<?php /**PATH C:\laragon\www\rideinjune\resources\views/admin/common/header.blade.php ENDPATH**/ ?>