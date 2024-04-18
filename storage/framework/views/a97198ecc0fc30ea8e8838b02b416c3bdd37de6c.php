<?php $__env->startSection('body'); ?>

    <?php $__env->startPush('CustomStyle'); ?>

    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('PerPageCustomJs'); ?>

        <script>
            // for select2
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });

            // for select2 multiple
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });

        </script>
    <?php $__env->stopPush(); ?>
    <?php
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4"><?php echo e($ModuleTitle); ?></h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <?php echo Form::open(['method'=>'get','route'=>'admin.surveyresult.downloadCSV','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true]); ?>


                            <?php if(isset($input)): ?>
                                <?php
                                    if (isset($input['startdate'])){
                                        $startDate = $input['startdate'];
                                        $startDate = date("d-m-Y", strtotime($startDate));
                                    }else{
                                        $startDate = null;
                                    }

                                    if (isset($input['enddate'])){
                                        $enddate = $input['enddate'];
                                        $enddate = date("d-m-Y", strtotime($enddate));
                                    }else{
                                        $enddate = null;
                                    }
                                ?>
                                <?php if(isset($input['startdate'])): ?>
                                    <input type="hidden" name="startdate" value="<?php echo e($startDate); ?>">
                                    <input type="hidden" name="enddate" value="<?php echo e($enddate); ?>">
                                <?php endif; ?>

                                <?php if(isset($input['survey_id'])): ?>
                                    <input type="hidden" name="survey_id" value="<?php echo e($input['survey_id']); ?>">
                                <?php endif; ?>

                                <?php if(isset($input['item_id'])): ?>
                                    <input type="hidden" name="item_id" value="<?php echo e($input['item_id']); ?>">
                                <?php endif; ?>

                                <?php if(isset($input['device_id'])): ?>
                                    <input type="hidden" name="device_id" value="<?php echo e($input['device_id']); ?>">
                                <?php endif; ?>




                                <?php if(isset($input['organization_id'])): ?>
                                    <input type="hidden" name="organization_id" value="<?php echo e($input['organization_id']); ?>">
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['result-download'])): ?>
                                <button name="survey_result_download_excel" value="survey_result_download_excel" type="submit" class="btn btn-sm btn-outline-secondary module_button_header">
                                    <i class="fas fa-file-download"></i>  Excel
                                </button>
                                <button name="survey_result_download_pdf" value="survey_result_download_pdf" type="submit" class="btn btn-sm btn-outline-secondary module_button_header">
                                    <i class="fas fa-file-download"></i>  Pdf
                                </button>
                            <?php endif; ?>
                            <?php echo Form::close(); ?>



                            






                            <?php
                            $TultipMessage = __('SurveyResult::message.HintsMsg');
                            ?>

                            <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                               title="<?php echo e($TultipMessage); ?>">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-question-circle"></i> <?php echo e(__('SurveyResult::message.Hints')); ?>

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

                            <?php if(isset($allSurveyResults) && !empty($allSurveyResults)): ?>
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered table-sm" id="table_id">
                                        <thead>
                                        <?php echo Form::open(['method'=>'get','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true]); ?>

                                        <tr style="background-color: #d5d5d5;">
                                            <th colspan="3" style="vertical-align: middle;">
                                                Survey
                                                <a data-href="<?php echo e(route('admin.surveywise.item')); ?>" class="itemRoute"></a>
                                                <?php if(isset($input['survey_id']) && !empty($input['survey_id'])): ?>
                                                    <?php echo Form::select('survey_id',$surveySelect,$input['survey_id'],['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single']); ?>

                                                <?php else: ?>
                                                    <?php echo Form::select('survey_id',$surveySelect,Input::old('survey_id'),['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single']); ?>

                                                <?php endif; ?>
                                            </th>
                                            <th colspan="1" style="vertical-align: middle;">
                                                Item
                                                <?php if(isset($input['item_id']) && !empty($input['item_id'])): ?>
                                                    <?php echo Form::select('item_id',$surveyItem,$input['item_id'],['id'=>'item_id','class' => 'form-control form-select js-example-basic-single','required'=>true]); ?>

                                                <?php else: ?>
                                                    <?php
                                                        $item[''] = 'Choose Item';
                                                    ?>
                                                    <?php echo Form::select('item_id',$item,Input::old('item_id'),['id'=>'item_id','class' => 'form-control form-select js-example-basic-single','disabled'=>true]); ?>

                                                <?php endif; ?>
                                            </th>


<?php if(Auth::user()->hasRole('ADMINISTRATOR') || Auth::user()->hasRole('ADMIN_REPORTER') || Auth::user()->hasRole('ADMIN_OPERATOR')): ?>
                                            <th colspan="1" style="vertical-align: middle;">
                                                Device ID
                                                <?php if(isset($input['device_id'])): ?>
                                                <?php echo Form::text('device_id',$input['device_id'],['id'=>'device_id','class' => 'form-control','style'=>'height:28px']); ?>

                                                <?php else: ?>
                                                    <?php echo Form::text('device_id',Input::old('device_id'),['id'=>'device_id','class' => 'form-control','style'=>'height:28px']); ?>

                                                <?php endif; ?>
                                            </th>
                                            <?php endif; ?>

                                            <th colspan="2" style="vertical-align: middle;">
                                                Organization
                                                <?php if(isset($input['organization_id'])): ?>
                                                <?php echo Form::select('organization_id',$selectOrganization,$input['organization_id'],['id'=>'organization_id','class' => 'form-control form-select js-example-basic-single','style'=>'height:28px']); ?>

                                                <?php else: ?>
                                                    <?php echo Form::select('organization_id',$selectOrganization,Input::old('organization_id'),['id'=>'organization_id','class' => 'form-control form-select js-example-basic-single','style'=>'height:28px']); ?>

                                                <?php endif; ?>






                                            </th>

                                            <th style="vertical-align: middle;">
                                                Start Date
                                                <?php if(isset($input['startdate']) && !empty($input['startdate'])): ?>
                                                    <?php
                                                        $startDate = $input['startdate'];
                                                        $startDate = date("d-m-Y", strtotime($startDate));
                                                    ?>
                                                    <?php echo e(Form::date('startdate',date('Y-m-d', strtotime($startDate)),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px'])); ?>

                                                <?php else: ?>
                                                    <?php echo e(Form::date('startdate',Input::old(date('Y-m-d')),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px'])); ?>

                                                <?php endif; ?>
                                            </th>

                                            <th style="vertical-align: middle;">
                                                End Date
                                                <?php if(isset($input['enddate']) && !empty($input['enddate'])): ?>
                                                    <?php
                                                    $enddate = $input['enddate'];
                                                    $enddate = date("d-m-Y", strtotime($enddate));
                                                    ?>
                                                    <?php echo e(Form::date('enddate', date('Y-m-d', strtotime($enddate)),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px','placeholder'=>'Start Date'])); ?>

                                                <?php else: ?>
                                                    <?php echo e(Form::date('enddate',Input::old(date('Y-m-d')),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px'])); ?>

                                                <?php endif; ?>
                                            </th>

                                            <th style="text-align: center;vertical-align: middle;" colspan="2">
                                                <br>
                                                    <button name="survey_result_search_form_submit" value="survey_result_search_form_submit" type="submit" class="btn btn-primary" id="Filter" style="height: 28px;width: 20%">
                                                        <span style="display: block;margin-top: -4px;margin-left: -7px;"><i class="fas fa-search"></i></span>
                                                    </button>

                                                    <a href="<?php echo e(route('admin.surveyresult.index')); ?>" title="Reset" class="btn btn-danger" style="height: 28px;width: 20%;margin-left: 2px;"><span  style="display: block;margin-top: -4px;margin-left: -7px;"><i class="fas fa-redo-alt"></i></span>
                                                    </a>
                                            </th>

                                        </tr>
                                        <?php echo Form::close(); ?>



                                        <tr>
                                        <th>SL</th>
                                        <th>Survey Name</th>
                                            <th>Date</th>
                                            <th>Time</th>

                                            <?php if(Auth::user()->hasRole('ADMINISTRATOR')): ?>
                                        <th>Device ID</th>
                                            <?php endif; ?>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Item</th>
                                        <th>Organization</th>
                                            <?php if(Auth::user()->hasRole('ADMINISTRATOR')): ?>
                                        <th>User</th>
                                            <?php endif; ?>


                                        <th>Action</th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        <?php $__currentLoopData = $allSurveyResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($i++); ?></td>

                                                <td><?php echo e($value->SurveyName->nameen); ?></td>
                                                <td><?php echo e($value->created_at->format('d-m-Y')); ?></td>
                                                <td><?php echo e($value->created_at->format('h:i:s A')); ?></td>

                                                <?php if(Auth::user()->hasRole('ADMINISTRATOR')): ?>
                                                <td><?php echo e($value->device_id); ?></td>
                                                <?php endif; ?>
                                                <td><?php echo e($value->latitude); ?></td>
                                                <td><?php echo e($value->longitude); ?></td>
                                                <td><?php echo e($value->SurveyItem->itemtexten); ?></td>
                                                <td><?php echo e($value->SurveyOrganization->name); ?></td>
                                                <?php if(Auth::user()->hasRole('ADMINISTRATOR')): ?>
                                                <td><?php echo e($value->SurveyUser->name); ?></td>
                                                <?php endif; ?>














                                                <?php if(Auth::user()->hasRole('ADMINISTRATOR')): ?>
                                                <td>


                                                        <span class="allbutton<?php echo e($value->id); ?>">

                                                        <?php if(isset($value) && ($value->status == 1)): ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['result-edit'])): ?>
                                                        <a href="<?php echo e(route('admin.surveyresult.edit',$value->id)); ?>" title="Edit Survey" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
                                                                <?php endif; ?>



                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['result-delete'])): ?>
                                                        <a href="<?php echo e(route('admin.surveyresult.delete',$value->id)); ?>" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                                                <?php endif; ?>

                                                            <?php endif; ?>
                                                        </span>

                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    <?php echo e($allSurveyResults->appends(request()->query())->links('backend.layouts.pagination')); ?>

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
    
    <script>
        $(document).delegate('#survey_id','change',function () {
            var surveyId = $(this).val();
            var url = $('.itemRoute').attr('data-href');

            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                data: {surveyId: surveyId},
                beforeSend: function( xhr ) {

                }
            }).done(function( response ) {
                var allItems = response.items;
                // var userDataOption = '';
                var userDataOption='<option value="">Choose Item</option>';
                var userDataOption='<option value="all">All</option>';
                jQuery.each(allItems, function(i, item) {
                    userDataOption += '<option value="'+i+'">'+item+'</option>';
                });
                jQuery('#item_id').html(userDataOption);
                jQuery('#item_id').prop('disabled', false);
            }).fail(function( jqXHR, textStatus ) {

            });
            return false;
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(/** @lang text */'backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/shafiq/Sites/survey/app/Modules/SurveyResult/resources/views/SurveyResult/index.blade.php ENDPATH**/ ?>