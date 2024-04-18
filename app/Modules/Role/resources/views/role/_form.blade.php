<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

//$OrganizationFieldName =  __('Organization::message.OrganizationFieldName');
//$OrganizationPlaceholder = __('Organization::message.OrganizationPlaceholder');
//$Address = __('Organization::message.Address');
//$AddressPlacehlder = __('Organization::message.AddressPlaceholder');
//$Mobile = __('Organization::message.Mobile');
//$MobilePlacehlder = __('Organization::message.MobilePlaceholder');
//$Email = __('Organization::message.Email');
//$EmailPlaceholder = __('Organization::message.EmailPlaceholder');
//$Status = __('Organization::message.Status');
//$ActiveStatus = __('Organization::message.Active');
//$InctiveStatus = __('Organization::message.Inactive');
//$Reset = __('Organization::message.Reset');
//$Submit = __('Organization::message.Submit');
?>


<div class="row">
    <div class="form-group row">
        <div class="col-sm-2">
            {!! Form::label('Role Name', 'Role Name', array('class' => 'col-form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::text('name',Input::old('name'),['id'=>'name','class' => 'form-control','data-checkify'=>'minlen=3,required','Placeholder' => 'Enter Role Name','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('name') !!}</span>
        </div>
    </div>

    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label('Permission', 'Permission', array('class' => 'col-form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10" style="text-align: justify;">
            @foreach($permission as $value)
                <ul class="untitle-list">
                    <li style="list-style: none;">
                        {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        <span style="margin-left: 5px;">{{$value->name}}</span>
                    </li>
                </ul>
            @endforeach
            <span style="color: #ff0000">{!! $errors->first('permission') !!}</span>
        </div>
    </div>


</div>




<div class="row">

    <div class="col-md-12" style="text-align: right;">
        <div class="from-group">
            <div class="">
                <button type="reset" class="btn submit-button">Reset</button>
                <button type="submit" class="btn submit-button" id="OrganizationFormSubmit">Submit</button>
            </div>
        </div>
    </div>

</div>

@push('CustomStyle')
    <style>
        .untitle-list{
            float: left;
            width: 30%;
        }
    </style>
@endpush
