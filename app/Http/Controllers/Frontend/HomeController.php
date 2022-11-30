<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Event;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController
{
    public function __construct(Request $request)
    {
        $this->request=$request;
    }
    public function index()
    {
        $data['page_name']='home';
        $data['featured_trips']=Event::where('event_start','>',date('Y-m-d'))
            ->orderBy('event_start','asc')->limit(3)->get();
        return view('front.home.index',$data);
    }
    function newsletter($do='',$token=''){
        if($do=='unsubscribe'&&$token=''){
            $id=base64_decode($token);
            if($newsletter=Newsletter::find($id)){
                $newsletter->delete();
                return redirect()->route('home')->with('message','Unsubscribed from newsletter successfully');
            }

        }elseif(isset($this->request->email)){
            $nl_create=['email'=>$this->request->email,
                'subscribe_date'=>date(config('panel.date_format') . ' ' . config('panel.time_format'))];
            if(Auth::check()){
                $nl_create['user_id']=Auth::id();
            }
            $new=Newsletter::create($nl_create);
            Mail::to($this->request->email)->send(new \App\Mail\Newsletter($new));
        }
        return redirect()->route(isset($this->request->redirect_news)?$this->request->redirect_news:'home')->with('message','Subscribed for newsletter successfully');
    }
}
