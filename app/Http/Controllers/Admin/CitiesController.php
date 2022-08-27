<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCityRequest;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filters['states'] = ['*'=>'Any'];
        $filters['countries'] = Country::pluck('name', 'id')->prepend('Any', '*');
        if(isset($request->country)&&$request->country!='*') {
            $where['country_id'] = $request->country;
            $filters['states'] = State::where('country_id', $request->country)->pluck('state_name', 'id')->prepend('Any', '*');
        }
        $per_page=$request->per_page??10;
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';
        $cities = $this->modelListingQuery($request)->paginate($per_page,'*','page',($request->page?$request->page:1));
        if($request->sorting){
            if($sort_type=='desc'){
                $sort_type='asc';
            }else{
                $sort_type='desc';
            }
        }

        return view('admin.cities.index', compact('cities','sort','per_page','sort_type','filters'));
    }
    public function modelListingQuery($request)
    {
        $cities = City::query();
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';
        $special_sort=true;
        if($sort=='state'){
            $with_Array=['state'=>function ($query) use ($sort_type) {
                $query->orderBy('state_name', $sort_type);
            }];
        }else{
            $with_Array=['state'];
            $special_sort=false;
        }
        $cities->with($with_Array)->when($request->search, function ($query, $search) {
            $query->where('city_name', 'LIKE', "%{$search}%");
            $query->orWhereHas('state', function ($q) use ($search) { return $q->where('state_name', 'LIKE', "%{$search}%"); });
        })->when($request->state, function ($query, $state) {
            if(is_numeric($state)&&$state!='*') {
                $query->whereHas('state', function ($q) use ($state) {  return $q->where('id', $state);});
            }
        })->when($request->country, function ($query, $country) {
            if(is_numeric($country)&&$country!='*') {
                $query->whereHas('state', function ($q) use ($country) {  return $q->where('country_id', $country);});
            }
        });
        if($special_sort===false){
            $cities->orderBy($sort,$sort_type);
        }
        return $cities;
    }
    public function create()
    {
        abort_if(Gate::denies('city_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cities.create', compact('states'));
    }

    public function store(StoreCityRequest $request)
    {
        $city = City::create($request->all());

        return redirect()->route('admin.cities.index');
    }

    public function edit(City $city)
    {
        abort_if(Gate::denies('city_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $city->load('state');

        return view('admin.cities.edit', compact('city', 'states'));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->all());

        return redirect()->route('admin.cities.index');
    }

    public function show(City $city)
    {
        abort_if(Gate::denies('city_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->load('state');

        return view('admin.cities.show', compact('city'));
    }

    public function destroy(City $city)
    {
        abort_if(Gate::denies('city_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->delete();

        return back();
    }

    public function massDestroy(MassDestroyCityRequest $request)
    {
        City::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function get_by_state(Request $request)
    {
        abort_if(Gate::denies('city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!$request->state_id) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
            $cities = City::where('state_id', $request->state_id)->get();
            foreach ($cities as $city) {
                $html .= '<option value="'.$city->id.'">'.$city->city_name.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }
}
