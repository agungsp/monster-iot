<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;

class FunctionHelper {

    /**
     * Standard response format
     *
     * @param bool $success Response status
     * @param string $message Response message
     * @param array $data Response data
     * @param bool $toJson If true, return json. else return array. default is false
     * @return mixed
     **/
    public static function response($success = true, $message = "", $data = [], $toJson = false)
    {
        $response = collect(compact('success', 'message', 'data'));
        return $toJson ? $response->toJson() : $response->toArray();
    }

    /**
     * Error response from validator
     *
     * @param Illuminate\Support\Facades\Validator $validator Validation provider
     * @param bool $toJson If true, return json. else return array. default is false
     * @return mixed
     **/
    public static function errorResponse($validator, $toJson = false)
    {
        return static::response(
            false,
            $validator->messages()->first(),
            [],
            $toJson
        );
    }

}
