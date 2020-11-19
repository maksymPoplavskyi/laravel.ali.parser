<?php

namespace App\Http\Requests;


class ProductRequest extends MainRequest
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
            'id' => '|exists:products,id'
        ];
    }

    public function validationData()
    {
        return $this->route()->parameters();
    }
}
