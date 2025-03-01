<?php $__env->startSection('main'); ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo e(__('messages.admin.manage_drivers_page.title')); ?>

        <small><?php echo e(__('messages.admin.control_panel')); ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url(LOGIN_USER_TYPE.'/dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(__('messages.admin.home')); ?></a></li>
        <li class="active"><?php echo e(__('messages.admin.manage_drivers_page.drivers')); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Manage Drivers</h3> -->
              <?php if((LOGIN_USER_TYPE=='company' && Auth::guard('company')->user()->status == 'Active') || (LOGIN_USER_TYPE=='admin' && Auth::guard('admin')->user()->can('create_driver'))): ?>
                <div style="float:right;"><a class="btn btn-success" href="<?php echo e(url(LOGIN_USER_TYPE.'/add_driver')); ?>"><?php echo e(__('messages.admin.manage_drivers_page.add_driver')); ?></a></div>
              <?php endif; ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
<?php echo $dataTable->table(); ?>

</div>
</div>
</div>
</div>
</section>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<link rel="stylesheet" href="<?php echo e(url('css/buttons.dataTables.css')); ?>">
<script src="<?php echo e(url('js/dataTables.buttons.js')); ?>"></script>
<script src="<?php echo e(url('js/buttons.server-side.js')); ?>"></script>
<?php echo $dataTable->scripts(); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\rideinjune\resources\views/admin/driver/view.blade.php ENDPATH**/ ?>