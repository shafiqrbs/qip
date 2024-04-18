<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

$LanguageFieldName =  __('Configuration::message.LanguageFieldName');
$Reset = __('Organization::message.Reset');
$Submit = __('Organization::message.Submit');
?>
<div class="row">

    <div class="form-group row mg-top">
        <div class="col-sm-2">
            {!! Form::label($LanguageFieldName, $LanguageFieldName, array('class' => 'form-label')) !!}
            <span style="color: red">*</span>
        </div>

        <?php
            $Language = array();
            $Language[''] = 'Select language';
            $Language['bn'] = 'Bangla';
            $Language['en'] = 'English';
        ?>

        <div class="col-sm-4">
            {!! Form::select('language',$Language,Input::old('language'),['id'=>'language','class' => 'form-control form-select js-example-basic-single']) !!}
            <span style="color: #ff0000">{!! $errors->first('language') !!}</span>

        </div>
    </div>


{{--    <div class="form-group row mg-top">--}}
{{--        <div class="col-sm-2">--}}
{{--            {!! Form::label('Status', 'Status', array('class' => 'form-label')) !!}--}}
{{--            <span style="color: red">*</span>--}}
{{--        </div>--}}

{{--        <div class="col-sm-10">--}}
{{--            <?php--}}
{{--            $Active = '';--}}
{{--            $Inactive = '';--}}
{{--            if (isset($data->status)){--}}
{{--                if ($data->status == 1){--}}
{{--                    $Active = 'checked="checked"';--}}
{{--                }else{--}}
{{--                    $Inactive = 'checked="checked"';--}}
{{--                }--}}
{{--            }--}}
{{--            ?>--}}
{{--            <div class="input-group mb-3">--}}
{{--                <div class="form-check form-check-inline">--}}
{{--                    <input class="form-check-input" type="radio" name="status" id="inlineRadioActive" value="1" {{$Active}}>--}}
{{--                    <label class="form-check-label" for="inlineRadioActive">Active</label>--}}
{{--                </div>--}}
{{--                <div class="form-check form-check-inline">--}}
{{--                    <input  class="form-check-input" type="radio" name="status" id="inlineRadioInactive" value="0" {{$Inactive}}>--}}
{{--                    <label class="form-check-label" for="inlineRadioInactive">Inactive</label>--}}
{{--                </div>--}}
{{--                <span style="color: #ff0000">{!! $errors->first('status') !!}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


</div>




<div class="row">

    <div class="col-md-12" style="text-align: right;">
        <div class="from-group">
            <div class="">
                <button type="submit" class="btn submit-button" id="ConfigurationFormSubmit">{{$Submit}}</button>
            </div>
        </div>
    </div>

</div>

