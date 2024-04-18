@extends(/** @lang text */'backend.layouts.master')

@section('body')

    @push('CustomStyle')

    @endpush

    @push('PerPageCustomJs')

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
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Input;
    ?>
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            {!! Form::open(['method'=>'get','route'=>'admin.surveyresult.downloadCSV','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true]) !!}

                            @if(isset($input))
                                @php
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
                                @endphp
                                @if(isset($input['startdate']))
                                    <input type="hidden" name="startdate" value="{{$startDate}}">
                                    <input type="hidden" name="enddate" value="{{$enddate}}">
                                @endif

                                @if(isset($input['survey_id']))
                                    <input type="hidden" name="survey_id" value="{{$input['survey_id']}}">
                                @endif

                                @if(isset($input['item_id']))
                                    <input type="hidden" name="item_id" value="{{$input['item_id']}}">
                                @endif

                                @if(isset($input['device_id']))
                                    <input type="hidden" name="device_id" value="{{$input['device_id']}}">
                                @endif
{{--                                @if(isset($input['user_id']))--}}
{{--                                    <input type="hidden" name="user_id" value="{{$input['user_id']}}">--}}
{{--                                @endif--}}

                                @if(isset($input['organization_id']))
                                    <input type="hidden" name="organization_id" value="{{$input['organization_id']}}">
                                @endif
                            @endif

                            @canany(['result-download'])
                                <button name="survey_result_download_excel" value="survey_result_download_excel" type="submit" class="btn btn-sm btn-outline-secondary module_button_header">
                                    <i class="fas fa-file-download"></i>  Excel
                                </button>
                                <button name="survey_result_download_pdf" value="survey_result_download_pdf" type="submit" class="btn btn-sm btn-outline-secondary module_button_header">
                                    <i class="fas fa-file-download"></i>  Pdf
                                </button>
                            @endcan
                            {!! Form::close() !!}


                            {{--                            <a href="{{route('admin.surveyresult.create')}}" title="{{__('Survey::message.CreateButton')}}" class="module_button_header">--}}
{{--                                <button type="button" class="btn btn-sm btn-outline-secondary">--}}
{{--                                    <i class="fas fa-plus-circle"></i>  {{__('SurveyResult::message.CreateButton')}}--}}
{{--                                </button>--}}
{{--                            </a>--}}


                            <?php
                            $TultipMessage = __('SurveyResult::message.HintsMsg');
                            ?>

                            <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                               title="{{$TultipMessage}}">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-question-circle"></i> {{__('SurveyResult::message.Hints')}}
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
                            {{$TableTitle}}
                        </div>
                        <div class="card-body">
                            @include('backend.layouts.message')

                            @if(isset($allSurveyResults) && !empty($allSurveyResults))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered table-sm" id="table_id">
                                        <thead>
                                        {!! Form::open(['method'=>'get','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true]) !!}
                                        <tr style="background-color: #d5d5d5;">
                                            <th colspan="3" style="vertical-align: middle;">
                                                Survey
                                                <a data-href="{{route('admin.surveywise.item')}}" class="itemRoute"></a>
                                                @if(isset($input['survey_id']) && !empty($input['survey_id']))
                                                    {!! Form::select('survey_id',$surveySelect,$input['survey_id'],['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single']) !!}
                                                @else
                                                    {!! Form::select('survey_id',$surveySelect,Input::old('survey_id'),['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single']) !!}
                                                @endif
                                            </th>
                                            <th colspan="1" style="vertical-align: middle;">
                                                Item
                                                @if(isset($input['item_id']) && !empty($input['item_id']))
                                                    {!! Form::select('item_id',$surveyItem,$input['item_id'],['id'=>'item_id','class' => 'form-control form-select js-example-basic-single','required'=>true]) !!}
                                                @else
                                                    @php
                                                        $item[''] = 'Choose Item';
                                                    @endphp
                                                    {!! Form::select('item_id',$item,Input::old('item_id'),['id'=>'item_id','class' => 'form-control form-select js-example-basic-single','disabled'=>true]) !!}
                                                @endif
                                            </th>


@if(Auth::user()->hasRole('ADMINISTRATOR') || Auth::user()->hasRole('ADMIN_REPORTER') || Auth::user()->hasRole('ADMIN_OPERATOR'))
                                            <th colspan="1" style="vertical-align: middle;">
                                                Device ID
                                                @if(isset($input['device_id']))
                                                {!! Form::text('device_id',$input['device_id'],['id'=>'device_id','class' => 'form-control','style'=>'height:28px']) !!}
                                                @else
                                                    {!! Form::text('device_id',Input::old('device_id'),['id'=>'device_id','class' => 'form-control','style'=>'height:28px']) !!}
                                                @endif
                                            </th>
                                            @endif

                                            <th colspan="2" style="vertical-align: middle;">
                                                Organization
                                                @if(isset($input['organization_id']))
                                                {!! Form::select('organization_id',$selectOrganization,$input['organization_id'],['id'=>'organization_id','class' => 'form-control form-select js-example-basic-single','style'=>'height:28px']) !!}
                                                @else
                                                    {!! Form::select('organization_id',$selectOrganization,Input::old('organization_id'),['id'=>'organization_id','class' => 'form-control form-select js-example-basic-single','style'=>'height:28px']) !!}
                                                @endif
{{--                                                User--}}
{{--                                                @if(isset($input['user_id']))--}}
{{--                                                {!! Form::select('user_id',$selectUser,$input['user_id'],['id'=>'user_id','class' => 'form-control form-select js-example-basic-single','style'=>'height:28px']) !!}--}}
{{--                                                @else--}}
{{--                                                    {!! Form::select('user_id',$selectUser,Input::old('user_id'),['id'=>'user_id','class' => 'form-control form-select js-example-basic-single','style'=>'height:28px']) !!}--}}
{{--                                                @endif--}}
                                            </th>

                                            <th style="vertical-align: middle;">
                                                Start Date
                                                @if(isset($input['startdate']) && !empty($input['startdate']))
                                                    @php
                                                        $startDate = $input['startdate'];
                                                        $startDate = date("d-m-Y", strtotime($startDate));
                                                    @endphp
                                                    {{ Form::date('startdate',date('Y-m-d', strtotime($startDate)),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px']) }}
                                                @else
                                                    {{ Form::date('startdate',Input::old(date('Y-m-d')),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px']) }}
                                                @endif
                                            </th>

                                            <th style="vertical-align: middle;">
                                                End Date
                                                @if(isset($input['enddate']) && !empty($input['enddate']))
                                                    <?php
                                                    $enddate = $input['enddate'];
                                                    $enddate = date("d-m-Y", strtotime($enddate));
                                                    ?>
                                                    {{ Form::date('enddate', date('Y-m-d', strtotime($enddate)),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px','placeholder'=>'Start Date']) }}
                                                @else
                                                    {{ Form::date('enddate',Input::old(date('Y-m-d')),['id'=>'ref_date','class' => 'form-control','style'=>'height:28px']) }}
                                                @endif
                                            </th>

                                            <th style="text-align: center;vertical-align: middle;" colspan="2">
                                                <br>
                                                    <button name="survey_result_search_form_submit" value="survey_result_search_form_submit" type="submit" class="btn btn-primary" id="Filter" style="height: 28px;width: 20%">
                                                        <span style="display: block;margin-top: -4px;margin-left: -7px;"><i class="fas fa-search"></i></span>
                                                    </button>

                                                    <a href="{{route('admin.surveyresult.index')}}" title="Reset" class="btn btn-danger" style="height: 28px;width: 20%;margin-left: 2px;"><span  style="display: block;margin-top: -4px;margin-left: -7px;"><i class="fas fa-redo-alt"></i></span>
                                                    </a>
                                            </th>
{{--                                            <th></th>--}}
                                        </tr>
                                        {!! Form::close() !!}


                                        <tr>
                                        <th>SL</th>
                                        <th>Survey Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
{{--                                        <th>Value</th>--}}
                                            @if(Auth::user()->hasRole('ADMINISTRATOR'))
                                        <th>Device ID</th>
                                            @endif
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Item</th>
                                        <th>Organization</th>
                                            @if(Auth::user()->hasRole('ADMINISTRATOR'))
                                        <th>User</th>
                                            @endif
{{--                                        <th>Status</th>--}}
{{--                                            @if(Auth::user()->hasRole('ADMINISTRATOR'))--}}
                                        <th>Action</th>
{{--                                            @endif--}}
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($allSurveyResults as $value)
                                            <tr>
                                                <td>{{$i++}}</td>

                                                <td>{{$value->SurveyName->nameen}}</td>
                                                <td>{{$value->created_at->format('d-m-Y')}}</td>
                                                <td>{{$value->created_at->format('h:i:s A')}}</td>
{{--                                                <td>{{$value->survey_value}}</td>--}}
                                                @if(Auth::user()->hasRole('ADMINISTRATOR'))
                                                <td>{{$value->device_id}}</td>
                                                @endif
                                                <td>{{$value->latitude}}</td>
                                                <td>{{$value->longitude}}</td>
                                                <td>{{$value->SurveyItem->itemtexten}}</td>
                                                <td>{{$value->SurveyOrganization->name}}</td>
                                                @if(Auth::user()->hasRole('ADMINISTRATOR'))
                                                <td>{{$value->SurveyUser->name}}</td>
                                                @endif
{{--                                                <td>--}}
{{--                                                    <?php--}}
{{--                                                    if (isset($value) && ($value->status == 1)){--}}
{{--                                                        $checked = 'checked';--}}
{{--                                                        $CheckValue = 0;--}}
{{--                                                    }else{--}}
{{--                                                        $checked = '';--}}
{{--                                                        $CheckValue = 1;--}}
{{--                                                    }--}}
{{--                                                    ?>--}}
{{--                                                    <div class="form-check form-switch">--}}
{{--                                                        <input class="form-check-input isChecked setvalue{{$value->id}}" type="checkbox" style="text-align: center" id="flexSwitchCheckChecked" {{$checked}} dbTable = 'sur_survey_result' value="{{$CheckValue}}" data-id="{{$value->id}}" data-href="{{route('admin.status.change')}}" onchange="getCheckboxValue(this.value,this.data-id)">--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
                                                @if(Auth::user()->hasRole('ADMINISTRATOR'))
                                                <td>

{{--                                                    @if(Auth::user()->hasRole('Admin'))--}}
                                                        <span class="allbutton{{$value->id}}">

                                                        @if(isset($value) && ($value->status == 1))
                                                                @canany(['result-edit'])
                                                        <a href="{{route('admin.surveyresult.edit',$value->id)}}" title="Edit Survey" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
                                                                @endcan
{{--                                                                @canany(['result-delete'])--}}
{{--                                                        <a href="{{route('admin.surveyresult.inactive',$value->id)}}" title="Delete From List" onclick="return confirm('Are you sure to remove from this list?')" class="text-warning"><i class="fas fa-ban"></i></a>--}}
{{--                                                                @endcan--}}
                                                                    @canany(['result-delete'])
                                                        <a href="{{route('admin.surveyresult.delete',$value->id)}}" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                                                @endcan

                                                            @endif
                                                        </span>
{{--                                                    @endif--}}
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $allSurveyResults->appends(request()->query())->links('backend.layouts.pagination') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>


@endsection

@push('PerPageCustomJs')
    {{--   script for bar graph start  --}}
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
@endpush
