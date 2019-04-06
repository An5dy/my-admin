<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\APIFailedValidation;

class StoreRole extends FormRequest
{
    use APIFailedValidation;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string',
            'display_name' => 'bail|required|string',
            'permissions' => 'bail|required|array',
            'permissions.*' => 'bail|integer'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '角色标识',
            'display_name' => '角色名称',
        ];
    }
}
