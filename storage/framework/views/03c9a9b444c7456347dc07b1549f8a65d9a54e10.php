<?php $__env->startSection('header_style'); ?>
<?php 
    $index = 1;
?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/jtoast.js-master/src/toastStyle.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/CustomFileInputs/css/component.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Invite Guests</strong>
                    <div class="float-right"> 

                        <input class="btn btn-success" type="button" value="Download" onclick="onExportExcel()">    
                        <input class="btn btn-info" type="button" value="+ Invite Plusone" onclick="onPlusone()">    
                        <input class="btn btn-info" type="button" value="+ Invite Guest" onclick="onInvite()">      
                    </div>
                </div>
                <div class="card-body">
                    <div class="au-task__item au-task__item--success">
                        <div class="au-task__item-inner">
                            <h5 class="task">
                                <a href="#">Title : <?php echo e($event->notes); ?></a>
                            </h5>
                            <span class="time">Timeline : <?php echo e($event->startTimeStamp); ?> ~ <?php echo e($event->endTimeStamp); ?></span><br/>
                            <span class="time">List Max Capacity : <?php echo e($event->listMaxCapacity); ?></span><br/>
                            <span class="time">Plus One : <?php echo e($event->plusOnes); ?></span>
                        </div>
                    </div>
                    <br/>
                    
                    <form action="importExcel" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
         
                        <?php if(Session::has('success')): ?>
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p><?php echo e(Session::get('success')); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="file" name="import_file" class="form-control-file">        
                            </div>
                            <div class="col-md-9">
                                <button class="btn btn-danger">Upload</button>
                            </div>
                        </div>
                    </form>   
                    <br/>                 
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3" id="invitelist">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Notes</th>
                                    <th>Type</th>
                                    <th>InvitedBy</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $inviteLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inviteList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index++); ?></td>
                                        <td><?php echo e($inviteList->detail->name); ?></td>
                                        <td><?php echo e($inviteList->notes); ?></td>
                                        <td><?php echo e($inviteList->type); ?></td>
                                        <td><?php echo e($inviteList->invite_detail->name); ?></td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="onGuestEdit('<?php echo e($inviteList->guestId); ?>','<?php echo e($inviteList->notes); ?>','<?php echo e($inviteList->type); ?>','<?php echo e($inviteList->id); ?>',)">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="onGuestDelete('<?php echo e($inviteList->id); ?>')">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>    
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $plusonlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plusOneList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index++); ?></td>
                                        <td><?php echo e($plusOneList->detail->name); ?></td>
                                        <td><?php echo e($plusOneList->notes); ?></td>
                                        <td><?php echo e($plusOneList->type); ?></td>
                                        <td><?php echo e($plusOneList->invite_detail->name); ?></td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="onPlusoneEdit('<?php echo e($plusOneList->detail->name); ?>','<?php echo e($plusOneList->notes); ?>','<?php echo e($plusOneList->detail->birthday); ?>','<?php echo e($plusOneList->id); ?>','<?php echo e($plusOneList->detail->id); ?>')">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="delete" onclick="onPlsuoneDelete('<?php echo e($plusOneList->id); ?>')">
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
<div class="modal fade" id="guestModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Invite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" id="inviteId" value="" />
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control" id="name">
                                <option></option>
                                <?php $__currentLoopData = $guests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($guest->id); ?>"><?php echo e($guest->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Notes</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="notes" name="text-input" placeholder="Notes" class="form-control "  required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Type</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control" id="type">
                                <option></option>
                                <option value="guest">Guest</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="handleInvite()" >Confirm</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="plusonModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Invite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" id="plusone_inviteId" value="" />
                    <input type="hidden" id="plusone_plusid" value="" />
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="plusone_name" name="text-input" placeholder="Name" class="form-control "  required>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Notes</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="plusone_notes" name="text-input" placeholder="Notes" class="form-control "  required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Birthday</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="plusone_birthday" name="text-input" placeholder="Birthday" class="form-control "  required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="handlePlusone()" >Confirm</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>
<script type="text/javascript" src="<?php echo e(asset('vendor/jtoast.js-master/src/toast.min.js')); ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo e(asset('vendor/CustomFileInputs/js/custom-file-input.js')); ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo e(asset('vendor/Export-Html-Table-To-Excel-Spreadsheet-using-jQuery-table2excel/src/jquery.table2excel.js')); ?>" charset="UTF-8"></script>

