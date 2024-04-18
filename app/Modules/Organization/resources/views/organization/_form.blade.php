<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

$OrganizationFieldName =  __('Organization::message.OrganizationFieldName');
$OrganizationPlaceholder = __('Organization::message.OrganizationPlaceholder');
$Address = __('Organization::message.Address');
$AddressPlacehlder = __('Organization::message.AddressPlaceholder');
$Mobile = __('Organization::message.Mobile');
$MobilePlacehlder = __('Organization::message.MobilePlaceholder');
$Email = __('Organization::message.Email');
$EmailPlaceholder = __('Organization::message.EmailPlaceholder');
$Status = __('Organization::message.Status');
$ActiveStatus = __('Organization::message.Active');
$InctiveStatus = __('Organization::message.Inactive');
$Reset = __('Organization::message.Reset');
$Submit = __('Organization::message.Submit');
?>


<div class="row">


    <div class="form-group row">
        <div class="col-sm-2">
            {!! Form::label($OrganizationFieldName, $OrganizationFieldName, array('class' => 'col-form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::text('name',Input::old('name'),['id'=>'name','class' => 'form-control','data-checkify'=>'minlen=3,required','Placeholder' => $OrganizationPlaceholder,'aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('name') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($Address, $Address, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::textarea('address',Input::old('address'),['id'=>'address','data-checkify'=>'minlen=3,required','class' => 'form-control','Placeholder' => $AddressPlacehlder,'aria-label' =>'content','aria-describedby'=>'basic-addon2','rows'=>2]) !!}
            <span style="color: #ff0000">{!! $errors->first('address') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($Mobile,$Mobile, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::text('mobile',Input::old('mobile'),['id'=>'mobile','class' => 'form-control','data-checkify'=>'minlen=11,required,number,maxlen=11','Placeholder' => $MobilePlacehlder,'aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('mobile') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($Email,$Email, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::text('email',Input::old('email'),['id'=>'email','class' => 'form-control','Placeholder' => $EmailPlaceholder,'aria-label' =>'email','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('email') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($Status, $Status, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <?php
        $Active = '';
        $Inactive = '';
        if (isset($data->status)){
            if ($data->status == 1){
                $Active = 'checked="checked"';
            }else{
                $Inactive = 'checked="checked"';
            }
        }else{
            $Active = 'checked="checked"';
        }
        ?>

        <div class="col-sm-10">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inlineRadioActive" value="1" {{$Active}}>
                <label class="form-check-label" for="inlineRadioActive">{{$ActiveStatus}}</label>
            </div>
            <div class="form-check form-check-inline">
                <input  class="form-check-input" type="radio" name="status" id="inlineRadioInactive" value="0" {{$Inactive}}>
                <label class="form-check-label" for="inlineRadioInactive">{{$InctiveStatus}}</label>
            </div>
            <br>
            <span style="color: #ff0000">{!! $errors->first('status') !!}</span>
        </div>
    </div>

</div>




<div class="row">

    <div class="col-md-12" style="text-align: right;">
        <div class="from-group">
            <div class="">
                <button type="reset" class="btn submit-button">{{$Reset}}</button>
                <button type="submit" class="btn submit-button" id="OrganizationFormSubmit">{{$Submit}}</button>
            </div>
        </div>
    </div>

</div>
