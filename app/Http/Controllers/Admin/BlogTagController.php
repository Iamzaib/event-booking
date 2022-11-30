<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBlogTagRequest;
use App\Http\Requests\StoreBlogTagRequest;
use App\Http\Requests\UpdateBlogTagRequest;
use App\Models\BlogTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogTagController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('blog_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //$blogTags = BlogTag::all();
        $per_page=$request->per_page??10;
        $sort_r=explode('-',$request->sort);
        $sort=isset($sort_r[0])&&$sort_r[0]!=''?$sort_r[0]:'id';
        $sort_type=isset($sort_r[1])&&$sort_r[1]!=''?$sort_r[1]:'desc';
        $blogTags = BlogTag::when($request->search, function ($query, $search) {
            $query->where('name', 'LIKE', "%{$search}%");
            $query->orWhere('slug', 'LIKE', "%{$search}%");
        })->paginate($per_page,'*','page',($request->page?$request->page:1));
        if($request->sorting){
            if($sort_type=='desc'){
                $sort_type='asc';
            }else{
                $sort_type='desc';
            }
        }

        return view('admin.blogTags.index', compact('blogTags','sort','per_page','sort_type'));
    }

    public function create()
    {
        abort_if(Gate::denies('blog_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogTags.create');
    }

    public function store(StoreBlogTagRequest $request)
    {
        $blogTag = BlogTag::create($request->all());

        return redirect()->route('admin.blog-tags.index');
    }

    public function edit(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogTags.edit', compact('blogTag'));
    }

    public function update(UpdateBlogTagRequest $request, BlogTag $blogTag)
    {
        $blogTag->update($request->all());

        return redirect()->route('admin.blog-tags.index');
    }

    public function show(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogTags.show', compact('blogTag'));
    }

    public function destroy(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyBlogTagRequest $request)
    {
        BlogTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
