<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class MainRequest extends FormRequest
{
    protected const NUMBER = 'required|numeric|between:1,10000';
    protected const INTEGER = self::NUMBER . '|integer';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

}
