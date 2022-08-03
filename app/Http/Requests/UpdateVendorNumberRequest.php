<?php

namespace App\Http\Requests;

use App\Models\VendorNumber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVendorNumberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vendor_number_edit');
    }

    public function rules()
    {
        return [
            'number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
