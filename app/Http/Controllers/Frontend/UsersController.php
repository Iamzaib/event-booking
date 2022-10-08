<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventBooking;
use App\Models\Role;
use App\Models\State;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cities=$states= [''=>trans('global.pleaseSelect')];
        $user = User::find(auth()->id());
        if($user->country_id>0){
            $states = State::where('country_id',$user->country_id)->pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }
        if($user->state_id>0) {
            $cities = City::where('state_id',$user->state_id)->pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }
        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $booking=EventBooking::where('booking_by_user_id',Auth::id())->get();


        return view('front.account.account', compact('user','cities', 'countries',  'states'));
    }

//    public function create()
//    {
//        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//
//        $cities = City::pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');
//
//        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');
//
//        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
//
//        $roles = Role::pluck('title', 'id');
//
//        return view('frontend.users.create', compact('cities', 'countries', 'roles', 'states'));
//    }
    public function favourite(Request $request){
        $trip=Event::find($request->trip_id);
        if(isset($trip->id)){
            $trip_check=Auth::user()->favourite_trips()->where('id',$trip->id)->count();
            if($trip_check>0){
                $response=Auth::user()->favourite_trips()->detach($trip->id);
                return response()->json([
                    'status'          => 0,
                    'trip' => $trip->event_title,
                ]);
            }
            $response=Auth::user()->favourite_trips()->sync($trip->id);
            return response()->json([
                'status'          => 1,
                'trip' => $trip->event_title,
            ]);
        }
        return response()->json([
            'status'          => 'Failed',
            'trip' => '',
        ]);
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

        return redirect()->route('frontend.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::pluck('title', 'id');

        $user->load('city', 'state', 'country', 'roles');

        return view('frontend.users.edit', compact('cities', 'countries', 'roles', 'states', 'user'));
    }

    public function update(Request $request, User $user)
    {
//        dd($request->all());
        $validated = $this->validate_user($request);

        $user->update($validated);
//        $user->roles()->sync($request->input('roles', []));
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
//        dd($validated);
        return redirect()->route('frontend.account.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('city', 'state', 'country', 'roles');

        return view('frontend.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
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
    private function validate_user($request){
        return $request->validate([
            'name' => [
                'string',
                'required',
            ],
            'lastname' => [
                'string',
                'nullable',
            ],
            'email' => [
                'required',
                'unique:users,email,' . Auth::id(),
            ],
            'phone' => [
                'string',
                'required',
                'unique:users,phone,' . Auth::id(),
            ],
            'gender' => [
                'string',
                'required',
            ],
            'profileimage' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'required',
            ],
            'address_2' => [
                'string',
                'nullable',
            ],
            'city_id' => [
                'nullable',
                'integer',
            ],
            'state_id' => [
                'required',
                'integer',
            ],
            'country_id' => [
                'required',
                'integer',
            ],
        ]);
    }
}
