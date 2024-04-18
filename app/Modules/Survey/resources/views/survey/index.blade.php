@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            @canany(['survey-create'])
                            <a href="{{route('admin.survey.create')}}" title="{{__('Survey::message.CreateButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus-circle"></i>  {{__('Survey::message.CreateButton')}}
                                </button>
                            </a>
                            @endcan


                            <?php
                            $TultipMessage = __('Survey::message.HintsMsg');
                            ?>

                            <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                               title="{{$TultipMessage}}">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-question-circle"></i> {{__('Survey::message.Hints')}}
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

                            @if(isset($allSurvey) && !empty($allSurvey))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered" id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        @if(session()->get('locale') == 'en')
                                            <th>Name En</th>

                                            <th style="width: 45%;">Discription En</th>

                                        @endif

                                        @if(session()->get('locale') == 'bn')
                                            <th>Name Bn</th>
                                            <th style="width: 45%;">Discription Bn</th>
                                        @endif

                                        <th>Mode</th>
                                        <th>Ogranization</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($allSurvey as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                @if(session()->get('locale') == 'en')
                                                    <td>{{$value->nameen}}</td>
                                                    <td>{{$value->discriptionen}}</td>
                                                @endif

                                                @if(session()->get('locale') == 'bn')
                                                    <td>{{$value->namebn}}</td>
                                                    <td>{{$value->discriptionbn}}</td>
                                                @endif

                                                <td>{{$value->mode}}</td>
                                                <td>
                                                    @php $org = 1;$totalOrg = count($value->SurveyOrganization($value->id));@endphp
                                                    @foreach($value->SurveyOrganization($value->id) as $ograValue)
                                                        @if($totalOrg == $org)
                                                            {{$ograValue->name}}
                                                        @else
                                                            {{$ograValue->name.' , '}}
                                                        @endif
                                                        @php $org++; @endphp
                                                    @endforeach
                                                </td>

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
                                                        <input class="form-check-input isChecked setvalue{{$value->id}}" type="checkbox" style="text-align: center" id="flexSwitchCheckChecked" {{$checked}} dbTable = 'sur_survey' value="{{$CheckValue}}" data-id="{{$value->id}}" data-href="{{route('admin.status.change')}}" onchange="getCheckboxValue(this.value,this.data-id)">
                                                    </div>
                                                </td>
                                                <td>
                                                    @php
                                                        if ($value->status == 1){
                                                            $style = '';
                                                        }else{
                                                            $style = 'display:none';
                                                        }
                                                    @endphp
                                                        <span class="allbutton{{$value->id}}" style="{{$style}}">

{{--@if(isset($value) && ($value->status == 1))--}}
                                                            @canany(['survey-calendar'])
<a href="{{route('admin.survey.organization.assignperson',$value->id)}}" title="Survey Calendar" class="text-primary"><i class="fas fa-calendar-plus"></i></a>
                                                            @endcan

@canany(['survey-edit'])
<a href="{{route('admin.survey.edit',$value->id)}}" title="Edit Survey" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
@endcan
{{--                                                    <a href="{{route('admin.survey.inactive',$value->id)}}" title="Delete From List" onclick="return confirm('Are you sure to remove from this list?')" class="text-warning"><i class="fas fa-ban"></i></a>--}}
                                                            @canany(['survey-delete'])
<a href="{{route('admin.survey.delete',$value->id)}}" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                                            @endcan
{{--@endif--}}
                                                        </span>



                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $allSurvey->links('backend.layouts.pagination') }}
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

@endpush
