<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\APIFailedValidation;

class StoreAdmin extends FormRequest
{
    use APIFailedValidation;

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
            'nickname' => 'bail|required|string',
            'username' => 'bail|required|string',
            'password' => 'bail|required|string|confirmed',
            'roles' => 'bail|array',
            'roles.*' => 'bail|integer'
        ];
    }

    public function attributes()
    {
        return [
            'nickname' => '昵称',
            'username' => '账号',
            'password' => '密码',
            'password_confirmation' => '确认密码',
            'roles' => '角色',
        ];
    }
}
