<?php

namespace App\Http\Requests;

use App\Models\PreludeNumber;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPreludeNumberRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('prelude_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:prelude_numbers,id',
        ];
    }
}
