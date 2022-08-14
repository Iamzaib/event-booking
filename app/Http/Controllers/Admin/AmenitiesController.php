<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAmenityRequest;
use App\Http\Requests\StoreAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use App\Models\Amenity;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AmenitiesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('amenity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenities = Amenity::with(['media'])->get();

        return view('admin.amenities.index', compact('amenities'));
    }

    public function create()
    {
        abort_if(Gate::denies('amenity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.amenities.create');
    }

    public function store(StoreAmenityRequest $request)
    {
        $amenity = Amenity::create($request->all());

        if ($request->input('icon', false)) {
            $amenity->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $amenity->id]);
        }

        return redirect()->route('admin.amenities.index');
    }

    public function edit(Amenity $amenity)
    {
        abort_if(Gate::denies('amenity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.amenities.edit', compact('amenity'));
    }

    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        $amenity->update($request->all());

        if ($request->input('icon', false)) {
            if (!$amenity->icon || $request->input('icon') !== $amenity->icon->file_name) {
                if ($amenity->icon) {
                    $amenity->icon->delete();
                }
                $amenity->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($amenity->icon) {
            $amenity->icon->delete();
        }

        return redirect()->route('admin.amenities.index');
    }

    public function show(Amenity $amenity)
    {
        abort_if(Gate::denies('amenity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.amenities.show', compact('amenity'));
    }

    public function destroy(Amenity $amenity)
    {
        abort_if(Gate::denies('amenity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenity->delete();

        return back();
    }

    public function massDestroy(MassDestroyAmenityRequest $request)
    {
        Amenity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('amenity_create') && Gate::denies('amenity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Amenity();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
