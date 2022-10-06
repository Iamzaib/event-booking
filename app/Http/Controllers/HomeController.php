<?php

namespace App\Http\Controllers;

use App\Models\ContentPage;
use App\Models\Event;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private Request $request;

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['page_name']='home';
        $data['featured_trips']=Event::where('event_start','>',date('Y-m-d'))
            ->orderBy('event_start','asc')->limit(3)->get();
        return view('front.home.index',$data);
    }
    public function trips(){
        $sort='id';$sort_type='desc';
        if(isset($this->request->sort)&&$this->request->sort!=''){
            if($this->request->sort=='Recent'){$sort='event_start';}
            elseif($this->request->sort=='expensive'){$sort='daily_price';$sort_type='desc';}
            elseif($this->request->sort=='Cheapest'){$sort='daily_price';$sort_type='asc';}
        }
        $data['trips']=Event::where('event_start','>',date('Y-m-d'))
            ->orderBy($sort,$sort_type)->paginate(10);
        if ($this->request->ajax()) {
            $html = '';

            foreach ($data['trips'] as $trip) {
                $html.=$this->trip_list_page_html($trip);

            }

            $response['total']=$data['trips']->total();
            $response['html']=$html;
            return response()->json($response);
        }
        return view('front.trips.trips',$data);
    }
    public function help()
    {
        $data['page_name']='help center';
        $data['faq_categories']=$faq_categories=FaqCategory::all();
        foreach ($faq_categories as $faq_category){
            $faq[$faq_category->id]=FaqQuestion::where('category_id',$faq_category->id)->get();
        }
        $data['faq']=$faq;
        return view('front.home.help_center',$data);
    }
    public function page($page_name,$pID)
    {
        $data['page_name']=$page_name;
        $data['page'] = ContentPage::find($pID);
        if(!isset($data['page']->title)){
            return abort(404);
        }
        return view('front.home.page_view',$data);
    }
    private function trip_list_page_html($trip){
        $html= '<div class="listrips">
                            <div class="box_grid">
                                <figure>

                                    <a href="'.route('frontend.trip_view',['trip_title'=>$trip->event_title,'event'=>$trip->id]).'">
                                        <img src="'. ($trip->featured_image?$trip->featured_image->getUrl():asset('assets/front/img/tour_1.jpg')).'" class="img-fluid" alt="" width="800" height="533"></a>
                                    <small>You save $67</small>
                                </figure>
                            </div>
                            <div class="listguyb4">
                                <small>'.$trip->city->city_name.', '.$trip->country->name.'</small>
                                <h2>'.$trip->event_title.'</h2>';
                                $html.='<div class="listrippriceinclude">
                                    <span>the price includes:</span>
                                    <div class="benefit-icon-box d-flex">';
                                        foreach($trip->amenities_includeds as $amenities_included){
                                            if($amenities_included->icon){
                                                $html.=' <div class="benefit-icon">
                                                    <div title="'.$amenities_included->title.'"><img src="'.$amenities_included->icon->getUrl().'" alt=""></div>
                                                </div>';
                                            }
                                        }
                                    $html.='</div>
                                </div>';

                              $html.='  <div class="listripbotm" style="position: relative;">
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <span class="sdghhhhh colorli">'.$trip->event_start.' - '.$trip->event_end.'</span>
                                        </div>
                                        <div class="col-md-4 col-4" style="padding: 0px;">
                                            <div class="mavUYJ" style="bottom: unset;">
                                                <small class="price colorli">Price per person from</small>
                                                <div class="pricehp mbgu6">

                                                    <small>'.display_currency($trip->daily_price).'</small>
                                                    <h4>'.display_currency($trip->daily_price).'</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gobtnbyug">
                                    <a href="'.route('frontend.trip_view',['trip_title'=>$trip->event_title,'event'=>$trip->id]).'" class="btn_1 btngrad">Watch the trip</a>
                                </div>
                            </div>
                        </div>';
                              return $html;
    }
}
