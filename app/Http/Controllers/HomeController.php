<?php

namespace App\Http\Controllers;

use App\Models\ContentPage;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['page_name']='home';
        return view('front.home.index',$data);
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
}
