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
                <div class="card-header">
                    <strong>Upcoming Events</strong>
                    <div class="float-right">
                        <input class="btn btn-info date-picker" type="button" value="+ Add Upcoming Event" onclick="handleEventAdd()">    
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Notes</th>
                                    <th>StartTime</th>
                                    <th>EndTime</th>
                                    <th>listMaxCapacity</th>
                                    <th>plusOnes</th>
                                    <th>listOpenTime</th>
                                    <th>listCloseTime</th>
                                    <th>Theme</th>
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
                                        <td><?php echo e($event->endTimeStamp); ?></td>
                                        <td><?php echo e($event->listMaxCapacity); ?></td>
                                        <td><?php echo e($event->plusOnes); ?></td>
                                        <td><?php echo e($event->listOpenTime); ?></td>
                                        <td><?php echo e($event->listCloseTime); ?></td>
                                        <td><?php echo e($event->theme); ?></td>
                                        <td><?php echo e($event->locationName); ?></td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a class="item" data-toggle="tooltip" data-placement="top" title="Invite" href="upcomingEvents/invite/<?php echo e($event->id); ?>">
                                                    <i class="zmdi zmdi-mail-send"></i>
                                                </a>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="onEventEdit('<?php echo e($event->notes); ?>','<?php echo e($event->startTimeStamp); ?>','<?php echo e($event->endTimeStamp); ?>','<?php echo e($event->listMaxCapacity); ?>','<?php echo e($event->plusOnes); ?>','<?php echo e($event->listOpenTime); ?>','<?php echo e($event->listCloseTime); ?>','<?php echo e($event->theme); ?>','<?php echo e($event->location); ?>','<?php echo e($event->id); ?>')">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="onEventDelete('<?php echo e($event->id); ?>')">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
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
<div class="modal fade" id="upComingModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Add Upcoming Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" method="post"  class="form-horizontal">
                    <input type="hidden" id="eventId" value="" />
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Notes</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="notes" name="text-input" placeholder="Notes" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group" >
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">StartTime</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="input-group date form_datetime "  data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                                
                                <input type="text" id="startTime" name="text-input" placeholder="StartTime" class="form-control "  readonly required>
                                <span class="input-group-addon"><span class="fa fa-close"></span></span>
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input1" value="" required/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">EndTime</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="input-group date form_datetime "  data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input2">
                                
                                <input type="text" id="endTime" name="text-input" placeholder="EndTime" class="form-control"  readonly required>
                                <span class="input-group-addon"><span class="fa fa-close"></span></span>
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input2" value="" required/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">ListMaxCapacity</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="listMaxCapacity" name="text-input" placeholder="ListMaxCapacity" class="form-control "  required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">PlusOne</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="plusOne" name="text-input" placeholder="PlusOne" class="form-control " required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">ListOpenTime</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="input-group date form_datetime "  data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input3" required>
                                
                                <input type="text" id="listOpenTime" name="text-input" placeholder="ListOpenTime" class="form-control "  readonly>
                                <span class="input-group-addon"><span class="fa fa-close"></span></span>
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input3" value="" required/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">ListCloseTime</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="input-group date form_datetime "  data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input4" required>
                                
                                <input type="text" id="listCloseTime" name="text-input" placeholder="ListCloseTime" class="form-control "  readonly>
                                <span class="input-group-addon"><span class="fa fa-close"></span></span>
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input4" value="" required />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Theme</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="theme" name="text-input" placeholder="Theme" class="form-control " required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Location</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control" id="eventLocation" >
                                <option value=""></option>
                                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($location->id); ?>"><?php echo e($location->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="onEventAdd()" >Confirm</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>

 
