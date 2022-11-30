<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Role;
use App\Models\State;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Excel;
use PDF;

class AdminController extends Controller
{
    use MediaUploadingTrait;
    public $is_admin=true;
    public function __construct(Request $request)
    {
        if ($request->routeIs('admin.admins.*')) {
            $this->is_admin=true;
        }
    }

    public function index(Request $request)
    {

        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $filters=[];
        $filters['cities'] = ['*'=>'Any']; //City::pluck('city_name', 'id')->prepend('Any', '*');
        $admin=$this->is_admin?'Admin':'';
        $filters['states'] = ['*'=>'Any']; //State::pluck('state_name', 'id')->prepend('Any', '*');



        $per_page=$request->per_page??10;
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';
        $where=$whereLike=[];$where['country_id']=$where['state_id']=$where['city_id']='';
        if(isset($request->country)&&$request->country!='*'){
            $where['country_id']=$request->country;
            $filters['states']= State::where('country_id',$request->country)->whereIn('id', function ($query) {
                $query->select('state_id')->from('users')->groupby('state_id');
            })->pluck('state_name', 'id')->prepend('Any', '*');
            if(is_numeric($request->state)&&$request->state!='*'){
                $filters['cities'] = City::where('state_id',$request->state)->whereIn('id', function ($query) {
                    $query->select('city_id')->from('users')->groupby('city_id');
                })->pluck('city_name', 'id')->prepend('Any', '*');
                $where['state_id']=$request->state;
            }
            if(is_numeric($request->city)&&$request->city!='*'){
                $where['city_id']=$request->city;
            }
        }

        DB::enableQueryLog();
        $users = User::with(['city', 'state', 'country', 'roles', 'media'])
            ->whereHas('roles', function ($q)  { return $q->where('title', ($this->is_admin?'Admin':'User')); })
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%");
                $query->orWhere('lastname', 'LIKE', "%{$search}%");
                $query->orWhere('email', 'LIKE', "%{$search}%");
                $query->orWhere('phone', 'LIKE', "%{$search}%");
            })->when($where['country_id'], function ($query, $country) {
                $query->where('country_id',$country);
            })->when($where['state_id'], function ($query, $state) {
                $query->where('state_id',$state);
            })->when($where['city_id'], function ($query, $city) {
                $query->where('city_id',$city);
            })
            ->orderBy($sort,$sort_type)
            ->paginate($per_page,'*','page',($request->page?$request->page:1));
        $users_countries=User::select('country_id')->whereHas('roles', function ($q)  { return $q->where('title', ($this->is_admin?'Admin':'User')); })->groupby('country_id')->pluck('country_id');
        $filters['countries'] = Country::when($users_countries->toArray(),function ($query,$countries){
            if(count($countries)>=1&&$countries[0]!=''){
                $query->whereIn('id',$countries);
        }
        })->pluck('name', 'id')->prepend('Any', '*');
        $queries=DB::getQueryLog();
//        dd($queries);
        if($request->sorting){
            if($sort_type=='desc'){
                $sort_type='asc';
            }else{
                $sort_type='desc';
            }
        }

        $sort .= '-' . $sort_type;
        return view('admin.admins.index', compact('users','sort','per_page','sort_type','filters','admin'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities=$states= [''=>trans('global.pleaseSelect')];

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id');

        return view('admin.admins.create', compact('cities', 'countries', 'roles', 'states'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('profileimage', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profileimage'))))->toMediaCollection('profileimage');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect()->route('admin.admins.index');
    }

    public function edit(User $admin)
    {
        $user=$admin;
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities=$states= [''=>trans('global.pleaseSelect')];
        if($user->country_id>0){
            $states = State::where('country_id',$user->country_id)->pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }
        if($user->state_id>0) {
            $cities = City::where('state_id',$user->state_id)->pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id');

        $user->load('city', 'state', 'country', 'roles');

        return view('admin.admins.edit', compact('cities', 'countries', 'roles', 'states', 'user'));
    }

    public function update(UpdateUserRequest $request, User $admin)
    {
        $user=$admin;
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('profileimage', false)) {
            if (!$user->profileimage || $request->input('profileimage') !== $user->profileimage->file_name) {
                if ($user->profileimage) {
                    $user->profileimage->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profileimage'))))->toMediaCollection('profileimage');
            }
        } elseif ($user->profileimage) {
            $user->profileimage->delete();
        }

        return redirect()->route('admin.admins.index');
    }

    public function show(User $admin)
    {
        $user=$admin;
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('city', 'state', 'country', 'roles', 'bookingByUserEventBookings');

        return view('admin.admins.show', compact('user'));
    }

    public function destroy(User $admin)
    {
        $user=$admin;
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function export(Request $request){

        $export_type='xlsx';
        if(isset($request->type)&&$request->type!=''){
            $export_type=$request->type;
        }
        if($export_type=='pdf'){

            if(isset($request->ids)&&$request->ids!='') {
                $users = User::with(['city', 'state', 'country', 'roles', 'media'])
                    ->whereHas('roles', function ($q) {
                        return $q->where('title', 'Admin');
                    })
                    ->whereIn('id', explode(',',$request->ids))
                    ->get();
            }else{
                $users = User::with(['city', 'state', 'country', 'roles', 'media'])
                    ->whereHas('roles', function ($q) {
                        return $q->where('title', 'Admin');
                    })
                    ->get();
            }
            $model_data=[];
            foreach ($users as $user){
                $model_data[]=[
                    'Name'=>$user->name.' '.$user->lastname,
                    'Email'=>$user->email,
                    'Phone'=>$user->phone,
                    //'Gender'=>User::GENDER_RADIO[$user->gender] ?? '',
                    //'Address'=>$user->address,
                    'City'=>$user->city->city_name??'',
                    'State'=>$user->state->state_name??'',
                    'Country'=>$user->country->name??'',
                ];
            }
            $headers=[
                'Name',
                'Email',
                'Phone',
                //'Gender',
                //'Address',
                'City',
                'State',
                'Country',
            ];
            $data = [
                'title' => 'Users',
                'headers'=>$headers,
                'model_data' => $model_data
            ];

            $pdf = PDF::loadView('pdf.exportPDF', $data);

            return $pdf->download('Users-Export-'.date('m-d-Y').'.pdf');
        }
        if(isset($request->ids)&&$request->ids!=''){
            return (new UsersExport)->userIds(explode(',',$request->ids))->download('exported-users.'.$export_type);
        }
        return Excel::download(new UsersExport, 'exported-users.'.$export_type);

    }
}
