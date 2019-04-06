<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\APIFailedValidation;

class StorePermission extends FormRequest
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
            'name' => 'bail|required|string',
            'display_name' => 'bail|required|string',
        ];
    }

    /**
     * @use      [自定义错误属性]
     * @Author   ze
     * @date     2019/3/24 9:53 PM
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '权限标识',
            'display_name' => '权限名称',
        ];
    }
}
