<?php

namespace App\Http\Requests;

use App\Models\PreludeNumber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePreludeNumberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prelude_number_create');
    }

    public function rules()
    {
        return [
            'number' => [
                'nullable',
                'string',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
