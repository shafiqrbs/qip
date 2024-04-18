<?php

namespace App\Modules\SurveyItem\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyItem extends FormRequest
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
//            'name.required' => trans('Organization::FormVaidation.namerequired'),
//            'name'     => 'required',
//            'item'       => 'required',
            'status'       => 'required',
        ];

    }

    public function messages()
    {
        return [
//            'name.required' => __('SurveyItem::FormValidation.namerequired'),
//            'item.required' => __('SurveyItem::FormValidation.itemrequired'),
            'status.required' => __('SurveyItem::FormValidation.statusrequired'),
        ];
    }
}
