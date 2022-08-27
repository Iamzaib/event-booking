<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPackageAmenityRequest;
use App\Http\Requests\StorePackageAmenityRequest;
use App\Http\Requests\UpdatePackageAmenityRequest;
use App\Models\PackageAmenity;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PackageAmenitiesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('package_amenity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packageAmenities = PackageAmenity::with(['media'])->get();

        return view('frontend.packageAmenities.index', compact('packageAmenities'));
    }

    public function create()
    {
        abort_if(Gate::denies('package_amenity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.packageAmenities.create');
    }

    public function store(StorePackageAmenityRequest $request)
    {
        $packageAmenity = PackageAmenity::create($request->all());

        if ($request->input('icon', false)) {
            $packageAmenity->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $packageAmenity->id]);
        }

        return redirect()->route('frontend.package-amenities.index');
    }

    public function edit(PackageAmenity $packageAmenity)
    {
        abort_if(Gate::denies('package_amenity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.packageAmenities.edit', compact('packageAmenity'));
    }

    public function update(UpdatePackageAmenityRequest $request, PackageAmenity $packageAmenity)
    {
        $packageAmenity->update($request->all());

        if ($request->input('icon', false)) {
            if (!$packageAmenity->icon || $request->input('icon') !== $packageAmenity->icon->file_name) {
                if ($packageAmenity->icon) {
                    $packageAmenity->icon->delete();
                }
                $packageAmenity->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($packageAmenity->icon) {
            $packageAmenity->icon->delete();
        }

        return redirect()->route('frontend.package-amenities.index');
    }

    public function show(PackageAmenity $packageAmenity)
    {
        abort_if(Gate::denies('package_amenity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.packageAmenities.show', compact('packageAmenity'));
    }

    public function destroy(PackageAmenity $packageAmenity)
    {
        abort_if(Gate::denies('package_amenity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packageAmenity->delete();

        return back();
    }

    public function massDestroy(MassDestroyPackageAmenityRequest $request)
    {
        PackageAmenity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('package_amenity_create') && Gate::denies('package_amenity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PackageAmenity();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
