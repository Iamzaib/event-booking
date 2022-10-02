<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHotelRoomRequest;
use App\Http\Requests\StoreHotelRoomRequest;
use App\Http\Requests\UpdateHotelRoomRequest;
use App\Models\Hotel;
use App\Models\HotelRoom;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HotelRoomsController extends Controller
{
    use MediaUploadingTrait;
    public function index()
    {
        abort_if(Gate::denies('hotel_room_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotelRooms = HotelRoom::with(['hotel'])->get();

        return view('admin.hotelRooms.index', compact('hotelRooms'));
    }

    public function create()
    {
        abort_if(Gate::denies('hotel_room_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotels = Hotel::pluck('hotel_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hotelRooms.create', compact('hotels'));
    }

    public function store(StoreHotelRoomRequest $request)
    {
        $hotelRoom = HotelRoom::create($request->all());
        foreach ($request->input('room_images', []) as $file) {
            $hotelRoom->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('room_images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $hotelRoom->id]);
        }
        return redirect()->route('admin.hotel-rooms.index');
    }

    public function edit(HotelRoom $hotelRoom)
    {
        abort_if(Gate::denies('hotel_room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotels = Hotel::pluck('hotel_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hotelRoom->load('hotel');

        return view('admin.hotelRooms.edit', compact('hotelRoom', 'hotels'));
    }

    public function update(UpdateHotelRoomRequest $request, HotelRoom $hotelRoom)
    {
        $hotelRoom->update($request->all());
        if (count($hotelRoom->room_images) > 0) {
            foreach ($hotelRoom->room_images as $media) {
                if (!in_array($media->file_name, $request->input('room_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $hotelRoom->room_images->pluck('file_name')->toArray();
        foreach ($request->input('room_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $hotelRoom->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('room_images');
            }
        }
        return redirect()->route('admin.hotel-rooms.index');
    }

    public function show(HotelRoom $hotelRoom)
    {
        abort_if(Gate::denies('hotel_room_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotelRoom->load('hotel');

        return view('admin.hotelRooms.show', compact('hotelRoom'));
    }

    public function destroy(HotelRoom $hotelRoom)
    {
        abort_if(Gate::denies('hotel_room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotelRoom->delete();

        return back();
    }

    public function massDestroy(MassDestroyHotelRoomRequest $request)
    {
        HotelRoom::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hotel_room_create') && Gate::denies('hotel_room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HotelRoom();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
