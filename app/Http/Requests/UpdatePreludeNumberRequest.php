<?php

namespace App\Http\Requests;

use App\Models\PreludeNumber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePreludeNumberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prelude_number_edit');
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
