<?php

namespace App\Containers\AppSection\Product\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class EditProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:products,id'],
            'name' => ['string', 'max:255'],
            'description' => ['string'],
            'price' => ['min:0'],
            'quantity' => ['min:0'],
        ];
    }
}
