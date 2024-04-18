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

    <div class="form-group row mg-top">
        <div class="col-sm-2">
            <input type="hidden" name="survey_id" id="surveyId" value="{{$surveyId}}">
            {!! Form::label('Month','Month', array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <?php
            $month = array();
            $month[''] = 'Select Month';
            $month['January'] = 'January';
            $month['February'] = 'February';
            $month['March'] = 'March';
            $month['April'] = 'April';
            $month['May'] = 'May';
            $month['June'] = 'June';
            $month['July'] = 'July';
            $month['August'] = 'August';
            $month['September'] = 'September';
            $month['October'] = 'October';
            $month['November'] = 'November';
            $month['December'] = 'December';

            if (isset($input)){
                $monthvalue = $input['month'];
                $yearvalue = $input['year'];
            }else{
                $monthvalue = Input::old('month');
                $yearvalue = '';

            }
        ?>



        <div class="col-sm-4">
            {!! Form::select('month',$month,$monthvalue,['id'=>'month','class' => 'form-control form-select js-example-basic-single','data-checkify'=>'required','aria-label' =>'month','aria-describedby'=>'basic-addon2','required'=>'true']) !!}
            <span style="color: #ff0000">{!! $errors->first('month') !!}</span>
        </div>


        <div class="col-sm-2">
            {!! Form::label('Year','Year', array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>
        <div class="col-sm-4">
            <select id="year" name="year" class="form-control form-select js-example-basic-single" required>
                <option value="">Select Year</option>
                @for ($i = 2022; $i <= 2050; $i++)
                    <option value="{{ $i }}" @if(isset($input))@if($yearvalue == $i) {{'selected'}} @endif @endif >{{ $i }}</option>
                @endfor
            </select>
            <span style="color: #ff0000">{!! $errors->first('year') !!}</span>
        </div>
    </div>


</div>




<div class="row mg-top" >
    <div class="col-md-12" style="text-align: right;">
        <div class="from-group">
            <div class="">
{{--                <button type="reset" class="btn submit-button">{{$Reset}}</button>--}}
                <button type="submit" class="btn submit-button" id="OrganizationFormSubmit">{{$Submit}}</button>
            </div>
        </div>
    </div>

</div>
