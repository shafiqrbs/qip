@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">

{{--                            <a href="{{route('admin.configuration.create')}}" title="Add Configuration" class="module_button_header">--}}
{{--                                <button type="button" class="btn btn-sm btn-outline-secondary">--}}
{{--                                    <i class="fas fa-plus-circle"></i> Create New--}}
{{--                                </button>--}}
{{--                            </a>--}}



                            <?php
                            $TultipMessage = "Color Blue -> Edit Button(You can edit all info). Color yellow ->Remove button (You can remove data from this list). Color Red -> Parmanent Detele Button.";
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

                            @if(isset($AllConfiguration) && !empty($AllConfiguration))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered text-center" id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        <th>Language</th>
                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($AllConfiguration as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>
                                                    @if($value->language == 'en')
                                                    {{'English'}}
                                                    @else
                                                    {{'Bangla'}}
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{route('admin.configuration.edit',$value->id)}}" title="Edit Brand" class="text-primary"><i class="fas fa-user-edit"></i></a>
{{--                                                    <a href="{{route('admin.configuration.inactive',$value->id)}}" title="Remove From List" onclick="return confirm('Are you sure to remove from this list?')" class="text-warning"><i class="fas fa-ban"></i></a>--}}
{{--                                                    <a href="{{route('admin.configuration.delete',$value->id)}}" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>--}}

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $AllConfiguration->links('backend.layouts.pagination') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>


@endsection
