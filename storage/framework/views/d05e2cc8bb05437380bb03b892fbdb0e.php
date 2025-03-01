<?php $__env->startSection('main'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo e(__('messages.admin.dashboard_page.dashboard')); ?>

                <small> <?php echo e(__('messages.admin.control_panel')); ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(url(LOGIN_USER_TYPE . '/dashboard')); ?>"><i class="fa fa-dashboard"></i>
                        <?php echo e(__('messages.admin.home')); ?></a></li>
                <li class="active"> <?php echo e(__('messages.admin.dashboard_page.dashboard')); ?></li>
            </ol>
        </section>

        <?php if(LOGIN_USER_TYPE == 'company' || auth('admin')->user()->can('manage_trips')): ?>
            <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <a href="<?php echo e(url(LOGIN_USER_TYPE . '/trips')); ?>" class="small-box">
                            <div class="inner">
                                <p> <?php echo e(__('messages.admin.dashboard_page.total_earnings')); ?></p>
                                <h3> <?php echo e(html_string($currency_code)); ?> <?php echo e(round($total_revenue)); ?></h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <!-- <a href="<?php echo e(url(LOGIN_USER_TYPE . '/trips')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                        </a>
                    </div>

                    <?php if(LOGIN_USER_TYPE == 'company'): ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="<?php echo e(url(LOGIN_USER_TYPE . '/statements/overall')); ?>" class="small-box">
                                <div class="inner">
                                    <p> Received Amount </p>
                                    <h3><?php echo e(html_string($currency_code)); ?> <?php echo e(round($admin_paid_amount)); ?></h3>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-dollar"></i>
                                </div>
                                <!-- <a href="<?php echo e(url(LOGIN_USER_TYPE . '/statements/overall')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if(LOGIN_USER_TYPE != 'company'): ?>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="<?php echo e(url('admin/rider')); ?>" class="small-box">
                                <div class="inner">
                                    <p> <?php echo e(__('messages.admin.dashboard_page.total_riders')); ?></p>
                                    <h3><?php echo e($total_rider); ?> &nbsp;&nbsp;&nbsp;&nbsp;<small><b>Android :
                                                <?php echo e($total_rider_android); ?></b></small> &nbsp; <small><b>IOS :
                                                <?php echo e($total_rider_ios); ?></b></small></h3>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <!-- <a href="<?php echo e(url('admin/rider')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <a href="<?php echo e(url(LOGIN_USER_TYPE . '/driver')); ?>" class="small-box">
                            <div class="inner">
                                <p> <?php echo e(__('messages.admin.dashboard_page.total_drivers')); ?></p>
                                <h3><?php echo e($total_driver); ?> &nbsp;&nbsp;&nbsp;&nbsp;<small><b>Android :
                                            <?php echo e($total_driver_android); ?></b></small> &nbsp; <small><b>IOS :
                                            <?php echo e($total_driver_ios); ?></b></small></h3>

                            </div>
                            <div class="icon">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <!-- <a href="<?php echo e(url(LOGIN_USER_TYPE . '/driver')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                        </a>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <a href="<?php echo e(url(LOGIN_USER_TYPE . '/trips')); ?>" class="small-box">
                            <div class="inner">
                                <p> <?php echo e(__('messages.admin.dashboard_page.total_trips')); ?></p>
                                <h3><?php echo e($total_trips); ?></h3>

                            </div>
                            <div class="icon">
                                <i class="fa fa-cab"></i>
                            </div>
                            <!-- <a href="<?php echo e(url(LOGIN_USER_TYPE . '/trips')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                        </a>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- ./col -->
                <!-- /.row -->
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <a href="<?php echo e(url(LOGIN_USER_TYPE . '/trips')); ?>" class="small-box">
                            <div class="inner">
                                <p> <?php echo e(__('messages.admin.dashboard_page.today_earnings')); ?></p>
                                <h3> <?php echo e(html_string($currency_code)); ?> <?php echo e(round($today_revenue)); ?></h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <!-- <a href="<?php echo e(url(LOGIN_USER_TYPE . '/trips')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                        </a>
                    </div>
                    <?php if(LOGIN_USER_TYPE == 'company'): ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="<?php echo e(url(LOGIN_USER_TYPE . '/statements/overall')); ?>" class="small-box">
                                <div class="inner">
                                    <p> Pending Amount </p>
                                    <h3> <?php echo e(html_string($currency_code)); ?> <?php echo e(round($admin_pending_amount)); ?></h3>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-dollar"></i>
                                </div>
                                <!-- <a href="<?php echo e(url(LOGIN_USER_TYPE . '/statements/overall')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </a>
                        </div>
                    <?php endif; ?>
                    <!-- ./col -->
                    <!-- ./col -->
                    <?php if(LOGIN_USER_TYPE != 'company'): ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="<?php echo e(url('admin/rider')); ?>" class="small-box">
                                <div class="inner">
                                    <p> <?php echo e(__('messages.admin.dashboard_page.today_riders')); ?></p>
                                    <h3><?php echo e($today_rider_count); ?> &nbsp;&nbsp;&nbsp;&nbsp;<small><b>Android :
                                                <?php echo e($today_rider_count_android); ?></b></small> &nbsp; <small><b>IOS :
                                                <?php echo e($today_rider_count_ios); ?></b></small></h3>

                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <!-- <a href="<?php echo e(url('admin/rider')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                            </a>
                        </div>
                    <?php endif; ?>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <a href="<?php echo e(url(LOGIN_USER_TYPE . '/driver')); ?>" class="small-box">
                            <div class="inner">
                                <p> <?php echo e(__('messages.admin.dashboard_page.today_drivers')); ?></p>
                                <h3><?php echo e($today_driver_count); ?> &nbsp;&nbsp;&nbsp;&nbsp;<small><b>Android :
                                            <?php echo e($today_driver_count_android); ?></b></small> &nbsp; <small><b>IOS :
                                            <?php echo e($today_driver_count_ios); ?></b></small></h3>

                            </div>
                            <div class="icon">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <!-- <a href="<?php echo e(url(LOGIN_USER_TYPE . '/driver')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                        </a>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <a href="<?php echo e(url(LOGIN_USER_TYPE . '/trips')); ?>" class="small-box">
                            <div class="inner">
                                <p> <?php echo e(__('messages.admin.dashboard_page.today_trips')); ?></p>
                                <h3><?php echo e($today_trips); ?></h3>

                            </div>
                            <div class="icon">
                                <i class="fa fa-cab"></i>
                            </div>
                            <!-- <a href="<?php echo e(url(LOGIN_USER_TYPE . '/trips')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                        </a>
                    </div>

                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <input type="hidden" value='<?php echo e($line_chart_data); ?>' id="line-chart-data">
                        <!-- [ {"y": "2013 Q1", "amount": 2666}, {"y": "2011 Q2", "amount": 2778}, {"y": "2011 Q3", "amount": 4912}, {"y": "2012 Q1", "amount": 6810}, {"y": "2012 Q2", "amount": 5670}, {"y": "2012 Q3", "amount": 4820}, {"y": "2013 Q1", "amount": 10687}, {"y": "2013 Q2", "amount": 8432}, {"y": "2016 Q3", "amount": 8432} ] -->
                        <!-- solid sales graph -->
                        <div class="box box-solid bg-teal-gradient">
                            <div class="box-header">
                                <i class="fa fa-th"></i>

                                <h3 class="box-title"><?php echo e(__('messages.admin.dashboard_page.sales_graph')); ?></h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i
                                            class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body border-radius-none">
                                <div class="chart" id="line-chart" style="height: 250px;"></div>
                            </div>
                        </div>
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-5 connectedSortable">
                        <!-- Calendar -->
                        <div class="box box-solid bg-green-gradient">
                            <div class="box-header">
                                <i class="fa fa-calendar"></i>

                                <h3 class="box-title"><?php echo e(__('messages.admin.dashboard_page.calender')); ?></h3>
                                <div class="pull-right box-tools">
                                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i
                                            class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div id="calendar" style="width: 100%"></div>
                            </div>
                        </div>
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </section>
            <!-- /.content -->

            <section class="content-header" style="padding: 0px 15px 15px 15px;">
                <div class="col-lg-6 recent_rides_section">
                    <h3>
                        <?php echo e(__('messages.admin.dashboard_page.recent_ride_requests')); ?>

                        <span id="close_recent"><i class="fa fa-close"></i></span>
                    </h3>
                    <?php if($recent_trips->count()): ?>
                        <div class="table-responsive">
                            <table class="recent_rides_table">
                                <tr>
                                    <th> <?php echo e(__('messages.admin.dashboard_page.table.group_id')); ?></th>
                                    <th><?php echo e(__('messages.admin.dashboard_page.table.rider_name')); ?></th>
                                    <th><?php echo e(__('messages.admin.dashboard_page.table.dated_on')); ?></th>
                                    <th><?php echo e(__('messages.admin.dashboard_page.table.status')); ?></th>
                                    <th></th>
                                </tr>
                                <?php $__currentLoopData = $recent_trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_trips): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr data-toggle="collapse" data-target="#accordion<?php echo e($row_trips->group_id); ?>"
                                        class="clickable">
                                        <td><a
                                                href="<?php echo e(url('/') . '/' . LOGIN_USER_TYPE); ?>/detail_request/<?php echo e($row_trips->id); ?>">#<?php echo e($row_trips->id); ?></a>
                                        </td>
                                        <td><?php echo e($row_trips->users->first_name); ?></td>
                                        <td class="text-nowrap"><?php echo e($row_trips->date_time); ?></td>
                                        <?php
                                            $request_status = DB::table('request')
                                                ->where('group_id', $row_trips->group_id)
                                                ->where('status', 'Accepted');
                                            $pending_request_status = DB::table('request')
                                                ->where('group_id', $row_trips->group_id)
                                                ->where('status', 'Pending')
                                                ->count();
                                        ?>
                                        <?php if($request_status->count() > 0): ?>
                                            <?php
                                                $req_id = $request_status->get()->first()->id;
                                                $trip_status = @DB::table('trips')
                                                    ->where('request_id', $req_id)
                                                    ->get()
                                                    ->first()->status;
                                            ?>
                                            <td class="text-nowrap"><span
                                                    class="dash_status <?php echo e(@$trip_status); ?>"><?php echo e(@$trip_status); ?></span>
                                            </td>
                                        <?php elseif($pending_request_status): ?>
                                            <td class="text-nowrap"><span class="dash_status Searching">Searching</span>
                                            </td>
                                        <?php else: ?>
                                            <td class="text-nowrap"><span class="dash_status Searched">No one
                                                    accepted</span></td>
                                        <?php endif; ?>
                                        <td>
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </td>
                                    </tr>
                                    <tr id="accordion<?php echo e($row_trips->group_id); ?>" class="table-wrap-row collapse">
                                        <td colspan="5">
                                            <table>
                                                <tr>
                                                    <th>Driver Name</th>
                                                    <th>status</th>
                                                </tr>
                                                <?php $__currentLoopData = $row_trips->request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($val->driver->first_name); ?></td>
                                                        <td><?php echo e($val->status == 'Cancelled' ? 'Not Accepted' : $val->status); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    <?php else: ?>
                        <small>Recently no Rides found</small>
                    <?php endif; ?>
                </div>
            </section>
        <?php else: ?>
            <div style="height: 80vh;text-align: center;padding-top: 150px;font-size: 15px;">
                Welcome to Dispatcher panel
            </div>
        <?php endif; ?>
        <input type="hidden" class="form-control" placeholder="">
    </div>
    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\rideinjune\resources\views/admin/index.blade.php ENDPATH**/ ?>