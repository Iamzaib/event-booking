<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStateRequest;
use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Models\Country;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('state_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $filters['countries'] = Country::pluck('name', 'id')->prepend('Any', '*');
        $per_page=$request->per_page??10;
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';
        $states = $this->modelListingQuery($request)->paginate($per_page,'*','page',($request->page?$request->page:1));
        if($request->sorting){
            if($sort_type=='desc'){
                $sort_type='asc';
            }else{
                $sort_type='desc';
            }
        }
        //$states = State::with(['country'])->get();

        return view('admin.states.index', compact('states','sort','per_page','sort_type','filters'));
    }
    public function modelListingQuery($request)
    {
        $states = State::query();
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';
        $special_sort=true;
        if($sort=='country'){
            $with_Array=['country'=>function ($query) use ($sort_type) {
                $query->orderBy('name', $sort_type);
            }];
        }else{
            $with_Array=['country'];
            $special_sort=false;
        }
        $states->with($with_Array)->when($request->search, function ($query, $search) {
            $query->where('state_name', 'LIKE', "%{$search}%");
            $query->orWhereHas('country', function ($q) use ($search) { return $q->where('name', 'LIKE', "%{$search}%"); });
        })->when($request->country, function ($query, $country) {
            if(is_numeric($country)&&$country!='*') {
                $query->whereHas('country', function ($q) use ($country) {  return $q->where('id', $country);});
            }
        });
        if($special_sort===false){
            $states->orderBy($sort,$sort_type);
        }
        return $states;
    }

    public function create()
    {
        abort_if(Gate::denies('state_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.states.create', compact('countries'));
    }

    public function store(StoreStateRequest $request)
    {
        $state = State::create($request->all());

        return redirect()->route('admin.states.index');
    }

    public function edit(State $state)
    {
        abort_if(Gate::denies('state_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $state->load('country');

        return view('admin.states.edit', compact('countries', 'state'));
    }

    public function update(UpdateStateRequest $request, State $state)
    {
        $state->update($request->all());

        return redirect()->route('admin.states.index');
    }

    public function show(State $state)
    {
        abort_if(Gate::denies('state_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $state->load('country');

        return view('admin.states.show', compact('state'));
    }

    public function destroy(State $state)
    {
        abort_if(Gate::denies('state_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $state->delete();

        return back();
    }

    public function massDestroy(MassDestroyStateRequest $request)
    {
        State::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function get_by_country(Request $request)
    {
        abort_if(Gate::denies('state_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!$request->country_id) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
            $states = State::where('country_id', $request->country_id)->get();
            foreach ($states as $state) {
                $html .= '<option value="'.$state->id.'">'.$state->state_name.'</option>';
            }
        }
        return response()->json(['html' => $html]);
    }
}
