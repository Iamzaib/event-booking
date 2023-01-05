<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFaqCategoryRequest;
use App\Http\Requests\StoreFaqCategoryRequest;
use App\Http\Requests\UpdateFaqCategoryRequest;
use App\Models\FaqCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FaqCategoryController extends Controller
{
    use MediaUploadingTrait;
    public function index()
    {
        abort_if(Gate::denies('faq_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqCategories = FaqCategory::all();

        return view('admin.faqCategories.index', compact('faqCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('faq_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faqCategories.create');
    }

    public function store(StoreFaqCategoryRequest $request)
    {
        $faqCategory = FaqCategory::create($request->all());
        if ($request->input('featured_image', false)) {
            $faqCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $faqCategory->id]);
        }
        return redirect()->route('admin.faq-categories.index');
    }

    public function edit(FaqCategory $faqCategory)
    {
        abort_if(Gate::denies('faq_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faqCategories.edit', compact('faqCategory'));
    }

    public function update(UpdateFaqCategoryRequest $request, FaqCategory $faqCategory)
    {
        $faqCategory->update($request->all());
        if ($request->input('featured_image', false)) {
            if (!$faqCategory->featured_image || $request->input('featured_image') !== $faqCategory->featured_image->file_name) {
                if ($faqCategory->featured_image) {
                    $faqCategory->featured_image->delete();
                }
                $faqCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($faqCategory->featured_image) {
            $faqCategory->featured_image->delete();
        }

        return redirect()->route('admin.faq-categories.index');
    }

    public function show(FaqCategory $faqCategory)
    {
        abort_if(Gate::denies('faq_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faqCategories.show', compact('faqCategory'));
    }

    public function destroy(FaqCategory $faqCategory)
    {
        abort_if(Gate::denies('faq_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyFaqCategoryRequest $request)
    {
        FaqCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('faq_category_create') && Gate::denies('faq_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new FaqCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
