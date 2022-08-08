<?php

namespace App\Http\Requests;

use App\Models\CostumeAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCostumeAttributeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('costume_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:costume_attributes,id',
        ];
    }
}
