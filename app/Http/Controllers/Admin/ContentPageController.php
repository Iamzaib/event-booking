<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ContentPagesExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContentPageRequest;
use App\Http\Requests\StoreContentPageRequest;
use App\Http\Requests\UpdateContentPageRequest;
use App\Models\ContentCategory;
use App\Models\ContentPage;
use App\Models\ContentTag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ContentPageController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('content_page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $filters=[];
        $filters['categories'] = ContentCategory::pluck('name', 'id')->prepend('Any', '*');

        $filters['tags'] = ContentTag::pluck('name', 'id')->prepend('Any', '*');
        //$filters['users'] = User::whereHas('roles', function ($q)  { return $q->where('title','!=', 'User'); })->pluck('name', 'id')->prepend('Any', '*');



        $per_page=$request->per_page??10;
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';
        $contentPages=$this->modelListingQuery($request)->paginate($per_page,'*','page',($request->page?$request->page:1));
        //$blogPosts->paginate($per_page,'*','page',($request->page?$request->page:1));
        if($request->sorting){
            if($sort_type=='desc'){
                $sort_type='asc';
            }else{
                $sort_type='desc';
            }
        }

        $sort .= '-' . $sort_type;
        //$contentPages = ContentPage::with(['categories', 'tags', 'media'])->get();

        return view('admin.contentPages.index', compact('contentPages','sort','per_page','sort_type','filters'));
    }
    public function modelListingQuery($request){
//            $per_page=$request->per_page??10;
        $contentPages=ContentPage::query();
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';

        $special_sort=true;
        if($sort=='category'){
            $with_Array=['categories'=>function ($query) use ($sort_type) {
                $query->orderBy('name', $sort_type);
            },'tags', 'media' ];
        }elseif($sort=='tag'){
            $with_Array=['tags'=>function ($query) use ($sort_type) {
                $query->orderBy('name', $sort_type);
            }, 'categories', 'media'];
        }else{
            $with_Array=['categories','tags', 'media'];
            $special_sort=false;
        }
        $contentPages->with($with_Array);
        $contentPages->when($request->search, function ($query, $search) {
            $query->where('title', 'LIKE', "%{$search}%");
            $query->orWhere('page_text', 'LIKE', "%{$search}%");
            $query->orWhere('excerpt', 'LIKE', "%{$search}%");
            $query->orWhereHas('categories', function ($q) use ($search) { return $q->where('name', 'LIKE', "%{$search}%"); });
            $query->orWhereHas('tags', function ($q) use ($search) { return $q->where('name', 'LIKE', "%{$search}%"); });
        })->when($request->category, function ($query, $category) {
            if($category!='*') {
                $query->whereHas('categories', function ($q) use ($category) {  return $q->where('id', $category);});
            }
        })->when($request->tag, function ($query, $tag) {
            if($tag!='*'){
                $query->whereHas('tags', function ($q) use ($tag) { return $q->where('id', $tag); });
            }
        });
        if($special_sort===false){
            $contentPages->orderBy($sort,$sort_type);
        }
        return $contentPages;
    }
    public function create()
    {
        abort_if(Gate::denies('content_page_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::pluck('name', 'id');

        $tags = ContentTag::pluck('name', 'id');

        return view('admin.contentPages.create', compact('categories', 'tags'));
    }

    public function store(StoreContentPageRequest $request)
    {
        $contentPage = ContentPage::create($request->all());
        $contentPage->categories()->sync($request->input('categories', []));
        $contentPage->tags()->sync($request->input('tags', []));
        if ($request->input('featured_image', false)) {
            $contentPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contentPage->id]);
        }

        return redirect()->route('admin.content-pages.index');
    }

    public function edit(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::pluck('name', 'id');

        $tags = ContentTag::pluck('name', 'id');

        $contentPage->load('categories', 'tags');

        return view('admin.contentPages.edit', compact('categories', 'contentPage', 'tags'));
    }

    public function update(UpdateContentPageRequest $request, ContentPage $contentPage)
    {
        $contentPage->update($request->all());
        $contentPage->categories()->sync($request->input('categories', []));
        $contentPage->tags()->sync($request->input('tags', []));
        if ($request->input('featured_image', false)) {
            if (!$contentPage->featured_image || $request->input('featured_image') !== $contentPage->featured_image->file_name) {
                if ($contentPage->featured_image) {
                    $contentPage->featured_image->delete();
                }
                $contentPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($contentPage->featured_image) {
            $contentPage->featured_image->delete();
        }

        return redirect()->route('admin.content-pages.index');
    }

    public function show(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentPage->load('categories', 'tags');

        return view('admin.contentPages.show', compact('contentPage'));
    }

    public function destroy(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentPage->delete();

        return back();
    }

    public function massDestroy(MassDestroyContentPageRequest $request)
    {
        ContentPage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('content_page_create') && Gate::denies('content_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ContentPage();
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
            $blogs=ContentPage::with(['categories','tags', 'media'])->when($request->ids,function ($query, $ids) {
                $query->whereIn('id', explode(',',$ids));
            })->get();
            $model_data=[];
            foreach ($blogs as $blog){
                $categories=$tags='';
                foreach ($blog->categories as $category){
                    $categories.=$category->name.', ';
                }foreach ($blog->tags as $tag){
                    $tags.=$tag->name.', ';
                }
                $model_data[]=[
                    'Title'=>$blog->title,
                    'Excerpt'=>$blog->excerpt,
                    'Categories'=>$categories,
                    'Tags'=>$tags,
                    //'Author'=>$blog->user->name.' '.$blog->user->lastname,
                ];
            }
            $headers=[
                'Title',
                'Excerpt',
                'Categories',
                'Tags',
               // 'Author',
            ];
            $data = [
                'title' => 'Content Pages',
                'headers'=>$headers,
                'model_data' => $model_data
            ];

            $pdf = PDF::loadView('pdf.exportPDF', $data);

            return $pdf->download('Pages-Export-'.date('m-d-Y').'.pdf');
        }
        if(isset($request->ids)&&$request->ids!=''){
            return (new ContentPagesExport)->Ids(explode(',',$request->ids))->download('exported-pages.'.$export_type);
        }
        return Excel::download(new ContentPagesExport, 'exported-pages.'.$export_type);

    }
}
