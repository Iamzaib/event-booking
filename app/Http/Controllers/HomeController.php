<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\ContentPage;
use App\Models\Event;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use App\Models\Newsletter;
use App\Models\User;
use App\Notifications\ContactEmailNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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
    public function contact(Request $request){
        $data['success']='';
        if(isset($request->firstname)){
            $validated=$request->validate([
                    'firstname' => [
                        'string',
                        'required',
                    ],
                    'lastname' => [
                        'string',
                        'required',
                    ],
                    'email' => [
                        'required',
                    ],
                    'message' => [
                        'required',
                    ],
                ]);
            $users = User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
             Notification::send($users, new ContactEmailNotification((object)$validated));
             $data['success']='Message sent successfully';
        }
        return view('front.others.contact',$data);
    }
    public function trips(){

        $data['trips']=$this->trips_query($this->request)->paginate(10);
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
    private function trips_query($RQ){

        $sort='id';$sort_type='desc';
        if(isset($RQ->sort)&&$RQ->sort!=''){
            if($RQ->sort=='Recent'){$sort='event_start';}
            elseif($RQ->sort=='expensive'){$sort='daily_price';$sort_type='desc';}
            elseif($RQ->sort=='Cheapest'){$sort='daily_price';$sort_type='asc';}
        }
        $events=Event::query();
        $events->where('event_start','>',date('Y-m-d'));
        $events->when($RQ->search, function ($query, $search) {
            $query->where('event_title', 'LIKE', "%{$search}%");
            $query->orWhere('overview', 'LIKE', "%{$search}%");
            $query->orWhere('information', 'LIKE', "%{$search}%");
            $query->orWhere('event_start', 'LIKE', "%{$search}%");
            $query->orWhere('event_end', 'LIKE', "%{$search}%");
            $query->orWhereHas('country', function ($q) use ($search) { return $q->where('name', 'LIKE', "%{$search}%"); });
            $query->orWhereHas('state', function ($q) use ($search) { return $q->where('state_name', 'LIKE', "%{$search}%"); });
            $query->orWhereHas('city', function ($q) use ($search) { return $q->where('city_name', 'LIKE', "%{$search}%"); });
        });

           $events->orderBy($sort,$sort_type);
           return $events;
    }
    public function help($name='',$category=null)
    {
        $data['page_name']='help center';
        $data['faq_categories']=$faq_categories=FaqCategory::when($category, function ($query, $category) {
            return $query->where('id',$category);
        })->get();
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
    public function blogs($name='',$id='')
    {

        if($name!=''&&$id!=''){
            $data['page_name']=$name;
            $data['blog'] =$blog= BlogPost::find($id);
            if(!isset($data['blog']->title)){
                return abort(404);
            }
            $categories=[];
            foreach ($blog->categories as $category){$categories[]=$category->id; }
            $data['other_blogs']=BlogPost::where('id','!=',$id)->limit(3)->get();
//            dd($data);
            return view('front.blog.view',$data);
        }
        $data['page_name']=$name;
        $data['blogs'] = BlogPost::paginate(8);
        return view('front.blog.list',$data);
    }
//    function newsletter($do='',$token=''){
//        if($do=='unsubscribe'&&$token==''){
//            $id=base64_decode($token);
//            Newsletter::find($id)->delete();
//            return redirect()->route('home')->with('message','Unsubscribed from newsletter successfully');
//        }elseif(isset($this->request->email)){
//            $nl_create=['email'=>$this->request->email,
//                'subscribe_date'=>date(config('panel.date_format') . ' ' . config('panel.time_format'))];
//            if(Auth::check()){
//                $nl_create['user_id']=Auth::id();
//            }
//            $new=Newsletter::create($nl_create);
//            Mail::to($this->request->email)->send(new \App\Mail\Newsletter($new));
////            dd($new);
//        }
//        return redirect()->back()->with('message','Subscribed for newsletter successfully');
//    }
    private function trip_list_page_html($trip){
        $html= '<div class="listrips">
                            <div class="box_grid">
                                <figure>

                                    <a href="'.route('frontend.trip_view',['trip_title'=>str_replace(' ','-',$trip->event_title),'event'=>$trip->id]).'">
                                        <img src="'. ($trip->featured_image?$trip->featured_image->getUrl():asset('assets/front/img/tour_1.jpg')).'" class="img-fluid" alt="" width="800" height="533"></a>

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


                                                    <h4>'.display_currency($trip->daily_price*$trip->duration).'</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gobtnbyug">
                                    <a href="'.route('frontend.trip_view',['trip_title'=>str_replace(' ','-',$trip->event_title),'event'=>$trip->id]).'" class="btn_1 btngrad">View Trip</a>
                                </div>
                            </div>
                        </div>';
                              return $html;
    }
}
