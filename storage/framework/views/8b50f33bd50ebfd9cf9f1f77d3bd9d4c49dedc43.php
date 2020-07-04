<?php $__env->startSection('header_style'); ?>
<?php 
    $index = 1;
?>
<link href="<?php echo e(asset('vendor/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css')); ?>" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/jtoast.js-master/src/toastStyle.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Upcoming Events</div>

                <div class="card-body">
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Notes</th>
                                    <th>StartTime</th>
                                    <th>Info</th>
                                    <th>Location</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index++); ?></td>
                                        <td><?php echo e($event->notes); ?></td>
                                        <td><?php echo e($event->startTimeStamp); ?></td>
                                        <td><?php echo e($event->totalGuest); ?> guests invited</td>
                                        <td><?php echo e($event->locationName); ?></td>
                                        <td>
                                                <div class="table-data-feature">
                                                    <a class="item" data-toggle="tooltip" data-placement="top" title="Add Plusone" href="upcomingEvents/plusone/<?php echo e($event->id); ?>">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </a>
                                                </div>
                                        </td>  
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>

 
<script type="text/javascript" src="<?php echo e(asset('vendor/jtoast.js-master/src/toast.min.js')); ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo e(asset('vendor/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js')); ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo e(asset('vendor/bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.fr.js')); ?>" charset="UTF-8"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>