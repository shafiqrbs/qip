@extends(/** @lang text */'backend.layouts.master')

@section('body')
    <div class="dashboard-area">
        <div id="carbon-block" class="">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h4">{{$ModuleTitle}}</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            @canany(['user-create'])
                        <a style="color: #000;" href="{{route('admin.user.create')}}" title="{{__('User::message.CreateButton')}}" class="module_button_header">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-plus-circle"></i> {{__('User::message.CreateButton')}}
                            </button>
                        </a>@endcan
                        <?php
                        $TultipMessage = __('User::message.HintsMsg');
                        ?>
                        <a href="#" data-bs-toggle="tooltip"  class="module_button_header"
                           title="{{$TultipMessage}}">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-question-circle"></i> {{__('User::message.Hints')}}
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

{{--                            @can('role-create')--}}
{{--                                raju--}}
{{--                            @endcan--}}

{{--                            @if(auth()->user()->hasRole('Admin'))--}}
{{--                                adfdaf--}}
{{--                            @endif--}}
                        </div>
                        <div class="card-body">

<?php
//  $permissionNames = Auth::user()->getPermissionNames();
//  $permissions = Auth::user()->getRoleNames();
//  dd($permissions);
?>
                            @include('backend.layouts.message')

                            @if(isset($all_user) && !empty($all_user))
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered text-center" id="table_id">
                                        <thead>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Organization</th>
                                        <th>Role</th>
{{--                                        <th style="width: 158.047px;">Image</th>--}}
                                        <th>Status</th>
                                        <th>Action</th>
                                        </thead>

                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($all_user as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>{{$value->mobile}}</td>
                                                <td>{{$value->email}}</td>
                                                <td>

                                                        @if($value->hasRole('ADMINISTRATOR') || $value->hasRole('ADMIN_REPORTER') || $value->hasRole('ADMIN_OPERATOR'))
{{--                                                            {{'Gain Bangladesh'}}--}}
                                                        @else
                                                            {{$value->UserOrganization->name}}
                                                        @endif
                                                </td>
                                                <td>
{{--                                                    @foreach( as $role)--}}
                                                        {{$value->getRoleNames()}}
{{--                                                    @endforeach--}}
                                                </td>
{{--                                                <td>--}}
{{--                                                    <div class="tooltipme">Image--}}
{{--                                                        <span class="tooltipmetext">--}}
{{--                                                            <?php--}}
{{--                                                                if (isset($value->user_image) && !empty($value->user_image)){--}}
{{--                                                                    $image = $value->user_image;--}}
{{--                                                                }else{--}}

{{--                                                                }--}}
{{--                                                            ?>--}}
{{--                                                                <img class="hover_image" src="{{ asset('backend/image/UserImage').'/'.$value->user_image}}" alt="{{$value->name}}">--}}

{{--                                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
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
                                                        <input class="form-check-input isChecked setvalue{{$value->id}}" type="checkbox" style="text-align: center" id="flexSwitchCheckChecked" {{$checked}} dbTable = 'users' value="{{$CheckValue}}" data-id="{{$value->id}}" data-href="{{route('admin.status.change')}}" onchange="getCheckboxValue(this.value,this.data-id)">
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
                                                        @canany(['user-edit'])
                                                    <a href="{{route('admin.user.edit',$value->id)}}" title="Edit User Info" class="text-primary"><i class="fas fa-user-edit"></i></a>@endcan
{{--                                                    <a href="{{route('admin.user.inactive',$value->id)}}" title="Delete From List" onclick="return confirm('Are you sure to remove from this list?')" class="text-warning"><i class="fas fa-ban"></i></a>--}}
                                                        @canany(['user-delete'])
                                                    <a href="{{route('admin.user.delete',$value->id)}}" title="Delete User Info" onclick="return confirm('Are you sure to Delete?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>@endcan
{{--                                                    @endif--}}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" justify-content-right">
                                    {{ $all_user->links('backend.layouts.pagination') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>


@endsection
