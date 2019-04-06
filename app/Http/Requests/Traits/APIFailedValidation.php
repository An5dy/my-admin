<?php

namespace App\Http\Requests\Traits;

use App\Exceptions\APIException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

trait APIFailedValidation
{
    /**
     * @use      [错误返回格式]
     * @Author   ze
     * @date     2019/3/24 9:51 PM
     * @param Validator $validator
     * @throws APIException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new APIException($validator->errors()->first(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}