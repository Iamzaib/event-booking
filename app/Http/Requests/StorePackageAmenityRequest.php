<?php

namespace App\Http\Requests;

use App\Models\PackageAmenity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePackageAmenityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('package_amenity_create');
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
