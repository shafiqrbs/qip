<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
$SurveyFieldName =  __('Survey::message.SurveyName');

$SurveyItemName =  __('SurveyItem::message.SurveyItemName');
$SurveyItemPlaceholder = __('SurveyItem::message.SurveyItemPlaceholder');
$item = __('SurveyItem::message.item');
$itemPlacehlder = __('SurveyItem::message.itemPlaceholder');
$oredring = __('SurveyItem::message.oredring');
$oredringPlaceholder = __('SurveyItem::message.oredringPlaceholder');

$colorcode = __('SurveyItem::message.colorcode');
$colorcodePlc = __('SurveyItem::message.colorcodePlc');


$Status = __('Organization::message.Status');
$ActiveStatus = __('Organization::message.Active');
$InctiveStatus = __('Organization::message.Inactive');
$Reset = __('Organization::message.Reset');
$Submit = __('Organization::message.Submit');
?>


<div class="row">
    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($SurveyFieldName, $SurveyFieldName, array('class' => 'col-form-label')) !!}
            <span class="colorRed">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::select('survey_id',$survey,Input::old('survey_id'),['id'=>'survey_id','class' => 'form-control form-select js-example-basic-single','aria-label' =>'survey_id','aria-describedby'=>'basic-addon2']) !!}
            <span class="colorRed">{!! $errors->first('survey_id') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($item, $item, array('class' => 'form-label')) !!}
            <span class="colorRed">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::text('itemtexten',Input::old('itemtexten'),['id'=>'itemtexten','data-checkify'=>'minlen=3,required','class' => 'form-control','Placeholder' => 'Enter survey Item','aria-label' =>'content','aria-describedby'=>'basic-addon2','rows'=>2]) !!}
            <span class="colorRed">{!! $errors->first('itemtexten') !!}</span>
        </div>
    </div>

    <div class="form-group row mg-top">
        <div class="col-sm-2">

        </div>

        <div class="col-sm-10">
            {!! Form::text('itemtextbn',Input::old('itemtextbn'),['id'=>'itemtextbn','data-checkify'=>'minlen=3,required','class' => 'form-control','Placeholder' =>'জরিপ আইটেম নাম লিখুন','aria-label' =>'content','aria-describedby'=>'basic-addon2','rows'=>2]) !!}
            <span class="colorRed">{!! $errors->first('itemtextbn') !!}</span>
        </div>
    </div>

    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($colorcode, $colorcode, array('class' => 'form-label')) !!}
            <span class="colorRed">*</span>
        </div>

        <div class="col-sm-10">
{{--            <input type="color" id="favcolor" name="color_code" value="">--}}
            @if(isset($data))
            {!! Form::color('color_code','#'.$data->color_code,['id'=>'color_code','data-checkify'=>'minlen=3,required','class' => 'form-control','Placeholder' => $colorcodePlc]) !!}
            @else
                {!! Form::color('color_code',Input::old('color_code'),['id'=>'color_code','data-checkify'=>'minlen=3,required','class' => 'form-control','Placeholder' => $colorcodePlc]) !!}
            @endif
            <span class="colorRed">{!! $errors->first('oredring') !!}</span>
        </div>
    </div>




{{--    <div class="form-group row mg-top">--}}
{{--        <div class="col-sm-2">--}}
{{--            {!! Form::label('Item Value', 'Item Value', array('class' => 'form-label')) !!}--}}
{{--            <span style="color: red">*</span>--}}
{{--        </div>--}}

{{--        <div class="col-sm-10">--}}
{{--            {!! Form::textarea('itemvalueen',Input::old('itemvalueen'),['id'=>'item','data-checkify'=>'minlen=3,required','class' => 'form-control','Placeholder' => 'Enter item, if item is more , saperate by comma.','aria-label' =>'content','aria-describedby'=>'basic-addon2','rows'=>2]) !!}--}}
{{--            <span style="color: #ff0000">{!! $errors->first('itemvalueen') !!}</span>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="form-group row mg-top">--}}
{{--        <div class="col-sm-2">--}}

{{--        </div>--}}

{{--        <div class="col-sm-10">--}}
{{--            {!! Form::textarea('itemvaluebn',Input::old('itemvaluebn'),['id'=>'item','data-checkify'=>'minlen=3,required','class' => 'form-control','Placeholder' => 'জরিপ আইটেম  লিখুন, যদি আরও আইটেম কমা দ্বারা পৃথক করা হয়','aria-label' =>'content','aria-describedby'=>'basic-addon2','rows'=>2]) !!}--}}
{{--            <span style="color: #ff0000">{!! $errors->first('itemvaluebn') !!}</span>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($oredring, $oredring, array('class' => 'form-label')) !!}
            <span class="colorRed">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::text('oredring',Input::old('oredring'),['id'=>'oredring','data-checkify'=>'minlen=3,required','class' => 'form-control','Placeholder' => $oredringPlaceholder,'aria-label' =>'content','aria-describedby'=>'basic-addon2','rows'=>2]) !!}
            <span class="colorRed">{!! $errors->first('oredring') !!}</span>
        </div>
    </div>



    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($Status, $Status, array('class' => 'form-label')) !!}
            <span class="colorRed">*</span>
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
            <span class="colorRed">{!! $errors->first('status') !!}</span>
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


@push('CustomStyle')
    <style>
        .colorRed {
            color: #ff0000
        }
    </style>
@endpush