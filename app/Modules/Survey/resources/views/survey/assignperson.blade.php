@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">

                            {!! Form::open(['method'=>'get','route'=>'admin.calendar.downloadexcel','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true]) !!}

                            @if(isset($input))
                                @if(isset($input['survey_id']))
                                    <input type="hidden" name="survey_id" value="{{$input['survey_id']}}">
                                @endif
                                @if(isset($input['month']))
                                    <input type="hidden" name="month" value="{{$input['month']}}">
                                @endif

                                @if(isset($input['year']))
                                    <input type="hidden" name="year" value="{{$input['year']}}">
                                @endif
                            @endif

                            <button name="calendar_person_download_excel" value="calendar_person_download_excel" type="submit" class="btn btn-sm btn-outline-secondary module_button_header">
                                <i class="fas fa-file-download"></i>  Download
                            </button>
                            {!! Form::close() !!}

                            <a style="color: #000;" href="{{route('admin.survey.index')}}" title="{{__('Organization::message.ListButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-th-list"></i> {{__('Survey::message.ListButton')}}
                                </button>
                            </a>
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
                    <div class="card" style="margin-bottom: 20px !important;">

                        <div class="card-header">
{{--                            {{$PageTitle.''}}--}}
                            @if(session()->get('locale') == 'en')
                                {{$survyName->nameen}}
                            @else
                                {{$survyName->namebn}}
                            @endif
                        </div>
                        <div class="card-body">
                            @include('backend.layouts.message')

                            {!! Form::open(['route' => 'admin.survey.calendarassign.search','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true, 'id'=>'basic-form', 'class' => '']) !!}
                            @include('Survey::survey._calenderassignperson')

                            {!! Form::close() !!}

                        </div>
                    </div>

                    @if(isset($surveyCompany) && isset($surveyExistsCount) && $surveyExistsCount == 0)
                    <div class="card">
                        <div class="card-header">
                            Survey Organization Calender form
                        </div>
                        <div class="card-body">
                            @include('backend.layouts.message')
                            <a data-href="{{route('admin.survey.calendarassign.store')}}" id="personStoreUrl"></a>

{{--                            {!! Form::open(['route' => 'admin.survey.calendarassign.search','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true, 'id'=>'basic-form', 'class' => '']) !!}--}}
                            @include('Survey::survey._calenderassignpersonform')

{{--                            {!! Form::close() !!}--}}

                        </div>
                    </div>
                    @endif


                    @if(isset($surveyCompany) && isset($surveyExistsCount) && $surveyExistsCount > 0)
                        <div class="card">
                            <div class="card-header">
                                Survey Organization Calender Update
                            </div>
                            <div class="card-body">
                                @include('backend.layouts.message')
                                <a data-href="{{route('admin.survey.calendarassign.store')}}" id="personStoreUrl"></a>

                                {{--                            {!! Form::open(['route' => 'admin.survey.calendarassign.search','enctype'=>'multipart/form-data', 'autocomplete'=>'off', 'files'=> true, 'id'=>'basic-form', 'class' => '']) !!}--}}
                                @include('Survey::survey._calenderassignpersonformupdate')

                                {{--                            {!! Form::close() !!}--}}

                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>


@endsection

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

        // Organization person data added
        $(document).delegate('#personNumber','keyup',function () {
            var personNumber = $(this).val();
            if (personNumber%1 == 0){
                var date = $(this).attr('date');
                var organizationId = $(this).attr('organizationId');
                var surveyId = $('#surveyId').val();
                var month = $('#month').val();
                var year = $('#year').val();
                var url = $('#personStoreUrl').attr('data-href');
                // alert(personNumber+' '+date+' '+organizationId+' '+surveyId+' '+month+' '+year+' '+url);
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    data: {personNumber: personNumber,date:date,organizationId:organizationId,surveyId:surveyId,month:month,year:year},
                    beforeSend: function( xhr ) {

                    }
                }).done(function( response ) {
                    console.log(response.insertMessage);
                    // alert(response.insertMessage);
                    // $('#add_more_attach_row').append(response.content);
                    // document.getElementById("MoreAttachment").setAttribute("sl-no",response.sl_no);

                    // alert(response);
                }).fail(function( jqXHR, textStatus ) {

                });
                return false;
            }else{
                Swal.fire({
                    title: 'Person must be integer',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    },
                    icon:'question',
                    // showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                })
                return false;
            }

        });


    </script>
@endpush

