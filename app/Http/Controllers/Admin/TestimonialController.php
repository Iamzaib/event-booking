<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TestimonialExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTestimonialRequest;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Event;
use App\Models\EventBooking;
use App\Models\Testimonial;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PDF;
use Excel;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('testimonial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $filters['users'] = User::whereHas('roles', function ($q)  { return $q->where('title','=', 'User'); })->pluck('name', 'id')->prepend('Any', '*');
        $filters['events']=Event::pluck('event_title', 'id')->prepend('Any', '*');
        $per_page=$request->per_page??10;
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';
        $testimonials=$this->modelListingQuery($request)->paginate($per_page,'*','page',($request->page?$request->page:1));
        //$testimonials->paginate($per_page,'*','page',($request->page?$request->page:1));
        if($request->sorting){
            if($sort_type=='desc'){
                $sort_type='asc';
            }else{
                $sort_type='desc';
            }
        }

        $sort .= '-' . $sort_type;
        //$testimonials = Testimonial::with(['user', 'event_trip_booking'])->get();

        return view('admin.testimonials.index', compact('testimonials','sort','per_page','sort_type','filters'));
    }
    public function modelListingQuery($request){
//            $per_page=$request->per_page??10;
        $testimonials=Testimonial::query();
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';

        $special_sort=true;
        if($sort=='user'){
            $with_Array=['user'=>function ($query) use ($sort_type) {
                $query->orderBy('name', $sort_type);
            },'event_trip_booking'];
        }elseif($sort=='event'){
            $with_Array=['event_trip_booking'=>function ($query) use ($sort_type) {
                $query->orderBy('booking_details', $sort_type);
            }, 'user'];
        }else{
            $with_Array=['user', 'event_trip_booking'];
            $special_sort=false;
        }
        $testimonials->with($with_Array);
        $testimonials->when($request->search, function ($query, $search) {
            $query->where('review_text', 'LIKE', "%{$search}%");
            $query->orWhere('review_date', 'LIKE', "%{$search}%");
            $query->orWhereHas('event_trip_booking', function ($q) use ($search) { return $q->where('booking_details', 'LIKE', "%{$search}%"); });
            $query->orWhereHas('user', function ($q) use ($search) { return $q->where('name', 'LIKE', "%{$search}%"); });
        })->when($request->event, function ($query, $event) {
            if($event!='*') {
                $query->whereHas('event_trip_booking', function ($q) use ($event) {  return $q->where('booking_event_id', $event);});
            }
        })->when($request->rating, function ($query, $rating) {
            if($rating!='*'){
                $query->where('ratings', $rating);
            }
        })->when($request->author, function ($query, $user) {
            if($user!='*'){
                $query->where('user_id', $user);
            }
        });
        if($special_sort===false){
            $testimonials->orderBy($sort,$sort_type);
        }
        return $testimonials;
    }

    public function create()
    {
        abort_if(Gate::denies('testimonial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event_trip_bookings = EventBooking::pluck('booking_details', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.testimonials.create', compact('event_trip_bookings', 'users'));
    }

    public function store(StoreTestimonialRequest $request)
    {
        $testimonial = Testimonial::create($request->all());

        return redirect()->route('admin.testimonials.index');
    }

    public function edit(Testimonial $testimonial)
    {
        abort_if(Gate::denies('testimonial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event_trip_bookings = EventBooking::pluck('booking_details', 'id')->prepend(trans('global.pleaseSelect'), '');

        $testimonial->load('user', 'event_trip_booking');

        return view('admin.testimonials.edit', compact('event_trip_bookings', 'testimonial', 'users'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $testimonial->update($request->all());

        return redirect()->route('admin.testimonials.index');
    }

    public function show(Testimonial $testimonial)
    {
        abort_if(Gate::denies('testimonial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonial->load('user', 'event_trip_booking');

        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function destroy(Testimonial $testimonial)
    {
        abort_if(Gate::denies('testimonial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonial->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestimonialRequest $request)
    {
        Testimonial::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function export(Request $request){

        $export_type='xlsx';
        if(isset($request->type)&&$request->type!=''){
            $export_type=$request->type;
        }
        if($export_type=='pdf'){
            $testimonials=Testimonial::with(['user', 'event_trip_booking'])->when($request->ids,function ($query, $ids) {
                $query->whereIn('id', explode(',',$ids));
            })->get();
            $model_data=[];
            foreach ($testimonials as $testimonial){

                $model_data[]=[
                    'Review'=>$testimonial->review_text,
                    'Event' =>$testimonial->event_trip_booking->booking_details ?? '',
                    'User'=>$testimonial->user->name.' '.$testimonial->user->lastname,
                    'Rating Stars'=>($testimonial->ratings ?? 0).' Star(s)',
                    'Date'=>$testimonial->review_date
                ];
            }
            $headers=[
                'Review',
                'Event',
                'User',
                'Rating Stars',
                'Date',
            ];
            $data = [
                'title' => 'Testimonials/Reviews',
                'headers'=>$headers,
                'model_data' => $model_data
            ];

            $pdf = PDF::loadView('pdf.exportPDF', $data);

            return $pdf->download('Blog-Export-'.date('m-d-Y').'.pdf');
        }
        if(isset($request->ids)&&$request->ids!=''){
            return (new TestimonialExport)->Ids(explode(',',$request->ids))->download('exported-testimonial-reviews.'.$export_type);
        }
        return Excel::download(new TestimonialExport, 'exported-testimonial-reviews.'.$export_type);

    }
}
