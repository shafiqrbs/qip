@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">

{{--                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>--}}
                            @canany(['user-list'])
                            <a style="color: #000;" href="{{route('admin.user.index')}}" title="Add Size Unit" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-th-list"></i> User List
                                </button>
                            </a>@endcan

                            @canany(['user-create'])
                            <a style="color: #000;" href="{{route('admin.user.create')}}" title="Add Size Unit" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus-circle"></i> Create New
                                </button>
                            </a>
                            @endcan
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

                            {!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.user.update', $data->id],"class"=>"", 'id' => 'basic-form']) !!}

                            @include('User::user._form')

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
