<?php $__env->startSection('header_style'); ?>
<?php 
    $index = 1;
?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/jtoast.js-master/src/toastStyle.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>User Manage</strong>
                    <div class="float-right">
                        <input class="btn btn-info date-picker" type="button" value="+ Add User" onclick="onUserAdd()">    
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Birthday</th>
                                    <th>State</th>
                                    <th>Notes</th>
                                    <th>OrganizationId</th>
                                    <th>User Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index++); ?></td>
                                        <td><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->birthday); ?></td>
                                        <td>
                                            <span class="role <?php echo e($user->state == 'activate' ? 'badge-success' : 'badge-danger'); ?>"><?php echo e($user->state); ?></span>
                                        </td>
                                        <td><?php echo e($user->notes); ?></td>
                                        <td><?php echo e($user->organizationName); ?></td>
                                        <td>
                                            <?php if($user->role == "user"): ?>
                                                 <span class="role badge-primary"><?php echo e($user->role); ?></span>
                                            <?php elseif($user->role == "DoorWorker"): ?>
                                                <span class="role badge-warning" ><?php echo e($user->role); ?></span>
                                            <?php elseif($user->role == "EventManager"): ?>
                                                <span class="role badge-info"><?php echo e($user->role); ?></span>
                                            <?php else: ?>
                                                <span class="role badge-success"><?php echo e($user->role); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="onEditUser('<?php echo e($user->name); ?>','<?php echo e($user->email); ?>','<?php echo e($user->birthday); ?>','<?php echo e($user->state); ?>','<?php echo e($user->notes); ?>','<?php echo e($user->organizationID); ?>','<?php echo e($user->role); ?>','<?php echo e($user->id); ?>')">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="onDeleteUser('<?php echo e($user->id); ?>')">
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
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" id="userId" value="" />
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="text-input" placeholder="Name" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="Email" id="email" name="text-input" placeholder="Email" class="form-control "  required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Birthday</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="birthday" name="text-input" placeholder="Birthday" class="form-control " required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">State</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control" id="state">
                                <option></option>
                                <option value="activate">Activate</option>
                                <option value="deactivate">Deactivate</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Note</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="note" name="text-input" placeholder="Note" class="form-control " required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Organization</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control" id="organization">
                                <option></option>
                                <?php $__currentLoopData = $organizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($organization->id); ?>"><?php echo e($organization->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="userrole"  required value="">
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="handleUser()" >Confirm</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>
<script type="text/javascript" src="<?php echo e(asset('vendor/jtoast.js-master/src/toast.min.js')); ?>" charset="UTF-8"></script>
<script type="text/javascript">
    init({
        fade_in : 800 ,
        fade_out : 800 ,
        position : 'top-right'
    });
    function onUserAdd(){
        $("#name").val('');
        $("#email").val('');
        $("#birthday").val('');
        $("#state").val('');
        $("#note").val('');
        $("#organization").val('');
        $("#userrole").val('user');
        $("#userId").val('');
        $("#userModal").modal('show');
    }
    function onEditUser(name,email,birthday,state,notes,organizationID,role,id) {
        $("#name").val(name);
        $("#email").val(email);
        $("#birthday").val(birthday);
        $("#state").val(state);
        $("#note").val(notes);
        $("#organization").val(organizationID);
        $("#userrole").val(role);
        $("#userId").val(id);
        $("#userModal").modal('show');
    }
    function onDeleteuser(id){
        $.post('userlist/deleteUser',{
            _token: "<?php echo e(csrf_token()); ?>",
            id:$("#userId").val(),
        },function(data,status){
            if(data.status == "success"){
                alert("User is successfully deleted");
                location.reload(true);
            }
        })
    }
    function handleUser(){
         if($("#name").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input Name Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#email").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input email Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#birthday").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input birthday Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#state").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input state Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#note").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input note Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#organization").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input organization Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#userrole").val() == ''){
            toast({ 
                title : 'Warning' , 
                description : 'Input userrole Field!' ,
                type : 'warning' ,
                timeout : 0
            })
        }
        else if($("#userId").val() == ''){
           $.post('userlist/addUser',{
                _token: "<?php echo e(csrf_token()); ?>",
                name:$("#name").val(),
                email:$("#email").val(),
                birthday:$("#birthday").val(),
                state:$("#state").val(),
                notes:$("#note").val(),
                organization:$("#organization").val(),
                role:$("#userrole").val(),
                id:$("#userId").val(),
            },function(data,status){
                if(data.status == "success"){
                    alert("User is successfully added");
                    location.reload(true);
                }
            })
        }
        else{
            $.post('userlist/editUser',{
            _token: "<?php echo e(csrf_token()); ?>",
            name:$("#name").val(),
            email:$("#email").val(),
            birthday:$("#birthday").val(),
            state:$("#state").val(),
            notes:$("#note").val(),
            organization:$("#organization").val(),
            role:$("#userrole").val(),
            id:$("#userId").val(),
        },function(data,status){
            if(data.status == "success"){
                alert("User is successfully edited");
                location.reload(true);
            }
        })
        }
        
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>