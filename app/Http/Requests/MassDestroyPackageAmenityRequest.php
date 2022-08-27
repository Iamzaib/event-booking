<?php

namespace App\Http\Requests;

use App\Models\PackageAmenity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPackageAmenityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('package_amenity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:package_amenities,id',
        ];
    }
}
