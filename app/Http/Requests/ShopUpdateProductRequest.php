<?php

namespace App\Http\Requests;


class ShopUpdateProductRequest extends MainRequest
{

    private $validationsMessage;

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
            'category_id' => self::INTEGER,
            'description_en' => 'required|between:5,255',
            'description_ru' => 'required|between:5,255',
            'old_price' => self::NUMBER,
            'sales' => 'required|numeric|between:1,100',
            'img_url' => 'required|url|max:255',
            'order_count' => self::INTEGER,
            'stock_availability' => self::INTEGER,
        ];
    }

    public function messages()
    {
        return $this->validationMassages();
    }
}
