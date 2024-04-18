@extends(/** @lang text */'backend.layouts.master')

@section('body')
    @push('CustomStyle')
        <style>
            .chartdiv {
                width: 100%;
                height: 300px;
            }
        </style>
    @endpush

    @push('PerPageCustomJs')
        <script src="{{ asset('backend/amchartjs/index.js') }}"></script>
        <script src="{{ asset('backend/amchartjs/xy.js') }}"></script>
        <script src="{{ asset('backend/amchartjs/percent.js') }}"></script>
        <script src="{{ asset('backend/amchartjs/animated.js') }}"></script>
        <script src="{{ asset('backend/amchartjs/exporting.js') }}"></script>

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
    @endpush

    <?php
    use App\Modules\SurveyResult\Models\SurveyResult;
    use App\Modules\SurveyItem\Models\SurveyItem;

    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
    <div class="dashboard-area" {{session()->get('locale')}}>

        <div id="carbon-block">

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h4">Dashboard</h2>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        {{--                        <div class="btn-group me-2">--}}


                        {{--                            <button type="button" id="printbutton" class="btn btn-sm btn-outline-secondary">print</button>--}}
                        {{--                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>--}}
                        {{--                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>--}}
                        {{--                        </div>--}}
                        {{--                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">--}}
                        {{--                            <span data-feather="calendar"></span>--}}
                        {{--                            This week--}}
                        {{--                        </button>--}}

                    </div>
                </div>
            </main>

            <?php
                if (isset($searchDate)){
                    $searchDate = $searchDate;
                    $searchDate = date("d-m-Y", strtotime($searchDate));
                }else{
                    $searchDate = date('d-m-Y');
                }
            ?>


            {!! Form::open(['route' => 'admin.surveygraph.filter','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true]) !!}
            <div class="card" style="margin-bottom: 20px !important;">
{{--                <div class="card-header" style="font-size: 16px;font-weight: bold;">--}}
{{--                    Filter--}}
{{--                </div>--}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @if(isset($searchDate))
                                {{ Form::date('date',date('Y-m-d', strtotime($searchDate)),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px']) }}
                            @else
                                {{ Form::date('date',Input::old(date('Y-m-d')),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px']) }}
                            @endif
                        </div>

@if(Auth::user()->hasRole('ADMIN_OPERATOR') || Auth::user()->hasRole('ADMIN_REPORTER') || Auth::user()->hasRole('ADMINISTRATOR'))
                        <div class="col-md-3">
                            {{--                            <a data-href="{{route('admin.surveywise.item')}}" class="itemRoute"></a>--}}
                            @if(isset($organization_id))
                                {!! Form::select('organization_id',$selectOrganization,$organization_id,['id'=>'organization_id','class' => 'form-control form-select js-example-basic-single']) !!}
                            @else
                                {!! Form::select('organization_id',$selectOrganization,Input::old('organization_id'),['id'=>'organization_id','class' => 'form-control form-select js-example-basic-single']) !!}
                            @endif
                        </div>
                        @endif

                        <div class="col-md-3">
{{--                            <a data-href="{{route('admin.surveywise.item')}}" class="itemRoute"></a>--}}
                            @if(isset($survey_id))
                                {!! Form::select('survey_id',$surveySelect,$survey_id,['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single']) !!}
                            @else
                                {!! Form::select('survey_id',$surveySelect,Input::old('survey_id'),['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single']) !!}
                            @endif
                        </div>

                        <div class="col-md-3" style="display: inherit;">
                            <button type="submit" class="btn btn-primary" id="Filter" style="height: 28px;width: 20%">
                                <span style="display: block;margin-top: -4px;"><i class="fas fa-search"></i></span>
                            </button>

                            <a href="{{route('admin-dashboard')}}" title="Reset" class="btn btn-danger" style="height: 28px;width: 20%;margin-left: 2px;"><span  style="display: block;margin-top: -4px;"><i class="fas fa-redo-alt"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}



            <?php
                $index = 1;
//                dd($surveyInfo);
            ?>
            @foreach($surveyInfo as $survey)

                <?php
//                    dd($survey);
                if (Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
                    $surveyID = $survey->survey_id;
                }elseif(isset($organization_id) && !empty($organization_id)){
                    $surveyID = $survey->survey_id;
                }
                else{
                    $surveyID = $survey->id;
                }
//                dump($surveyID);
                $surveyItems = SurveyItem::where('survey_id',$surveyID)->where('status',1)->get();

                $userInfo = DB::table('users')->where('id',\Illuminate\Support\Facades\Auth::id())->select('organization_id')->first();

                $surveyResult = SurveyResult::select([
                    DB::raw('count(sur_survey_result.id) as total'),
                    'sur_item.id as surveyItemId',
                    'sur_item.itemtexten',
                    'sur_item.itemtextbn',
                    'sur_item.color_code',
                ])
//                        ->join('sur_survey', 'sur_survey_result.survey_id', '=', 'sur_survey.id')
                    ->join('sur_item', 'sur_survey_result.item_id', '=', 'sur_item.id')
//                        ->join('sur_survey_organization_person', 'sur_survey_organization_person.survey_id', '=', 'sur_survey.id')
                    ->where('sur_survey_result.date', $searchDate)
                    ->groupBy('sur_survey_result.item_id')
                    ->where('sur_survey_result.survey_id', $surveyID);
                if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
                    $surveyResult->where('organization_id',$userInfo->organization_id);
                }
                if (isset($organization_id) && !empty($organization_id)){
                    $surveyResult->where('organization_id',$organization_id);
                }

                $surveyResult=$surveyResult->get();

                $totalResponse = SurveyResult::where('sur_survey_result.date', $searchDate);

                if(Auth::user()->hasRole('ORGANIZATION_ADMIN') || Auth::user()->hasRole('ORGANIZATION_OPERATOR') || Auth::user()->hasRole('ORGANIZATION_REPORTER')){
                    $totalResponse->where('organization_id',$userInfo->organization_id);
                    $totalResponse->where('sur_survey_result.survey_id', $surveyID);
                }
                if (isset($organization_id) && !empty($organization_id)){
                    $totalResponse->where('organization_id',$organization_id);
                }

                if(Auth::user()->hasRole('ADMINISTRATOR') || Auth::user()->hasRole('ADMIN_OPERATOR') || Auth::user()->hasRole('ADMIN_REPORTER')){
                    $totalResponse->where('sur_survey_result.survey_id', $surveyID);
                }

                if (isset($survey_id) && !empty($survey_id)){
                    $totalResponse->where('sur_survey_result.survey_id', $surveyID);
                }
                $totalResponse=$totalResponse->count();

                $arraySurveyArray=[];
                foreach ($surveyResult as $value) {
                    $arraySurveyArray[$value->surveyItemId]=$value;
                }
                $data = '';
                $dataWithColor = '';

                if($surveyItems){
                    foreach ($surveyItems as $item){
                        if(isset($arraySurveyArray[$item->id])){
                            $dataWithColor.='am5.color(0x'.$item->color_code.'),';
                            if (session()->get('locale') == 'en') {
                                $data .= "{ item:'" . $arraySurveyArray[$item->id]->itemtexten . "', value:" . $arraySurveyArray[$item->id]->total . "}, ";
                            } else {
                                $data .= "{ item:'" . $arraySurveyArray[$item->id]->itemtextbn . "', value:" . $arraySurveyArray[$item->id]->total . "}, ";
                            }

                        }else{
                            if (session()->get('locale') == 'en') {
                                $data .= "{ item:'" . $item->itemtexten . "', value:0}, ";
                            } else {
                                $data .= "{ item:'" . $item->itemtextbn . "', value:0}, ";
                            }
                        }
                    }
                }
                $data = substr($data, 0, -2);
                ?>
            @if($totalResponse>0)
                <div class="card" style="margin-bottom: 20px !important;">
                    <div class="card-header" style="font-size: 16px;font-weight: bold;">
                        @if(session()->get('locale') == 'en')
                            {{$survey->nameen}}

                        @else
                            {{$survey->namebn}}
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <h6 style="font-weight: bold;text-align: center;">Total Response: {{$totalResponse}}</h6>
                            @if(count($surveyResult)>0)
                            <div class="col-md-5">
                                <div class="chartdiv" id="chartdiv-{{$survey->id}}">

                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="chartdiv" id="piediv-{{$survey->id}}">

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

                <?php
                $index++;
                ?>
                    @endif
                @if(count($surveyResult)>0)
                @push('PerPageCustomJs')
{{--   script for bar graph start  --}}
                        <script>
                            am5.ready(function () {
                                var root = am5.Root.new("chartdiv-{{$survey->id}}");

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
                                    {{--max : <?php echo $maxPerson;?>,--}}
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


                                chart.get("colors").set("colors", [{!! $dataWithColor !!}]);


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

{{--  Bar graph end    --}}

{{--  pie chart start   --}}
                    <script>
                        am5.ready(function() {
                            var root = am5.Root.new("piediv-{{$survey->id}}");
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
                            series.get("colors").set("colors", [{!! $dataWithColor !!}]);
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
{{--    pie chart end     --}}
                @endpush
                @endif

            @endforeach
            <div style="height: 50px"></div>
        </div>
    </div>
@endsection


