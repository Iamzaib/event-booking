<?php

namespace App\Http\Requests;

use App\Models\PackageAmenity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePackageAmenityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('package_amenity_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
