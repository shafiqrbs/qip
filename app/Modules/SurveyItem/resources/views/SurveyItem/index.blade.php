@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            @canany(['item-create'])
                            <a href="{{route('admin.surveyitem.create')}}" title="{{__('Organization::message.CreateButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus-circle"></i>  {{__('SurveyItem::message.CreateButton')}}
                                </button>
                            </a>
                            @endcan


                            <?php
                            $TultipMessage = __('SurveyItem::message.HintsMsg');
                            ?>

                            <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                               title="{{$TultipMessage}}">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-question-circle"></i> {{__('SurveyItem::message.Hints')}}
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

                            @if(isset($allSurveyItem) && !empty($allSurveyItem))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered " id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        @if(session()->get('locale') == 'bn')
                                            <th>Survey Name Bn</th>
                                            <th>Item Text Bn</th>
{{--                                            <th>Item Value Bn</th>--}}
                                        @endif

                                        @if(session()->get('locale') == 'en')
                                            <th>Survey Name En</th>
                                            <th>Item Text En</th>
{{--                                            <th>Item Value En</th>--}}
                                        @endif

                                        <th>Status</th>

                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($allSurveyItem as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                @if(session()->get('locale') == 'bn')
                                                    <td>{{$value->SurveyName->namebn}}</td>
                                                    <td>{{$value->itemtextbn}}</td>
{{--                                                    <td>{{$value->itemvaluebn}}</td>--}}
                                                @endif
                                                @if(session()->get('locale') == 'en')
                                                    <td>{{$value->SurveyName->nameen}}</td>
                                                    <td>{{$value->itemtexten}}</td>
{{--                                                    <td>{{$value->itemvalueen}}</td>--}}
                                                @endif

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
                                                        <input class="form-check-input isChecked setvalue{{$value->id}}" type="checkbox" style="text-align: center" id="flexSwitchCheckChecked" {{$checked}} dbTable = 'sur_item' value="{{$CheckValue}}" data-id="{{$value->id}}" data-href="{{route('admin.status.change')}}" onchange="getCheckboxValue(this.value,this.data-id)">
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

{{--                                                    @if(isset($value) && ($value->status == 1))--}}
                                                        @canany(['item-edit'])
                                                    <a href="{{route('admin.surveyitem.edit',$value->id)}}" title="Edit Survey Item" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        @endcan
{{--                                                    <a href="{{route('admin.surveyitem.inactive',$value->id)}}" title="Delete From List" onclick="return confirm('Are you sure to remove from this list?')" class="text-warning"><i class="fas fa-ban"></i></a>--}}
                                                        @canany(['item-delete'])
                                                    <a href="{{route('admin.surveyitem.delete',$value->id)}}" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                                        @endcan
{{--                                                    @endif--}}
                                                                                                            </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $allSurveyItem->links('backend.layouts.pagination') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>


@endsection
