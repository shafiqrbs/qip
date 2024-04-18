<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

$SurveyFieldName =  __('Survey::message.SurveyName');
$SurveyPlaceholder = __('Survey::message.SurveyPlaceholder');
$discription = __('Survey::message.discription');
$discriptionPlaceholder = __('Survey::message.discriptionPlaceholder');
$mode = __('Survey::message.mode');
$organizationName = __('Survey::message.organizationName');
$Status = __('Survey::message.Status');
$ActiveStatus = __('Survey::message.Active');
$InctiveStatus = __('Survey::message.Inactive');
$Reset = __('Survey::message.Reset');
$Submit = __('Survey::message.Submit');
?>


<div class="row">


    <div class="form-group row">
        <div class="col-sm-2">
            {!! Form::label($SurveyFieldName, $SurveyFieldName, array('class' => 'col-form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::text('nameen',Input::old('nameen'),['id'=>'nameen','class' => 'form-control','data-checkify'=>'minlen=3,required','Placeholder' => $SurveyPlaceholder,'aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('nameen') !!}</span>
        </div>
    </div>

    <div class="form-group row mg-top">
        <div class="col-sm-2">

        </div>

        <div class="col-sm-10">
            {!! Form::text('namebn',Input::old('namebn'),['id'=>'namebn','class' => 'form-control','data-checkify'=>'minlen=3,required','Placeholder' => 'জরিপের নাম লিখুন (বাংলা)','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('namebn') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($discription, $discription, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">
            {!! Form::textarea('discriptionen',Input::old('discriptionen'),['id'=>'discription','data-checkify'=>'minlen=3,required','class' => 'form-control','Placeholder' => $discriptionPlaceholder,'aria-label' =>'content','aria-describedby'=>'basic-addon2','rows'=>2]) !!}
            <span style="color: #ff0000">{!! $errors->first('discriptionen') !!}</span>
        </div>
    </div>

    <div class="form-group row mg-top">
        <div class="col-sm-2">

        </div>

        <div class="col-sm-10">
            {!! Form::textarea('discriptionbn',Input::old('discriptionbn'),['id'=>'discription','data-checkify'=>'minlen=3,required','class' => 'form-control','Placeholder' => 'বর্ণনা লিখুন (বাংলা)','aria-label' =>'content','aria-describedby'=>'basic-addon2','rows'=>2]) !!}
            <span style="color: #ff0000">{!! $errors->first('discriptionbn') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($mode,$mode, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <?php
        $modeType = array();
        $modeType[''] = 'Select Mode';
        $modeType['input'] = 'Input';
        $modeType['select'] = 'Select';
        $modeType['checkbox'] = 'Checkbox';
        $modeType['radio'] = 'Radio';
        $modeType['file'] = 'File';
        ?>

        <div class="col-sm-10">
            {!! Form::select('mode',$modeType,Input::old('mode'),['id'=>'mode','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
            <span style="color: #ff0000">{!! $errors->first('mode') !!}</span>
        </div>
    </div>


    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($organizationName,$organizationName, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <div class="col-sm-10">

            @if(isset($data))
                @php $orgArray = array(); @endphp
                @foreach($data->SurveyOrganization($data->id) as $orgData)
                    <?php
                        array_push($orgArray,$orgData->id);
                    ?>
                @endforeach

                    {!! Form::select('organization_id[]',$Organization,$orgArray,['id'=>'organization_id','multiple'=>'multiple','class' => 'form-select js-example-basic-multiple form-control','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                <span style="color: #ff0000">{!! $errors->first('organization_id') !!}</span>
            @else
                {!! Form::select('organization_id[]',$Organization,Input::old('organization_id'),['id'=>'organization_id','multiple'=>'multiple','class' => 'form-select js-example-basic-multiple form-control','aria-label' =>'name','aria-describedby'=>'basic-addon2']) !!}
                <span style="color: #ff0000">{!! $errors->first('organization_id') !!}</span>
            @endif
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
