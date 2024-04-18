<?php

namespace App\Modules\Survey\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveySearch extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'month'       => 'required',
            'year'       => 'required',
        ];

    }

//    public function messages()
//    {
//        return [
////            'name.required' => __('Survey::FormValidation.nameRequired'),
////            'discription.required' => __('Survey::FormValidation.discriptionRequired'),
//            'mode.required' => __('Survey::FormValidation.modeRequired'),
//            'status.required' => __('Survey::FormValidation.statusrequired'),
//        ];
//    }
}
