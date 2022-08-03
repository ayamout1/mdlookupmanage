<?php

namespace App\Http\Requests;

use App\Models\Warranty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWarrantyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('warranty_create');
    }

    public function rules()
    {
        return [
            'warranty' => [
                'string',
                'nullable',
            ],
        ];
    }
}
