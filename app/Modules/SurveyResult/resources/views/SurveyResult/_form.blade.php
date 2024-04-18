<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
$SurveyFieldName =  __('Survey::message.SurveyName');
$SurveyValueName =  __('SurveyResult::message.SurveyValue');
$SurveyValuePlaceholder = __('SurveyResult::message.SurveyValuePlaceholder');
$OrganizationName = __('SurveyResult::message.OrganizationName');
$ItemName = __('SurveyResult::message.ItemName');
$deviceID = __('SurveyResult::message.deviceID');
$longitude = __('SurveyResult::message.longitude');
$latitude = __('SurveyResult::message.latitude');
$longitudePlaceholder = __('SurveyResult::message.longitudePlaceholder');
$latitudePlaceholder = __('SurveyResult::message.latitudePlaceholder');
$deviceIDPlaceholder = __('SurveyResult::message.deviceIDPlaceholder');

$Status = __('SurveyResult::message.Status');
$ActiveStatus = __('SurveyResult::message.Active');
$InctiveStatus = __('SurveyResult::message.Inactive');
$Reset = __('SurveyResult::message.Reset');
$Submit = __('SurveyResult::message.Submit');
?>


<div class="row">

    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($SurveyFieldName, $SurveyFieldName, array('class' => 'col-form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::select('survey_id',$survey,Input::old('survey_id'),['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single','aria-label' =>'survey_id','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('survey_id') !!}</span>
        </div>
    </div>

    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($SurveyValueName, $SurveyValueName, array('class' => 'col-form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::text('survey_value',Input::old('survey_value'),['id'=>'survey_value','class' => 'form-control','data-checkify'=>'minlen=3,required','Placeholder' => $SurveyValuePlaceholder,'aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('survey_value') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($deviceID, $deviceID, array('class' => 'col-form-label')) !!}
        </div>

        <div class="col-sm-10">
            {!! Form::text('device_id',Input::old('device_id'),['id'=>'device_id','class' => 'form-control','data-checkify'=>'minlen=3,required','Placeholder' => $deviceIDPlaceholder,'aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('device_id') !!}</span>
        </div>
    </div>

    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($latitude,$latitude, array('class' => 'col-form-label')) !!}
        </div>

        <div class="col-sm-10">
            {!! Form::text('latitude',Input::old('latitude'),['id'=>'latitude','class' => 'form-control','data-checkify'=>'minlen=3,required','Placeholder' => $latitudePlaceholder,'aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('latitude') !!}</span>
        </div>
    </div>

    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($longitude, $longitude, array('class' => 'col-form-label')) !!}
        </div>

        <div class="col-sm-10">
            {!! Form::text('longitude',Input::old('longitude'),['id'=>'device_id','class' => 'form-control','data-checkify'=>'minlen=3,required','Placeholder' => $longitudePlaceholder,'aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('longitude') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($ItemName,$ItemName, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::select('item_id',$Item,Input::old('item_id'),['id'=>'item_id','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('item_id') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($OrganizationName,$OrganizationName, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::select('organization_id',$Organization,Input::old('organization_id'),['id'=>'organization_id','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('organization_id') !!}</span>
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
