@extends('frontend.master')
@section('title')
    search page
@endsection
@section('page_content')
    <main class="shop">

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        Product Result
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach ($search as $searchProduct)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                @if($searchProduct->sale_price < $searchProduct->regular_price)
                                    <div class="status">
                                        Promotion
                                    </div>
                                @endif
                                <a href="">
                                    <img width="420px" height="350px" src="../assets/image/{{$searchProduct->thumbnail}}" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    @if ($searchProduct->sale_price < $searchProduct->regular_price)
                                        <div class="regular-price "><strike> US {{$searchProduct->regular_price}}</strike></div>
                                        <div class="sale-price ">US {{$searchProduct->sale_price}}</div>
                                    @else
                                        <div class="regular-price "> US {{$searchProduct->regular_price}}</div>
                                        <div class="sale-price d-none">US {{$searchProduct->sale_price}}</div>
                                    @endif
                                </div>
                                <h5 class="title">{{$searchProduct->name}}</h5>
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="main-title">
                        News Result
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <figure>
                        <div class="thumbnail">
                            <a href="">
                                <img src="../assets/image/{{$searchProduct->thumbnail}}" alt="">
                            </a>
                        </div>
                        <div class="detail">
                            <h5 class="title">{{$searchProduct->name}}</h5>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection