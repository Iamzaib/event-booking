<?php

namespace App\Http\Controllers\Frontend;

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
use App\Models\HotelRoom;
use App\Models\State;
use Carbon\CarbonPeriod;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\Pure;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    private $request;
    use MediaUploadingTrait;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::with(['country', 'state', 'city', 'media'])->get();

        return view('front.trips.trips', compact('events'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.events.create', compact('cities', 'countries', 'states'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());

        if ($request->input('featured_image', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('frontend.events.index');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event->load('country', 'state', 'city');

        return view('frontend.events.edit', compact('cities', 'countries', 'event', 'states'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());

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

        return redirect()->route('frontend.events.index');
    }

    public function show(Event $event)
    {
        //abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('country', 'state', 'city');

        return view('front.trips.trip-event', compact('event'));
    }
    public function customized_trip($trip_title,Event $trip){
//       dd($trip_title,$trip);
        $data['travelers']=1;
        if($this->request->travelers>0){
            $data['travelers']=$this->request->travelers;
        }
        $data['page_name']=$trip_title;
//        $data['page_type']='trip';
        $trip->load('country', 'state', 'city');
        $data['trip']=$trip;

        $period = CarbonPeriod::create(date('Y-m-d H:i:s',strtotime($trip->event_start)), date('Y-m-d H:i:s',strtotime($trip->event_end)));
        // Iterate over the period
        $dates=$period->toArray();
//        foreach ($period as $date) {
//
//        }
        foreach ($dates as $i=> $date){
            $dates[$i]=date('d-M-Y',strtotime($date));
        }

//        echo json_encode($pieces);exit;
        if($trip->duration>2){
            list($date_range_1, $date_range_2) = array_chunk($dates, ceil(count($dates) / 2));
            $data['range'][0]['date']=Arr::first($date_range_1).' > '.Arr::last($date_range_1);
            $data['range'][0]['duration']=count($date_range_1);
            $data['range'][0]['price']=($trip->daily_price*count($date_range_1))*$data['travelers'];
        }
        $data['low_total']=$data['range'][0]['price'];
        $data['low_deposit']=($data['range'][0]['price']*((float)DEPOSIT_AMOUNT_PERCENT/100));
        $installment=$data['range'][0]['price']-$data['low_deposit'];
        $data['low_installment']=($installment/(int)TOTAL_INSTALLMENTS);


        $data['total_event_tickets']=count($trip->tickets);
        $data['range'][1]['date']=date('d-M-Y',strtotime($trip->event_start)).' > '.date('d-M-Y',strtotime($trip->event_end));
        $data['range'][1]['duration']=count($dates);
        $data['range'][1]['price']=($trip->daily_price*$trip->duration)*$data['travelers'];
        $data['intent'] = auth()->user()->createSetupIntent();
        $data['payment_method']=Auth::user()->defaultPaymentMethod()->id;
//        echo $data['payment_method']->id;
//        dd($data['payment_method']);
        //var_dump($data = $this->request->session()->all());
        return view('front.trips.custom_trip',$data);
    }

    public function trip_view($trip_title,Event $event)
    {
        //abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['page_name']=$trip_title;
        $data['page_type']='trip';
        $event->load('country', 'state', 'city');
        $data['featured_trips']=Event::where('event_start','>',date('Y-m-d'))
            ->orderBy('event_start','asc')->limit(3)->get();
        $data['trip']=$event;

        return view('front.trips.trip-event', $data);
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
}
