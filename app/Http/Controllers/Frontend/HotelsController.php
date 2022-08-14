<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHotelRequest;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\Amenity;
use App\Models\Hotel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HotelsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hotel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotels = Hotel::with(['amenities'])->get();

        return view('frontend.hotels.index', compact('hotels'));
    }

    public function create()
    {
        abort_if(Gate::denies('hotel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenities = Amenity::pluck('title', 'id');

        return view('frontend.hotels.create', compact('amenities'));
    }

    public function store(StoreHotelRequest $request)
    {
        $hotel = Hotel::create($request->all());
        $hotel->amenities()->sync($request->input('amenities', []));

        return redirect()->route('frontend.hotels.index');
    }

    public function edit(Hotel $hotel)
    {
        abort_if(Gate::denies('hotel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenities = Amenity::pluck('title', 'id');

        $hotel->load('amenities');

        return view('frontend.hotels.edit', compact('amenities', 'hotel'));
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        $hotel->update($request->all());
        $hotel->amenities()->sync($request->input('amenities', []));

        return redirect()->route('frontend.hotels.index');
    }

    public function show(Hotel $hotel)
    {
        abort_if(Gate::denies('hotel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotel->load('amenities');

        return view('frontend.hotels.show', compact('hotel'));
    }

    public function destroy(Hotel $hotel)
    {
        abort_if(Gate::denies('hotel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hotel->delete();

        return back();
    }

    public function massDestroy(MassDestroyHotelRequest $request)
    {
        Hotel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
