@extends('frontend.master')
@section('page_content')
<main>
            <main class="shop">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-9">
                                <div class="row">
                                   @foreach ($shop as $shopProductItem)
                                        <div class="col-4">
                                                <figure>
                                                    <div class="thumbnail">
                                                        @if ($shopProductItem->sale_price < $shopProductItem->regular_price)
                                                            <div class="status">
                                                                Promotion
                                                            </div>
                                                        @endif
                                                        <a href="">
                                                            <img width="420px" height="350px" src="../assets/image/{{$shopProductItem->thumbnail}}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="detail">
                                                        <div class="price-list">
                                                            @if ($shopProductItem->sale_price < $shopProductItem->regular_price)
                                                                <div class="regular-price "><strike> US {{$shopProductItem->regular_price}}</strike></div>
                                                                <div class="sale-price ">US {{$shopProductItem->sale_price}}</div>
                                                            @else
                                                                <div class="regular-price "> US {{$shopProductItem->regular_price}}</div>
                                                                <div class="sale-price d-none">US {{$shopProductItem->sale_price}}</div>
                                                            @endif
                                                        </div>
                                                        <h5 class="title">{{$shopProductItem->name}}</h5>
                                                    </div>
                                                </figure>
                                            </div>
                                    
                                   @endforeach
                                    <div class="col-12">
                                        <ul class="pagination">
                                            <li>
                                                <a href="/shop?page=1">1</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 filter">
                                <h4 class="title">Category</h4>
                                <ul>
                                    <li>
                                        <a href="/shop">ALL</a>
                                    </li>
                                    <li>
                                        <a href="/shop?cat=">Men</a>
                                    </li> 
                                    <li>
                                        <a href="/shop?cat=">Women</a>
                                    </li> 
                                    <li>
                                        <a href="/shop?cat=">Girl</a>
                                    </li> 
                                    <li>
                                        <a href="/shop?cat=">Boy</a>
                                    </li> 
                                </ul>
                                
                                <h4 class="title mt-4">Price</h4>
                                <div class="block-price mt-4">
                                <a href="{{ route('shop', ['price' => 'max']) }}">High</a>
                                <a href="{{ route('shop', ['price' => 'min']) }}">Low</a>
                                </div>
            
                                <h4 class="title mt-4">Promotion</h4>
                                <div class="block-price mt-4">
                                    <a href="/shop?promotion=true">Promotion Product</a>
                                </div>
            
                            </div>
                        </div>
                    </div>
                </section>
            
            </main>
        </main>

@endsection