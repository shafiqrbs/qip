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


    <div class="form-group">
        <div class="table-responsive" style="overflow-x: auto !important;">
        <table class="table table-striped table-bordered text-center" id="table_id">
        <tr>
            <th></th>
            @foreach($surveyCompany as $value)
                <th>{{$value->name}}</th>
            @endforeach
        </tr>

            @for($dateValue = 1; $dateValue <=$days; $dateValue++)
                <tr>
                    <td>{{$dateValue}}</td>

                    @foreach($surveyCompany as $value)
                        <td>
                            <input id="personNumber" type="text" date="{{$dateValue}}" organizationId ="{{$value->id}}" class="personNumber form-control" name="person">
                        </td>
                    @endforeach
                </tr>
            @endfor
    </table>
        </div>
    </div>

</div>




{{--<div class="row mg-top" >--}}
{{--    <div class="col-md-12" style="text-align: right;">--}}
{{--        <div class="from-group">--}}
{{--            <div class="">--}}
{{--                <button type="reset" class="btn submit-button">{{$Reset}}</button>--}}
{{--                <button type="submit" class="btn submit-button" id="OrganizationFormSubmit">{{$Submit}}</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
