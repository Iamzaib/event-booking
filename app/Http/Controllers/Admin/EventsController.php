<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\City;
use App\Models\Costume;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventAddon;
use App\Models\EventFaq;
use App\Models\EventInstallment;
use App\Models\Hotel;
use App\Models\Itinerary;
use App\Models\PackageAmenity;
use App\Models\RoomPricing;
use App\Models\RoomPricingRange;
use App\Models\State;
use App\Models\TripDateRange;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::with(['country', 'state', 'city', 'hotels', 'addons', 'amenities_includeds','itinerary', 'media'])->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

//        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');
//
//        $cities = City::pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cities=$states= [''=>trans('global.pleaseSelect')];
        $hotels = Hotel::pluck('hotel_name', 'id');
        $costumes = Costume::pluck('costume_title', 'id');

        $addons = EventAddon::pluck('addon_title', 'id');

        $amenities_includeds = PackageAmenity::pluck('title', 'id');

        return view('admin.events.create', compact('addons', 'amenities_includeds', 'cities', 'countries', 'hotels', 'states','costumes'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());
        $this->sync_fields($event,$request);
        if ($request->input('featured_image', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }
//        Itinerary::where('event_id',$event->id)->delete();
        foreach ($request->input('range_price') as $index => $range){
            if($request->range_start[$index]!=''&&$request->range_end[$index]!=''&&$request->range_price[$index]!=''){
                TripDateRange::create([
                    'event_id'=>$event->id,
                    'range_title'=>$request->range_title[$index],
                    'range_start'=>$request->range_start[$index],
                    'range_end'=>$request->range_end[$index],
                    'range_price'=>$request->range_price[$index],
                ]);
            }
        }
        foreach ($request->input('number') as $index => $itinerary){
            if($request->title[$index]!=''){
                Itinerary::create([
                    'event_id'=>$event->id,
                    'number'=>$request->number[$index],
                    'title'=>$request->title[$index],
                    'detail'=>$request->detail[$index],
                    'time'=>$request->time[$index],
                    'duration'=>$request->duration[$index],
                ]);
            }

        }
        foreach ($request->input('faq_question') as $index => $faq){
            if($request->faq_question[$index]!=''&&$request->faq_answer[$index]!=''){
                EventFaq::create([
                    'event_id'=>$event->id,
                    'question'=>$request->faq_question[$index],
                    'answer'=>$request->faq_answer[$index],
                ]);
            }
        }

        return redirect()->route('admin.events.index');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities=$states= [''=>trans('global.pleaseSelect')];
        if($event->country_id>0){
            $states = State::where('country_id',$event->country_id)->pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }
        if($event->state_id>0) {
            $cities = City::where('state_id',$event->state_id)->pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }
        $hotels = Hotel::pluck('hotel_name', 'id');
        $costumes = Costume::pluck('costume_title', 'id');
        $addons = EventAddon::pluck('addon_title', 'id');

        $amenities_includeds = PackageAmenity::pluck('title', 'id');

        $event->load('country', 'state', 'city', 'hotels', 'addons', 'amenities_includeds');

        return view('admin.events.edit', compact('addons', 'amenities_includeds', 'cities', 'countries', 'event', 'hotels', 'states','costumes'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());
        $this->sync_fields($event,$request);
        if ($request->input('featured_image', false)) {
            if (!$event->featured_image || $request->input('featured_image') !== $event->featured_image->file_name) {
                if ($event->featured_image) {
                    $event->featured_image->delete();
                }
                $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($event->featured_image) {
            $event->featured_image->delete();
        }
        if(isset($request->range_id)){
            TripDateRange::whereNotIn('id',$request->range_id)->delete();
        }
        foreach ($request->input('range_price') as $index => $range){
            if($request->range_start[$index]!=''&&$request->range_end[$index]!=''&&$request->range_price[$index]!=''){
                TripDateRange::updateOrCreate(
                    ['id'=>(isset($request->range_id)?$request->range_id[$index]:null),'event_id'=>$event->id],
                    ['range_title'=>$request->range_title[$index],
                    'range_start'=>$request->range_start[$index],
                    'range_end'=>$request->range_end[$index],
                    'range_price'=>$request->range_price[$index],
                ]);
            }
        }
        Itinerary::where('event_id',$event->id)->delete();
        foreach ($request->input('number') as $index => $itinerary){
            if($request->title[$index]!='') {
                Itinerary::create([
                    'event_id' => $event->id,
                    'number' => $request->number[$index],
                    'title' => $request->title[$index],
                    'detail' => $request->details[$index],
                    'time' => $request->datetime[$index],
                    'duration' => $request->durations[$index],
                ]);
            }
        }
        EventFaq::where('event_id',$event->id)->delete();
        foreach ($request->input('faq_question') as $index => $faq){
            if($request->faq_question[$index]!=''&&$request->faq_answer[$index]!='') {
                EventFaq::create([
                    'event_id' => $event->id,
                    'question' => $request->faq_question[$index],
                    'answer' => $request->faq_answer[$index],
                ]);
            }
        }
        return redirect()->route('admin.events.index');
    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('country', 'state', 'city', 'hotels', 'addons', 'amenities_includeds', 'bookingEventEventBookings');

        return view('admin.events.show', compact('event'));
    }
    public function room_pricing(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(!isset($event->id), Response::HTTP_NOT_FOUND, '404 Forbidden');

        $event->load('country', 'state', 'city', 'hotels', 'addons', 'amenities_includeds', 'bookingEventEventBookings');
        $rooms=[];
        foreach ($event->hotels as $hotel){
            foreach ($hotel->rooms as $room){
                $rooms[]=$room;
            }
        }
        if(count($rooms)<=0){
            return redirect()->back()->with('error_msg','Trip has No Hotel Rooms');
        }
        return view('admin.events.roomPricing', compact('event','rooms'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    private function sync_fields($event,$request){
        $event->hotels()->sync($request->input('hotels', []));
        $event->addons()->sync($request->input('addons', []));
        $event->amenities_includeds()->sync($request->input('amenities_includeds', []));
        $event->amenities_excludeds()->sync($request->input('amenities_excludeds', []));
        $event->costumes()->sync($request->input('costumes', []));
    }

    public function event_room_pricing(Request $request,Event $trip){
        $rooms=[];
        foreach ($trip->hotels as $hotel){
            if($hotel->id==2) {
                continue;
            }
            foreach ($hotel->rooms as $room){
                $rooms[]=$room;
            }
        }

        if(isset($request->action)&&$request->action=='update'){

            if(isset($request->range_id)&&is_array($request->range_id)){
                foreach ($request->range_id as $index => $value){
                    $room_pricing_range= RoomPricingRange::where('id',$request->range_id[$index])->update([
//                        'event_id'=>$trip->id,
                        'start_date'=>$request->room_range_start[$index],
                        'end_date'=>$request->room_range_end[$index],
                        'no_accommodation'=>$request->no_accommodation_room_price[$index],
                    ]);
                    foreach ($rooms as $room){
                        $room_id=$room->id;
                        $room_p=$request->input('room_price_'.$room_id);
                        foreach ($room_p as $traveler => $prices){
                            foreach ($prices as $id => $price){
                                $check_rp=RoomPricing::where(['room_pricing_range_id'=>$request->range_id[$index],'room_id'=>$room_id,'for_travelers'=>$traveler])->count();
                                if($check_rp>0){
                                    RoomPricing::where('id',$id)->update([
//                                        'room_pricing_range_id'=>$room_pricing_range->id,
//                                    'room_id'=>$room_id,
                                        'price'=>$price,
                                        'for_travelers'=>$traveler,
                                    ]);
                                }else{
                                    RoomPricing::create([
                                        'room_pricing_range_id'=>$request->range_id[$index],
                                        'room_id'=>$room_id,
                                        'price'=>$price,
                                        'for_travelers'=>$traveler,
                                    ]);
                                }

                            }

                        }

                    }
                }
            }else{
                foreach ($request->room_range_start as $index => $value){
                    $room_pricing_range= RoomPricingRange::create([
                        'event_id'=>$trip->id,
                        'start_date'=>date(config('panel.date_format'),strtotime($request->room_range_start[$index])),
                        'end_date'=>date(config('panel.date_format'),strtotime($request->room_range_end[$index])),
                        'no_accommodation'=>$request->no_accommodation_room_price[$index],
                    ]);
                    foreach ($rooms as $room){
                        $room_id=$room->id;
                        $room_p=$request->input('room_price_'.$room_id);
                        foreach ($room_p as $traveler => $price){
                            RoomPricing::create([
                                'room_pricing_range_id'=>$room_pricing_range->id,
                                'room_id'=>$room_id,
                                'price'=>$price[$index],
                                'for_travelers'=>$traveler,
                            ]);
                        }

                    }
                }
//                dd($request->all());
            }

            return back();
        }
        if(isset($request->view_price)){
            get_room_price($trip,1,1,$trip->event_start,$trip->event_end);
        }

        $data['rooms']=$rooms;
        $data['trip']=$trip;
        return view('admin.events.roomPricing',$data);
    }
    public function event_installment_pricing(Request $request,Event $trip){
        if(isset($request->action)&&$request->action=='update'){
            if($trip->deposit!=$request->deposit){
                $trip->update(['deposit'=>$request->deposit]);
            }
//$delete_not_ids=[];
//            dd($request->installment_id);
            if(isset($request->installment_id)&&count($request->installment_id)>0){
                EventInstallment::where('event_id',$trip->id)->whereNotIn('id', $request->installment_id)->delete();
            }
            foreach ($request->installment as $in_no => $amount){
                if(isset($request->installment_id[$in_no])&&$request->installment_id[$in_no]>0){
                    EventInstallment::where('id',(int)$request->installment_id[$in_no])
                        ->update([
                            'installment'=>$amount,
                            'due_date'=>date('Y-m-d',strtotime($request->installment_due[$in_no])),
                        ]);
                }else{
                    EventInstallment::create([
                        'event_id'=>$trip->id,
                        'installment'=>$amount,
                        'due_date'=>date(config('panel.date_format'),strtotime($request->installment_due[$in_no])),
                        'installment_no'=>$request->installment_no[$in_no],
                    ]);
                }
            }
//            dd($request->all());
            return back();
        }
        $data['trip']=$trip;

        return view('admin.events.pricingInstallments',$data);
    }
}
