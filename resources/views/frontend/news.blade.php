@extends('frontend.index')
@section('page_content')
<main class="shop news-blog">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">
                                NEWS BLOG
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($row as $NewsBlogs)
                            <div class="col-3">
                                <figure>
                                    <div class="thumbnail">
                                        <a href="{{route('news.detail',['id'=>$NewsBlogs->id])}}">
                                            <img width="480px" height="350px" src="../assets/image/{{$NewsBlogs->thumbnail}}" alt="">
                                        </a>
                                    </div>
                                    <div class="detail">
                                        <h5 class="title">{{$NewsBlogs->title}}</h5>
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>

@endsection