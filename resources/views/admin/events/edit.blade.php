@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.events.update", [$event->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="event_title">{{ trans('cruds.event.fields.event_title') }}</label>
                <input class="form-control {{ $errors->has('event_title') ? 'is-invalid' : '' }}" type="text" name="event_title" id="event_title" value="{{ old('event_title', $event->event_title) }}" required>
                @if($errors->has('event_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.event_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="overview">{{ trans('cruds.event.fields.overview') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('overview') ? 'is-invalid' : '' }}" name="overview" id="overview">{!! old('overview', $event->overview) !!}</textarea>
                @if($errors->has('overview'))
                    <div class="invalid-feedback">
                        {{ $errors->first('overview') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.overview_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="duration">{{ trans('cruds.event.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="text" name="duration" id="duration" value="{{ old('duration', $event->duration) }}">
                @if($errors->has('duration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('duration') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="age">{{ trans('cruds.event.fields.age') }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="text" name="age" id="age" value="{{ old('age', $event->age) }}">
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.age_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="daily_price">{{ trans('cruds.event.fields.daily_price') }}</label>
                <input class="form-control {{ $errors->has('daily_price') ? 'is-invalid' : '' }}" type="number" name="daily_price" id="daily_price" value="{{ old('daily_price', $event->daily_price) }}" step="0.01" required>
                @if($errors->has('daily_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('daily_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.daily_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="featured_image">{{ trans('cruds.event.fields.featured_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
                </div>
                @if($errors->has('featured_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('featured_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.featured_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="information">{{ trans('cruds.event.fields.information') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('information') ? 'is-invalid' : '' }}" name="information" id="information">{!! old('information', $event->information) !!}</textarea>
                @if($errors->has('information'))
                    <div class="invalid-feedback">
                        {{ $errors->first('information') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.information_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="country_id">{{ trans('cruds.event.fields.country') }}</label>
                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                    @foreach($countries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $event->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="state_id">{{ trans('cruds.event.fields.state') }}</label>
                <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id" required>
                    @foreach($states as $id => $entry)
                        <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : $event->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.event.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $event->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="event_start">{{ trans('cruds.event.fields.event_start') }}</label>
                <input class="form-control date {{ $errors->has('event_start') ? 'is-invalid' : '' }}" type="text" name="event_start" id="event_start" value="{{ old('event_start', $event->event_start) }}" required>
                @if($errors->has('event_start'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_start') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.event_start_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="event_end">{{ trans('cruds.event.fields.event_end') }}</label>
                <input class="form-control date {{ $errors->has('event_end') ? 'is-invalid' : '' }}" type="text" name="event_end" id="event_end" value="{{ old('event_end', $event->event_end) }}" required>
                @if($errors->has('event_end'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_end') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.event_end_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hotels">{{ trans('cruds.event.fields.hotels') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('hotels') ? 'is-invalid' : '' }}" name="hotels[]" id="hotels" multiple>
                    @foreach($hotels as $id => $hotel)
                        <option value="{{ $id }}" {{ (in_array($id, old('hotels', [])) || $event->hotels->contains($id)) ? 'selected' : '' }}>{{ $hotel }}</option>
                    @endforeach
                </select>
                @if($errors->has('hotels'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hotels') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.hotels_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="addons">{{ trans('cruds.event.fields.addons') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('addons') ? 'is-invalid' : '' }}" name="addons[]" id="addons" multiple>
                    @foreach($addons as $id => $addon)
                        <option value="{{ $id }}" {{ (in_array($id, old('addons', [])) || $event->addons->contains($id)) ? 'selected' : '' }}>{{ $addon }}</option>
                    @endforeach
                </select>
                @if($errors->has('addons'))
                    <div class="invalid-feedback">
                        {{ $errors->first('addons') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.addons_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amenities_includeds">{{ trans('cruds.event.fields.amenities_included') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('amenities_includeds') ? 'is-invalid' : '' }}" name="amenities_includeds[]" id="amenities_includeds" multiple>
                    @foreach($amenities_includeds as $id => $amenities_included)
                        <option value="{{ $id }}" {{ (in_array($id, old('amenities_includeds', [])) || $event->amenities_includeds->contains($id)) ? 'selected' : '' }}>{{ $amenities_included }}</option>
                    @endforeach
                </select>
                @if($errors->has('amenities_includeds'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amenities_includeds') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.amenities_included_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amenities_excludeds">{{ trans('cruds.event.fields.amenities_excluded') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('amenities_excludeds') ? 'is-invalid' : '' }}" name="amenities_excludeds[]" id="amenities_excludeds" multiple>
                    @foreach($amenities_includeds as $id => $amenities_included)
                        <option value="{{ $id }}" {{ (in_array($id, old('amenities_excludeds', []))|| $event->amenities_excludeds->contains($id)) ? 'selected' : '' }}>{{ $amenities_included }}</option>
                    @endforeach
                </select>
                @if($errors->has('amenities_excludeds'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amenities_excludeds') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.amenities_excluded_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="costumes">{{ trans('cruds.event.fields.costumes') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('costumes') ? 'is-invalid' : '' }}" name="costumes[]" id="costumes" multiple>
                    @foreach($costumes as $id => $costume)
                        <option value="{{ $id }}" {{ (in_array($id, old('costumes', []))||$event->costumes->contains($id)) ? 'selected' : '' }}>{{ $costume }}</option>
                    @endforeach
                </select>
                @if($errors->has('costumes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('costumes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.costumes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="">Itinerary</label>
                <div id="Itinerary">
                    <table class="table" id="Itinerary_fields">
                        <tr>
                            <th>Number</th>
                            <th>Title</th>
                            <th>Details</th>
                            <th>Date/Time</th>
                            <th>Duration</th>
                            <th><span class="btn btn-info" onclick="add_new_Itinerary()">Add New</span></th>
                        </tr>
                        @foreach($event->itinerary as $itinerary)
                        <tr>
                            <td>
                                <input type="text" name="number[]" id="" value="{{$itinerary->number}}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="title[]" id="" value="{{$itinerary->title}}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="details[]" id="" value="{{$itinerary->detail}}" class="form-control">
                            </td>
                            <td>
                                <input type="time" name="datetime[]" id="" value="{{$itinerary->time}}" class="form-control ">
                            </td>
                            <td>
                                <input type="text" name="durations[]" id="" value="{{$itinerary->duration}}" class="form-control">
                            </td>
                            <td>
                                <span class="btn btn-danger" onclick="remove_new_Itinerary(this)">Remove This</span>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                <input type="text" name="number[]" id="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="title[]" id="" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="details[]" id="" class="form-control">
                            </td>
                            <td>
                                <input type="time" name="datetime[]" id="" class="form-control ">
                            </td>
                            <td>
                                <input type="text" name="durations[]" id="" class="form-control">
                            </td>
                            <td>
                                <span class="btn btn-danger" onclick="remove_new_Itinerary(this)">Remove This</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <label for="">FAQs</label>
                <div id="faqs">
                    <table class="table" id="faq_fields">
                        <tr>
                            <th>Question</th>
                            <th>Answer</th>

                            <th><span class="btn btn-info" onclick="add_new_faq()">Add New Faq</span></th>
                        </tr>
                        @foreach($event->faqs as $faq)
                        <tr>
                            <td>
                                <input type="text" name="faq_question[]" id="" value="{{$faq->question}}" class="form-control">
                            </td>
                            <td>
                                <textarea name="faq_answer[]" class="form-control" cols="30" rows="3">{{$faq->answer}}</textarea>
                            </td>
                            <td>
                                <span class="btn btn-danger" onclick="remove_new_Itinerary(this)">Remove This</span>
                            </td>
                        </tr>
                        @endforeach
                            <tr>
                            <td>
                                <input type="text" name="faq_question[]" id="" class="form-control">
                            </td>
                            <td>
                                <textarea name="faq_answer[]" class="form-control" cols="30" rows="3"></textarea>
                            </td>
                            <td>
                                <span class="btn btn-danger" onclick="remove_new_Itinerary(this)">Remove This</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')

<script>
    var storeCKEditorImages_url='{{ route('admin.events.storeCKEditorImages') }}';
    var dropzone_field='featured_image-dropzone',photo_upload_route='{{ route('admin.events.storeMedia') }}',field_name='featured_image',Maxfiles=1,dropzone=true,
        crud_id='{{ $event->id ?? 0 }}';
    @if(isset($event) && $event->featured_image)
    var image_exists=true;
    var image_src={!! json_encode($event->featured_image) !!}
    @endif
    var new_Itinerary=' <tr><td> <input type="text" name="number[]" id="" class="form-control">        </td>' +
        ' <td>        <input type="text" name="title[]" id="" class="form-control">    </td>' +
        ' <td>' +
        '<input type="text" name="details[]" id="" class="form-control">' +
        '</td>' +
        '<td>' +
        '<input type="time" name="datetime[]" id="" class="form-control" >' +
        '</td>' +
        ' <td>' +
        '<input type="text" name="durations[]" id="" class="form-control">' +
        '</td>' +
        '<td>' +
        '<span class="btn btn-danger" onclick="remove_new_Itinerary(this)">Remove This</span>' +
        '</td>' +
        '</tr>';
    function add_new_Itinerary(){
        $('#Itinerary_fields tbody').append(new_Itinerary);
    }
    var new_FAQ=' <tr><td> <input type="text" name="faq_question[]" id="" class="form-control">        </td>' +
        ' <td>        <textarea name="faq_answer[]" class="form-control" cols="30" rows="3"></textarea>    </td>' +
        '<td>' +
        '<span class="btn btn-danger" onclick="remove_new_Itinerary(this)">Remove This</span>' +
        '</td>' +
        '</tr>';
    function add_new_faq(){
        $('#faq_fields tbody').append(new_FAQ);
    }
    function remove_new_Itinerary(btn){
        $(btn).parent().parent().remove();
    }
</script>
@endsection
