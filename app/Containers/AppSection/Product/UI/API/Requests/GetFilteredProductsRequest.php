<?php

namespace App\Containers\AppSection\Product\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Validation\Rule;

class GetFilteredProductsRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'quantity' => ['min:0'],
            'itemsPerPage' => ['numeric'],
            'sortBy.*.key' => [Rule::in(['id', 'price'])],
            'sortBy.*.order' => [Rule::in(['asc', 'desc'])],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'itemsPerPage' => $this->input('itemsPerPage', 10)
        ]);
    }
}
