@extends('frontend.master')
@section('page_content')
<main class="home">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">
                                NEW PRODUCTS
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($listLatestProduct as $listProductItem)
                            <div class="col-3">
                                <figure>
                                    <div class="thumbnail">
                                        <!-- <div class="status">
                                            Promotion
                                        </div> -->
                                        <a href="{{route('product.detail',['id'=>$listProductItem->id])}}">
                                            <img width="350px" height="370px" src="../assets/image/{{$listProductItem->thumbnail}}" alt="">
                                        </a>
                                    </div>
                                    <div class="detail">
                                        <div class="price-list"> 
                                            @if ($listProductItem -> sale_price < $listProductItem -> regular_price)                                               
                                                <div class="regular-price "><strike> US {{$listProductItem -> regular_price}}</strike></div>
                                                <div class="sale-price ">US {{$listProductItem -> sale_price}}</div>
                                            @else
                                                 <div class="regular-price">US {{$listProductItem -> regular_price}}</div>
                                                 <div class="sale-price d-none"> US{{$listProductItem -> sale_price}}</div>
                                            @endif
                                        </div>
                                        <h5 class="title">{{$listProductItem->name}}</h5>
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">
                                PROMOTION PRODUCTS
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                       @foreach ($listPromotionProduct as $listPromotionProductItem)
                            <div class="col-3">
                                <figure>
                                    <div class="thumbnail">
                                        @if ($listPromotionProductItem->sale_price < $listPromotionProductItem->regular_price)
                                            <div class="status">Promotion</div>
                                        @endif
                                        <a href="">
                                            <img width="450px" height="370px" src="../assets//image/{{$listPromotionProductItem->thumbnail}}" alt="">
                                        </a>
                                    </div>
                                    <div class="detail">
                                        <div class="price-list">
                                            @if ($listPromotionProductItem->sale_price < $listPromotionProductItem->regular_price)
                                                <div class="regular-price "><strike> US {{$listPromotionProductItem->regular_price}}</strike></div>
                                                <div class="sale-price ">US {{$listPromotionProductItem->sale_price}}</div>
                                            @else
                                                <div class="regular-price "> US {{$listPromotionProductItem->regular_price}}</div>
                                                <div class="sale-price d-none">US 12</div>
                                            @endif   
                                        </div>
                                        <h5 class="title">{{$listPromotionProductItem->name}}</h5>
                                    </div>
                                </figure>
                            </div>
                       @endforeach
                    </div>
                </div>
            </section>  

            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">
                                POPULAR PRODUCTS
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($PopularProduct as $PopularProductItem)
                            <div class="col-3">
                                <figure>
                                    <div class="thumbnail">
                                        <!-- <div class="status">
                                            Promotion
                                        </div>  -->
                                        <a href="">
                                            <img width="450px" height="370px" src="../assets/image/{{$PopularProductItem->thumbnail}}" alt="">
                                        </a>
                                    </div>
                                    <div class="detail">
                                        <div class="price-list">
                                            @if ($PopularProductItem->sale_price < $PopularProductItem->regular_price)
                                                <div class="regular-price "><strike> US {{$PopularProductItem->regular_price}}</strike></div>
                                                <div class="sale-price ">US {{$PopularProductItem->sale_price}}</div>
                                            @else
                                                <div class="regular-price "> US {{$PopularProductItem->regular_price}}</div>
                                                <div class="sale-price d-none">US {{$PopularProductItem->sale_price}}</div>
                                            @endif
                                        </div>
                                        <h5 class="title">{{$PopularProductItem->name}}</h5>
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

        </main>  
@endsection