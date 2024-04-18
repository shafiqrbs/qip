<?php

namespace App\Modules\Organization\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Organization extends FormRequest
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
            'name'     => 'required',
            'address'       => 'required',
            'mobile'       => 'required',
            'email'       => 'required|email',
            'status'       => 'required',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => __('Organization::FormValidation.namerequired'),
            'address.required' => __('Organization::FormValidation.addressrequired'),
            'mobile.required' => __('Organization::FormValidation.mobilerequired'),
            'email.required' => __('Organization::FormValidation.emailrequired'),
            'email.email' => __('Organization::FormValidation.emailEmail'),
            'status.required' => __('Organization::FormValidation.statusrequired'),
        ];
    }
}
