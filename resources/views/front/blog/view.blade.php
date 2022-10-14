@extends('layouts.front')

@section('content')
    <div class="blogpage">
        <div class="container cont2blogdetails">

            <div class="bloghjui" style="text-align: center; margin-left: 0px; width: 100%;">
                @foreach($blog->categories as $category)
                <small>{{$category->name}}</small>
                @endforeach
                <a >{{$blog->title}}</a>
                <div class="blogmetamain" style="justify-content: center; align-items: center;">
                    <span><b>By {{$blog->user->name}}</b></span>
                    <span>|</span>
                    <span>{{date('M d,Y',strtotime($blog->created_at))}}</span>
                </div>

                <div class="imgbjjfui">
                    <img src="{{isset($blog->featured_image)?$blog->featured_image->getUrl():asset('assets/front/img/blog1.png')}}" style="width: 100%;" />
                </div>
            </div>

            <div>
                <div class="rich-text w-richtext">
                    {!! $blog->page_text !!}
                </div>
            </div>





        </div>
        <div class="container">
            <div>
                <div class="row">
                    @foreach($other_blogs as $otherblog)
                    <div class="col-md-4">
                        <div class="blogsmdivs">
                            <a href="{{route('blog',['name'=>$otherblog->title,'id'=>$otherblog->id])}}"> <img src="{{isset($otherblog->featured_image)?$otherblog->featured_image->getUrl():asset('assets/front/img/blog1.png')}}" /></a>
                            <a href="{{route('blog',['name'=>$otherblog->title,'id'=>$otherblog->id])}}">  @foreach($otherblog->categories as $category)
                                    <small>{{$category->name}}</small>
                                @endforeach</a>
                            <a href="{{route('blog',['name'=>$otherblog->title,'id'=>$otherblog->id])}}"><h3>{{$otherblog->title}}</h3></a>
                            <p>{{$otherblog->excerpt}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
