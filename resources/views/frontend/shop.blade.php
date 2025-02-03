@extends('frontend.index')
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
                                    @if ($products->hasPages())
                                        <ul class="pagination">
                                            <!-- Previous Page -->
                                            @if (!$products->onFirstPage())
                                                <li><a href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                            @else
                                                <li class="disabled"><span>&laquo;</span></li>
                                            @endif

                                            <!-- Pagination Links -->
                                            {{ $products->links() }}

                                            <!-- Next Page -->
                                            @if ($products->hasMorePages())
                                                <li><a href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                            @else
                                                <li class="disabled"><span>&raquo;</span></li>
                                            @endif
                                        </ul>
                                    @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-3 filter">
                                <h4 class="title">Category</h4>
                                <ul>
                                    <li>
                                        <a href="/shop" class="{{ !$currentCategory ? 'active' : '' }}">ALL</a>
                                    </li>
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="/shop?cat={{ str_replace(' ', '-', strtolower($category->name)) }}"
                                                class="{{ $currentCategory == strtolower(str_replace(' ', '-', $category->name)) ? 'active' : '' }}">
                                                {{ strtoupper($category->name) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                
                                <h4 class="title mt-4">Price</h4>
                                <div class="block-price mt-4">
                                <a href="/shop?price=max">High</a>
                                <a href="/shop?price=min">Low</a>
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