@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            @canany(['role-create'])
                            <a href="{{route('admin.role.create')}}" title="{{__('Organization::message.CreateButton')}}" class="module_button_header">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus-circle"></i>  {{__('Organization::message.CreateButton')}}
                                </button>
                            </a>
                            @endcan


                            <?php
                            $TultipMessage = __('Organization::message.HintsMsg');
                            ?>

                            <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                               title="{{$TultipMessage}}">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-question-circle"></i> {{__('Organization::message.Hints')}}
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

                            @if(isset($roles) && !empty($roles))
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table_id">

                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Permissions</th>
                                            <th>Action</th>
                                        </tr>

                                        @php
                                            $i = 1;
                                        @endphp

                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @foreach ($role->permissions as $perm)
                                                        <span class="badge bg-primary" style="margin-bottom: 5px;">
                                                        {{ $perm->name }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>

                                                    @can(['role-edit'])
                                                        <a href="{{route('admin.role.edit',$role->id)}}" title="Edit Role" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
                                                    @endcan
                                                        @canany(['role-delete'])
                                                    <a href="{{route('admin.role.delete',$role->id)}}" title="Permanent Delete" onclick="return confirm('Are you sure to Permanent Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                                        @endcan

                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </table>
                                </div>
                                <div class=" justify-content-right" style="margin-top: 20px;text-align: end;display: inline;">
                                    {{ $roles->links('backend.layouts.pagination') }}
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