<script type="text/javascript" src="<?php echo e(asset('vendor/jtoast.js-master/src/toast.min.js')); ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo e(asset('vendor/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js')); ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo e(asset('vendor/bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.fr.js')); ?>" charset="UTF-8"></script>
<script type="text/javascript">
    init({
        fade_in : 800 ,
        fade_out : 800 ,
        position : 'top-right'
    });
    $('.form_datetime').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    function onEventEdit(notes,startTime,endTime,listMaxCapacity,plusOne,openTIme,closeTime,theme,location,id){
        $("#largeModalLabel").html("Edit Upcoming Events");
        $("#notes").val(notes);
        $("#dtp_input1").val(startTime);
        $("#startTime").val(startTime);
        $("#dtp_input2").val(endTime);
        $("#endTime").val(endTime);
        $("#listMaxCapacity").val(listMaxCapacity);
        $("#plusOne").val(plusOne);
        $("#dtp_input3").val(openTIme);
        $("#listOpenTime").val(openTIme);
        $("#dtp_input4").val(closeTime);
        $("#listCloseTime").val(closeTime);
        $("#eventId").val(id);
        $("#theme").val(theme);
        $("#eventLocation").val(location);
        $("#upComingModal").modal('show');
    }
    function handleEventAdd(){
        $("#largeModalLabel").html("Add Upcoming Events");
        $("#notes").val('');
        $("#dtp_input1").val('');
        $("#startTime").val('');
        $("#dtp_input2").val('');
        $("#endTime").val('');
        $("#listMaxCapacity").val('');
        $("#plusOne").val('');
        $("#dtp_input3").val('');
        $("#listOpenTime").val('');
        $("#dtp_input4").val('');
        $("#listCloseTime").val('');
        $("#eventId").val('');
        $("#theme").val('');
        $("#eventLocation").val('');
        $("#upComingModal").modal('show');
    }
    function onEventDelete(id){
        if (confirm('Are you sure you want to delete this event into the database?')) {
            $.post('upcomingEvents/deleteEvent',{
                _token: "<?php echo e(csrf_token()); ?>",
                id:id,
            },function(data,status){
                if(data.status == "success"){
                    alert("Your event is successfully deleted");
                    location.reload(true);
                }
            })
        } else {
            // Do nothing!
        }
    }
    function onEventAdd(){
        if($('#notes').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Notes Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#dtp_input1').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input StartTime Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#dtp_input2').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input EndTime Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#dtp_input1").val() > $('#dtp_input2').val())
        {
            toast({ 
                title : 'Warning' , 
                description : 'Starttime is later than endtime !' ,
                type : 'warning' ,
                timeout : 0
            })   
        }
        else if($('#listMaxCapacity').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input MaxCapacity Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#plusOne').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input plusOne Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        
        else if($("#plusOne").val() > $('#listMaxCapacity').val())
        {
            toast({ 
                title : 'Warning' , 
                description : 'plusone is bigger than max capacity !' ,
                type : 'warning' ,
                timeout : 0
            })   
        }
        else if($('#dtp_input3').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input OpenTime Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#dtp_input4').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input CloseTime Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }

        else if($("#dtp_input3").val() > $('#dtp_input4').val())
        {
            toast({ 
                title : 'Warning' , 
                description : 'OpenTime is later than closetime !' ,
                type : 'warning' ,
                timeout : 0
            })   
        }
        else if($('#theme').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Theme Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#eventLocation").val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Location Field!' ,
                type : 'warning' ,
                timeout : 0
            })   
        }
        else if($("#eventId").val() == "")
        {
            $.post('upcomingEvents/addEvent',{
                _token: "<?php echo e(csrf_token()); ?>",
                notes:$('#notes').val(),
                startTime:$("#dtp_input1").val(),
                endTime:$("#dtp_input2").val(),
                listMaxCapacity:$("#listMaxCapacity").val(),
                plusOnes:$("#plusOne").val(),
                listOpenTime:$("#dtp_input3").val(),
                listCloseTime:$("#dtp_input4").val(),
                theme:$("#theme").val(),
                location:$("#eventLocation").val()
            },function(data,status){
                if(data.status == "success"){
                    alert("Your event is successfully added");
                    location.reload(true);
                }
            })

        }
        else{
            $.post('upcomingEvents/editEvent',{
                _token: "<?php echo e(csrf_token()); ?>",
                id:$("#eventId").val(),
                notes:$('#notes').val(),
                startTime:$("#dtp_input1").val(),
                endTime:$("#dtp_input2").val(),
                listMaxCapacity:$("#listMaxCapacity").val(),
                plusOnes:$("#plusOne").val(),
                listOpenTime:$("#dtp_input3").val(),
                listCloseTime:$("#dtp_input4").val(),
                theme:$("#theme").val(),
                location:$("#eventLocation").val()
            },function(data,status){
                if(data.status == "success"){
                    alert("Your event is successfully edited");
                    location.reload(true);
                }
            })
        }
    }
</script>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>