<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class PermissionCreateRequest extends Request
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
            'name'=>'required|unique:permissions|max:255',
            'display_name'=>'required|max:255',
            'cid'=>'required|int',
        ];
    }
//
//    function formatErrors(Validator $validator) {
//        return $validator->errors()->all();
//    }
//    function messages(){
//
//    }

}
