<?php

namespace App\Containers\AppSection\Product\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class GetFilteredProductsRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'quantity' => ['min:0'],
        ];
    }
}
