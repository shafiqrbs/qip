@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">

{{--                        <a style="color: #000;" href="{{route('admin.user.index')}}" title="User List" class="module_button_header">--}}
{{--                            <button type="button" class="btn btn-sm btn-outline-secondary">--}}
{{--                            <i class="fas fa-th-list"></i> User List--}}
{{--                            </button>--}}
{{--                        </a>--}}

                        <?php
                        $TultipMessage = "All field must be required (Without address) - Fillup all field with proper data, Mobile contain 11 digit & Provide Valid, Unique Email."
                        ?>

                        <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                           title="{{$TultipMessage}}">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-question-circle"></i> Hints
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
                    {{$PageTitle}}
                </div>
                <div class="card-body">

                    @include('backend.layouts.message')

                    {!! Form::open(['route' => 'update.user.password','autocomplete'=>'off','enctype'=>'multipart/form-data',  'files'=> true, 'id'=>'basic-form', 'class' => '']) !!}

                    <?php
                    use Illuminate\Support\Facades\URL;
                    use Illuminate\Support\Facades\Input;
                    ?>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="from-group row">
                                <div class="col-md-6">
                                        {!! Form::label('New Password', 'New Password', array('class' => 'form-label')) !!}
                                        <span style="color: red">*</span>
                                    <div class="input-group mb-3">
                                        <div class="form-control-plaintext">
                                                {!! Form::text('password',Input::old('password'),['id'=>'password','class' => 'form-control','Placeholder' => 'Enter new password','aria-label' =>'email','aria-describedby'=>'basic-addon2']) !!}
                                        </div>
                                        <span style="color: #ff0000">{!! $errors->first('password') !!}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    {!! Form::label('Confirm Password', 'Confirm Password', array('class' => 'form-label')) !!}
                                    <span style="color: red">*</span>
                                    <div class="input-group mb-3">
                                        <div class="form-control-plaintext">
                                                {!! Form::text('confirmed',Input::old('confirmed'),['id'=>'confirmed','class' => 'form-control','Placeholder' => 'Enter confirm password','aria-label' =>'email','aria-describedby'=>'basic-addon2']) !!}
                                        </div>
                                        <span style="color: #ff0000">{!! $errors->first('confirmed') !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>





                    <div class="row">

                        <div class="col-md-12" style="text-align: right;">
                            <div class="from-group">
                                <div class="">
                                    <button type="submit" class="btn submit-button" id="UserFormSubmit">Submit</button>
                                </div>
                            </div>
                        </div>

                    </div>


                    {!! Form::close() !!}

                </div>
                </div>
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

    </script>
@endpush
