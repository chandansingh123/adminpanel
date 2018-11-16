<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'item_id' => 'required',
            'delivery_date' => 'required',
            'closed_date' => 'required',
            'offer_quantity' => 'required',
            'min_reserved_price' => 'required',
        ];
    }
}
