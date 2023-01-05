@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.faqCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.faq-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="category">{{ trans('cruds.faqCategory.fields.category') }}</label>
                <input class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" type="text" name="category" id="category" value="{{ old('category', '') }}" required>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqCategory.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="details">Details</label>
                <textarea class="form-control ckeditor {{ $errors->has('details') ? 'is-invalid' : '' }}" name="details" id="details">{!! old('details') !!}</textarea>
                @if($errors->has('details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('details') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="featured_image">Image</label>
                <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
                </div>
                @if($errors->has('featured_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('featured_image') }}
                    </div>
                @endif
                <span class="help-block"></span>
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
        var storeCKEditorImages_url='{{ route('admin.faq-categories.storeCKEditorImages') }}';
        var dropzone_field='featured_image-dropzone',photo_upload_route='{{ route('admin.faq-categories.storeMedia') }}',field_name='featured_image',Maxfiles=1,dropzone=true,
            crud_id='{{ $faqCategory->id ?? 0 }}';
        @if(isset($faqCategory) && $faqCategory->featured_image)
        var image_exists=true;
        var image_src={!! json_encode($faqCategory->featured_image) !!}
    @endif
    </script>
@endsection
