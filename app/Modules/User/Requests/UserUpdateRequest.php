<?php

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class UserUpdateRequest extends FormRequest
{
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
            'name'       => 'required',
            'email'       => 'required',
            'mobile'       => 'required',
            'roles'       => 'required',
//            'user_image'=> 'image|mimes:jpeg,JPEG,Jpeg,PNG,Png,png,jpg,JPG,Jpg',
        ];

    }

}
