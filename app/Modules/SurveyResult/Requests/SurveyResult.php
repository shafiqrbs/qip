<?php

namespace App\Modules\SurveyResult\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyResult extends FormRequest
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
            'survey_value'     => 'required',
            'item_id'       => 'required',
            'organization_id'       => 'required',
            'status'       => 'required',
        ];

    }

    public function messages()
    {
        return [
            'survey_value.required' => __('SurveyResult::FormValidation.namerequired'),
            'item_id.required' => __('SurveyResult::FormValidation.itemrequired'),
            'organization_id.required' => __('SurveyResult::FormValidation.organizationrequired'),
            'status.required' => __('SurveyResult::FormValidation.statusrequired'),
        ];
    }
}
