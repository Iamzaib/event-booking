<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BlogExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBlogPostRequest;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use PDF;

class BlogPostController extends Controller
{
    use MediaUploadingTrait;


    public function index(Request $request)
    {
        abort_if(Gate::denies('blog_post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $filters=[];
        $filters['categories'] = BlogCategory::pluck('name', 'id')->prepend('Any', '*');

        $filters['tags'] = BlogTag::pluck('name', 'id')->prepend('Any', '*');
        $filters['users'] = User::whereHas('roles', function ($q)  { return $q->where('title','!=', 'User'); })->pluck('name', 'id')->prepend('Any', '*');



        $per_page=$request->per_page??10;
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';
        $blogPosts=$this->modelListingQuery($request)->paginate($per_page,'*','page',($request->page?$request->page:1));
        //$blogPosts->paginate($per_page,'*','page',($request->page?$request->page:1));
        if($request->sorting){
            if($sort_type=='desc'){
                $sort_type='asc';
            }else{
                $sort_type='desc';
            }
        }

        $sort .= '-' . $sort_type;
        return view('admin.blogPosts.index', compact('blogPosts','sort','per_page','sort_type','filters'));
    }
        public function modelListingQuery($request){
//            $per_page=$request->per_page??10;
            $blogPosts=BlogPost::query();
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
            $blogPosts->with($with_Array);
            $blogPosts->when($request->search, function ($query, $search) {
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
            })->when($request->author, function ($query, $user) {
                if($user!='*'){
                    $query->where('user_id', $user);
                }
            });
            if($special_sort===false){
                $blogPosts->orderBy($sort,$sort_type);
            }
            return $blogPosts;
        }
    public function create()
    {
        abort_if(Gate::denies('blog_post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = BlogCategory::pluck('name', 'id');

        $tags = BlogTag::pluck('name', 'id');

        return view('admin.blogPosts.create', compact('categories', 'tags'));
    }

    public function store(StoreBlogPostRequest $request)
    {
        $request->merge(['user_id'=>Auth::id()]);
        $blogPost = BlogPost::create($request->all());
        $blogPost->categories()->sync($request->input('categories', []));
        $blogPost->tags()->sync($request->input('tags', []));
        if ($request->input('featured_image', false)) {
            $blogPost->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $blogPost->id]);
        }

        return redirect()->route('admin.blog-posts.index');
    }

    public function edit(BlogPost $blogPost)
    {
        abort_if(Gate::denies('blog_post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = BlogCategory::pluck('name', 'id');

        $tags = BlogTag::pluck('name', 'id');

        $blogPost->load('categories', 'tags');

        return view('admin.blogPosts.edit', compact('blogPost', 'categories', 'tags'));
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $blogPost)
    {
        $blogPost->update($request->all());
        $blogPost->categories()->sync($request->input('categories', []));
        $blogPost->tags()->sync($request->input('tags', []));
        if ($request->input('featured_image', false)) {
            if (!$blogPost->featured_image || $request->input('featured_image') !== $blogPost->featured_image->file_name) {
                if ($blogPost->featured_image) {
                    $blogPost->featured_image->delete();
                }
                $blogPost->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($blogPost->featured_image) {
            $blogPost->featured_image->delete();
        }

        return redirect()->route('admin.blog-posts.index');
    }

    public function show(BlogPost $blogPost)
    {
        abort_if(Gate::denies('blog_post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogPost->load('categories', 'tags');

        return view('admin.blogPosts.show', compact('blogPost'));
    }

    public function destroy(BlogPost $blogPost)
    {
        abort_if(Gate::denies('blog_post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogPost->delete();

        return back();
    }

    public function massDestroy(MassDestroyBlogPostRequest $request)
    {
        BlogPost::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('blog_post_create') && Gate::denies('blog_post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BlogPost();
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
                $blogs=BlogPost::with(['categories','tags', 'media'])->when($request->ids,function ($query, $ids) {
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
                    'Author'=>$blog->user->name.' '.$blog->user->lastname,
                ];
            }
            $headers=[
                'Title',
                'Excerpt',
                'Categories',
                'Tags',
                'Author',
            ];
            $data = [
                'title' => 'Blog Posts',
                'headers'=>$headers,
                'model_data' => $model_data
            ];

            $pdf = PDF::loadView('pdf.exportPDF', $data);

            return $pdf->download('Blog-Export-'.date('m-d-Y').'.pdf');
        }
        if(isset($request->ids)&&$request->ids!=''){
            return (new BlogExport)->Ids(explode(',',$request->ids))->download('exported-blog-posts.'.$export_type);
        }
        return Excel::download(new BlogExport, 'exported-blog-posts.'.$export_type);

    }
}
