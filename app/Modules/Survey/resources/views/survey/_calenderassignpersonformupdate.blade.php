<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
use App\Modules\Survey\Models\SurveyOrganizationPerson;


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
                        <?php
                        if ($input['month'] == 'January'){
                            $date = $dateValue.'-01-'.$input['year'];
                        }elseif ($input['month'] == 'February'){
                            $date = $dateValue.'-02-'.$input['year'];
                        }elseif ($input['month'] == 'March'){
                            $date = $dateValue.'-03-'.$input['year'];
                        }elseif ($input['month'] == 'April'){
                            $date = $dateValue.'-04-'.$input['year'];
                        }elseif ($input['month'] == 'May'){
                            $date = $dateValue.'-05-'.$input['year'];
                        }elseif ($input['month'] == 'June'){
                            $date = $dateValue.'-06-'.$input['year'];
                        }elseif ($input['month'] == 'July'){
                            $date = $dateValue.'-07-'.$input['year'];
                        }elseif ($input['month'] == 'August'){
                            $date = $dateValue.'-08-'.$input['year'];
                        }elseif ($input['month'] == 'September'){
                            $date = $dateValue.'-09-'.$input['year'];
                        }elseif ($input['month'] == 'October'){
                            $date = $dateValue.'-10-'.$input['year'];
                        }elseif ($input['month'] == 'November'){
                            $date = $dateValue.'-11-'.$input['year'];
                        }else{
                            $date = $dateValue.'-12-'.$input['year'];
                        }
                        $modelExists = SurveyOrganizationPerson::where('survey_id',$surveyId)->where('month',$input['month'])->where('year',$input['year'])->where('organization_id',$value->id)->where('date',$date)->first();

//                        echo '<pre>';
//                        print_r($modelExists)

//                        dd($modelExists->person);
                        ?>
                        <td>
                            <input id="personNumber" type="text" date="{{$dateValue}}" organizationId ="{{$value->id}}" class="personNumber form-control" name="person" value="@if(isset($modelExists->person)){{$modelExists->person}}@else{{''}} @endif">
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
