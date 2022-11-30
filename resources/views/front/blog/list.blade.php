@extends('layouts.front')

@section('content')
    <div class="margin_80_0">

        <div class="latestnlogdiv">
            <div class="container">
                <h2 class="testimonaldivh2">Latest Blogs</h2>
                <p class="testimonaldivp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ornare euismod lectus velit
                    vitae venenatis nunc tristique morbi dui. Quis.</p>
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-md-4">
                        <div class="blogdivs">
                            <img class="blogimgimg1 pointer-event" style="cursor: pointer" onclick="window.location='{{route('blog',['name'=>$blog->title,'id'=>$blog->id])}}'" src="{{isset($blog->featured_image)?$blog->featured_image->getUrl():asset('assets/front/img/blog1.png')}}" />
                            <div class="btitleandl">
                                <div>
                                    <h2 onclick="window.location='{{route('blog',['name'=>$blog->title,'id'=>$blog->id])}}'">{{$blog->title}}</h2>
                                </div>
                                <div>
                                    <a href="{{route('blog',['name'=>$blog->title,'id'=>$blog->id])}}"><img src="{{asset('assets/front/img/arrowright.svg')}}" /></a>
                                </div>
                            </div>
                            <p>
                                {{$blog->excerpt}}
                            </p>
                        </div>
                    </div>
                        @if($loop->index==2)
                            <div class="col-md-4">
                                <div class="weeklynewsletter">
                                    <img src="{{asset('assets/front/img/Featured icon.svg')}}" />
                                    <form action="{{route('frontend.newsletter')}}" method="post">
                                        @csrf
                                        <h2>Weekly Newsletter</h2>
                                    <input type="email" class="" name="email" placeholder="Enter your email">
                                        <input type="hidden" name="redirect_news" value="blogs">
                                    <p>Read about our <a href="{{route('page_view',['page_name'=>'Privacy-Policy','pID'=>2])}}">privacy policy</a></p>
                                    <button type="submit" class="btn_1 btngrad">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

            </div>
        </div>
    </div>


@endsection
