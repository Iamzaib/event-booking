<?php

namespace App\Http\Controllers\Frontend;

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
    public function index()
    {
        abort_if(Gate::denies('blog_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogTags = BlogTag::all();

        return view('frontend.blogTags.index', compact('blogTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('blog_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.blogTags.create');
    }

    public function store(StoreBlogTagRequest $request)
    {
        $blogTag = BlogTag::create($request->all());

        return redirect()->route('frontend.blog-tags.index');
    }

    public function edit(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.blogTags.edit', compact('blogTag'));
    }

    public function update(UpdateBlogTagRequest $request, BlogTag $blogTag)
    {
        $blogTag->update($request->all());

        return redirect()->route('frontend.blog-tags.index');
    }

    public function show(BlogTag $blogTag)
    {
        abort_if(Gate::denies('blog_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.blogTags.show', compact('blogTag'));
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