<script type="text/javascript">
    init({
        fade_in : 800 ,
        fade_out : 800 ,
        position : 'top-right'
    });
    function onExportExcel(){
        var table = $("#invitelist");
        if(table && table.length){
            $(table).table2excel({
                exclude: ".noExl",
                name: "Invited People List",
                filename: "peopleList" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
            });
        }
    }
     function onPlusone(){
        $("#plusone_name").val('');
        $("#plusone_notes").val('');
        $("#plusone_birthday").val('');
        $("#plusonModal").modal('show');
    }
    function onPlusoneEdit(guestId,notes,birthday,id,plusid){
        $("#plusone_name").val(guestId);
        $("#plusone_notes").val(notes);
        $("#plusone_inviteId").val(id);
        $("#plusone_plusid").val(plusid);
        $("#plusone_birthday").val(birthday);
        $("#plusonModal").modal('show');
    }
    function handlePlusone(  ){
        if($('#plusone_name').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Name Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#plusone_birthday').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Birthday Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#plusone_notes').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Notes Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#plusone_inviteId').val() == ""){
            $.post('addPlusone',{
                _token: "<?php echo e(csrf_token()); ?>",
                id:$("#plusone_name").val(),
                type:'plusone',
                notes:$("#plusone_notes").val(),
                birthday:$("#plusone_birthday").val(),
                eventId:"<?php echo e($event->id); ?>"
            },function(data,status){
                if(data.status == "success"){
                    alert("user is successfully invited.");
                    location.reload(true);
                }
                else{
                    alert(data.status);
                }
            })
        }
        else{
            $.post('editPlusone',{
                _token: "<?php echo e(csrf_token()); ?>",
                id:$("#plusone_name").val(),
                type:'plusone',
                notes:$("#plusone_notes").val(),
                birthday:$("#plusone_birthday").val(),
                eventId:"<?php echo e($event->id); ?>",
                invite_id:$("#plusone_inviteId").val(),
                plusid:$("#plusone_plusid").val()
            },function(data,status){
                if(data.status == "success"){
                    alert("user is successfully edited.");
                    location.reload(true);
                }
            })
        }
    }
    function onPlsuoneDelete(id){
        if (confirm('Are you sure you want to delete this user into the database?')) {
            $.post('deletePlusone',{
                _token: "<?php echo e(csrf_token()); ?>",
                id:id,
                plusid:$("#plusid").val()
            },function(data,status){
                if(data.status == "success"){
                    alert("User is successfully deleted");
                    location.reload(true);
                }
            })
        } else {
            // Do nothing!
        }
    }
    
    function onInvite(){
        $("#name").val('');
        $("#type").val('');
        $("#notes").val('');
        $("#guestModal").modal('show');
    }
    function onGuestEdit(guestId,notes,type,id){
        $("#name").val(guestId);
        $("#type").val(type);
        $("#notes").val(notes);
        $("#inviteId").val(id);
        $("#guestModal").modal('show');
    }
    function onGuestDelete(id){
        if (confirm('Are you sure you want to delete this guest into the database?')) {
            $.post('deleteInvite',{
                _token: "<?php echo e(csrf_token()); ?>",
                id:id,
            },function(data,status){
                if(data.status == "success"){
                    alert("Guest is successfully deleted");
                    location.reload(true);
                }
            })
        } else {
            // Do nothing!
        }
    }
    function handleInvite(  ){
        if($('#name').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Name Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#type').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Type Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#notes').val() == ""){
            toast({ 
                title : 'Warning' , 
                description : 'Input Notes Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($('#inviteId').val() == ""){
            $.post('addInvite',{
                _token: "<?php echo e(csrf_token()); ?>",
                id:$("#name").val(),
                type:$("#type").val(),
                notes:$("#notes").val(),
                eventId:"<?php echo e($event->id); ?>"
            },function(data,status){
                if(data.status == "success"){
                    alert("Guest is successfully invited.");
                    location.reload(true);
                }
                else{
                    alert("Number of guests is bigger than max capacity");
                }
            })
        }
        else{
            $.post('editInvite',{
                _token: "<?php echo e(csrf_token()); ?>",
                id:$("#name").val(),
                type:$("#type").val(),
                notes:$("#notes").val(),
                eventId:"<?php echo e($event->id); ?>",
                invite_id:$("#inviteId").val()
            },function(data,status){
                if(data.status == "success"){
                    alert("Guest is successfully edited.");
                    location.reload(true);
                }
            })
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>