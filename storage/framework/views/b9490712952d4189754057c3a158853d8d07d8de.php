<?php $__env->startSection('body'); ?>
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4"><?php echo e($ModuleTitle); ?></h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['organization-create'])): ?>
                            <a href="<?php echo e(route('admin.organization.create')); ?>" title="<?php echo e(__('Organization::message.CreateButton')); ?>" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus-circle"></i>  <?php echo e(__('Organization::message.CreateButton')); ?>

                                </button>
                            </a>
                            <?php endif; ?>


                            <?php
                            $TultipMessage = __('Organization::message.HintsMsg');
                            ?>

                            <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                               title="<?php echo e($TultipMessage); ?>">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-question-circle"></i> <?php echo e(__('Organization::message.Hints')); ?>

                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </main>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <?php echo e($TableTitle); ?>

                        </div>
                        <div class="card-body">
                            <?php echo $__env->make('backend.layouts.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php if(isset($allOrganization) && !empty($allOrganization)): ?>
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered" id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        <?php $__currentLoopData = $allOrganization; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($i++); ?></td>
                                                <td><?php echo e($value->name); ?></td>
                                                <td><?php echo e($value->address); ?></td>
                                                <td><?php echo e($value->mobile); ?></td>
                                                <td><?php echo e($value->email); ?></td>
                                                <td>
                                                    <?php
                                                        if (isset($value) && ($value->status == 1)){
                                                            $checked = 'checked';
                                                            $CheckValue = 0;
                                                        }else{
                                                            $checked = '';
                                                            $CheckValue = 1;
                                                        }
                                                    ?>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input isChecked setvalue<?php echo e($value->id); ?>" type="checkbox" style="text-align: center" id="flexSwitchCheckChecked" <?php echo e($checked); ?> dbTable = 'sur_organization' value="<?php echo e($CheckValue); ?>" data-id="<?php echo e($value->id); ?>" data-href="<?php echo e(route('admin.status.change')); ?>" onchange="getCheckboxValue(this.value,this.data-id)">
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($value->status == 1){
                                                            $style = '';
                                                        }else{
                                                            $style = 'display:none';
                                                        }
                                                    ?>
                                                    <span class="allbutton<?php echo e($value->id); ?>" style="<?php echo e($style); ?>">


                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['organization-edit'])): ?>
                                                    <a href="<?php echo e(route('admin.organization.edit',$value->id)); ?>" title="Edit Brand" class="text-primary"><i class="fas fa-pencil-alt"></i></a><?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['organization-delete'])): ?>
                                                    <a href="<?php echo e(route('admin.organization.delete',$value->id)); ?>" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a><?php endif; ?>

                                                                                                            </span>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    <?php echo e($allOrganization->links('backend.layouts.pagination')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('PerPageCustomJs'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make(/** @lang text */'backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/shafiq/Sites/survey/app/Modules/Organization/resources/views/organization/index.blade.php ENDPATH**/ ?>