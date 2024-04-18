<?php $__env->startSection('body'); ?>
    <?php $__env->startPush('CustomStyle'); ?>
        <style>
            .chartdiv {
                width: 100%;
                height: 300px;
            }
        </style>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('PerPageCustomJs'); ?>
        <script src="https://cdn.amcharts.com/lib/version/5.1.7/index.js"></script>

        <script src="<?php echo e(asset('backend/amchartjs/xy.js')); ?>"></script>
        <script src="<?php echo e(asset('backend/amchartjs/percent.js')); ?>"></script>
        <script src="<?php echo e(asset('backend/amchartjs/animated.js')); ?>"></script>
        <script src="<?php echo e(asset('backend/amchartjs/exporting.js')); ?>"></script>
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
    use App\Modules\SurveyResult\Models\SurveyResult;
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
    <div class="dashboard-area" <?php echo e(session()->get('locale')); ?>>

        <div id="carbon-block">

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h4">Survey Chart</h2>

                    <div class="btn-toolbar mb-2 mb-md-0">


                    </div>
                </div>
            </main>

            <?php
                if (isset($input)){
                    $searchDate = $input['date'];
                    $searchDate = date("d-m-Y", strtotime($searchDate));
                }else{
                    $searchDate = date('d-m-Y');
                }
            ?>


            <?php echo Form::open(['route' => 'admin.surveygraph.valuewise','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true]); ?>

            <div class="card" style="margin-bottom: 20px !important;">
                <div class="card-header" style="font-size: 16px;font-weight: bold;">
                    Filter
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <?php if(isset($searchDate)): ?>
                                <?php echo e(Form::date('date',date('Y-m-d', strtotime($searchDate)),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px'])); ?>

                            <?php else: ?>
                                <?php echo e(Form::date('date',Input::old(date('Y-m-d')),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px','required'=>true])); ?>

                            <?php endif; ?>
                        </div>

                        <div class="col-md-3">
                            <a data-href="<?php echo e(route('admin.surveywise.item')); ?>" class="itemRoute"></a>
                            <?php if(isset($input)): ?>
                            <?php echo Form::select('survey_id',$surveySelect,$input['survey_id'],['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single','required'=>true]); ?>

                            <?php else: ?>
                                <?php echo Form::select('survey_id',$surveySelect,Input::old('survey_id'),['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single','required'=>true]); ?>

                            <?php endif; ?>
                        </div>

                        <div class="col-md-3">
                            <?php if(isset($input)): ?>
                            <?php echo Form::select('item_id',$surveyItem,$input['item_id'],['id'=>'item_id','class' => 'form-control form-select js-example-basic-single','required'=>true]); ?>

                            <?php else: ?>
                                <?php
                                    $item[''] = 'Choose Item ';
                                ?>
                                <?php echo Form::select('item_id',$item,Input::old('item_id'),['id'=>'item_id','class' => 'form-control form-select js-example-basic-single','required'=>true,'disabled'=>true]); ?>

                            <?php endif; ?>
                        </div>

                        <div class="col-md-3" style="display: inherit;">
                            <button type="submit" class="btn btn-primary" id="Filter" style="height: 28px;width: 20%">
                                <span style="display: block;margin-top: -4px;"><i class="fas fa-search"></i></span>
                            </button>

                            <a href="<?php echo e(route('admin.valuewise.report')); ?>" title="Reset" class="btn btn-danger" style="height: 28px;width: 20%;margin-left: 2px;"><span  style="display: block;margin-top: -4px;"><i class="fas fa-redo-alt"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>

            <?php if(isset($survey)): ?>

                <div class="card" style="margin-bottom: 20px !important;">
                    <div class="card-header" style="font-size: 16px;font-weight: bold;">
                        <?php if(session()->get('locale') == 'en'): ?>
                            <?php echo e($survey->nameen); ?>

                        <?php else: ?>
                            <?php echo e($survey->namebn); ?>

                        <?php endif; ?>

                    </div>


                    <div class="card-body">
                        <div class="row" id="printThis">
                            <?php
                                if (isset($input) && $input['item_id'] == 'all'){
                                    $grid = 5;
                                }else{
                                    $grid = 12;
                                }
                            ?>
                            <h6 style="font-weight: bold;text-align: center;">Total Response: <?php echo e($totalResponse); ?></h6>
                            <?php if($totalResponse !=0): ?>
                                <div class="col-md-<?php echo e($grid); ?>">
                                    <div class="chartdiv" id="chartdiv"></div>
                                </div>

                                <?php if(isset($input) && $input['item_id'] == 'all'): ?>
                                    <div class="col-md-7">
                                        <div class="chartdiv" id="piediv"></div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>


                <?php $__env->startPush('PerPageCustomJs'); ?>



                        <script>

                            am5.ready(function () {
                                var root = am5.Root.new("chartdiv");

                                root.setThemes([
                                    am5themes_Animated.new(root)
                                ]);

                                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                    panX: true,
                                    panY: true,
                                    wheelX: "panX",
                                    wheelY: "zoomX"
                                }));

                                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                cursor.lineY.set("visible", false);

                                var xRenderer = am5xy.AxisRendererX.new(root, {minGridDistance: 30});
                                xRenderer.labels.template.setAll({
                                    rotation: -90,
                                    centerY: am5.p50,
                                    centerX: am5.p100,
                                    paddingRight: 15
                                });

                                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                    maxDeviation: 0.3,
                                    categoryField: "item",
                                    renderer: xRenderer,
                                    tooltip: am5.Tooltip.new(root, {})
                                }));

                                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                    maxDeviation: 0.3,
                                    min : 0,
                                    
                                    renderer: am5xy.AxisRendererY.new(root, {})
                                }));

                                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                    name: "Series 1",
                                    xAxis: xAxis,
                                    yAxis: yAxis,
                                    valueYField: "value",
                                    sequencedInterpolation: true,
                                    categoryXField: "item",
                                    tooltip: am5.Tooltip.new(root, {
                                        labelText: "{valueY}"
                                    })
                                }));

                                series.columns.template.setAll({
                                    tooltipText: "{valueY}",
                                    tooltipY: 0,
                                    showTooltipOn: "always",
                                    cornerRadiusTL: 5,
                                    cornerRadiusTR: 5
                                });

                                series.columns.template.setup = function(target) {
                                    target.set("tooltip", am5.Tooltip.new(root, {}));
                                }
                                series.columns.template.adapters.add("fill", (fill, target) => {
                                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                                });

                                series.columns.template.adapters.add("stroke", (stroke, target) => {
                                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                                });

                                var data = [<?php echo $data; ?>];


                                chart.get("colors").set("colors", [<?php echo $dataWithColor; ?>]);

                                /*var exporting = am5plugins_exporting.Exporting.new(root, {
                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                    pdfOptions: {
                                        pageSize: "LETTER",
                                        pageOrientation: "landscape",
                                        pageMargins: [20, 20, 20, 40]
                                    }
                                });*/
                                xAxis.data.setAll(data);
                                series.data.setAll(data);


                                series.appear(1000);
                                chart.appear(1000, 100);



                            });
                        </script>




                    <script>
                        am5.ready(function() {
                            var root = am5.Root.new("piediv");
                            root.setThemes([
                                am5themes_Animated.new(root),
                            ]);

                            var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                layout: root.verticalLayout
                            }));

                            // Define data
                            var data = [<?php echo $data;?>];

                            // Create series
                            var series = chart.series.push(
                                am5percent.PieSeries.new(root, {
                                    valueField: "value",
                                    categoryField: "item",
                                    disabled:true,
                                    // alignLabels: false,
                                    legendLabelText: "{item}",
                                    legendValueText: ""
                                })
                            );
                            series.labels.template.setAll({
                                text: "{item} {valuePercentTotal.formatNumber('0.00')}%",
                                textType: "circular",
                                radius: 10,
                                // fill: am5.color(0x000000),
                            });
                            series.get("colors").set("colors", [<?php echo $dataWithColor; ?>]);
                            /*series.slices.template.setAll({
                                // fillOpacity: 0.5,
                                stroke: am5.color(0xffffff),
                                strokeWidth: 2
                            });*/

                            /*var exporting = am5plugins_exporting.Exporting.new(root, {
                                menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                pdfOptions: {
                                    pageSize: "LETTER",
                                    pageOrientation: "landscape",
                                    pageMargins: [20, 20, 20, 40]
                                }
                            });*/

                            series.data.setAll(data);

                            // Add legend
                            /* var legend = chart.children.push(am5.Legend.new(root, {
                                 centerX: am5.percent(40),
                                 x: am5.percent(55),
                                 y: am5.percent(90),
                                 centerY: am5.percent(50),
                             }));*/

                            // legend.data.setAll(series.dataItems);
                            // series.appear(1000, 100);
                        });
                    </script>



                <?php $__env->stopPush(); ?>

            <?php endif; ?>


            <div style="height: 50px"></div>
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



<?php echo $__env->make(/** @lang text */'backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/shafiq/Sites/survey/resources/views/backend/admin/value-wise-report.blade.php ENDPATH**/ ?>