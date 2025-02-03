@extends('frontend.index')
@section('page_content')
<main class="product-detail">

<section class="review">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="thumbnail">
                    <img width="450px" src="../assets/image/{{$row[0]->thumbnail}}" alt="">
                </div>
            </div>
            <div class="col-7">
                <div class="detail">
                    <div class="price-list">
                        @if ($row[0]->sale_price < $row[0] ->regular_price)
                            <div class="regular-price"><strike> US {{$row[0]->regular_price}}</strike></div>
                            <div class="sale-price">US {{$row[0] -> sale_price}}</div>
                        @else
                            <div class="regular-price"> US {{$row[0]->regular_price}}</div>
                            <div class="sale-price d-none">US {{$row[0] -> regular_price}}</div>         
                        @endif
                    </div>
                    <h5 class="title">{{$row[0]->name}}</h5>
                    <div class="group-size">
                        <span class="title">Color Available</span>
                        <div class="group">
                            {{$row[0]->color}}
                        </div>
                    </div>
                    <div class="group-size">
                        <span class="title">Size Available</span>
                        <div class="group">
                            {{$row[0]->size}}
                        </div>
                    </div>
                    <div class="group-size">
                        <span class="title">Description</span>
                        <div class="description">
                            {{ $row[0]->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="main-title">
                    RELATED PRODUCTS
                </h3>
            </div>
        </div>
        <div class="row">
            @foreach ($relatedProduct as $relatedProductItem)
                <div class="col-3">
                    <figure>
                        <div class="thumbnail">
                            @if ($relatedProductItem -> sale_price < $relatedProductItem -> regular_price)
                                <div class="status">Promotion</div>
                            @endif
                            <a href="{{route('product.detail',$relatedProductItem->id)}}">
                                <img width="450px" height="350px" src="../assets/image/{{$relatedProductItem->thumbnail}}" alt="">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="price-list">
                                @if ($relatedProductItem->sale_price < $relatedProductItem->regular_price)
                                    <div class="regular-price "><strike> US {{$relatedProductItem->regular_price}}</strike></div>
                                    <div class="sale-price ">US {{$relatedProductItem->sale_price}}</div>
                                @else
                                    <div class="regular-price">US {{$relatedProductItem->regular_price}}</div>
                                    <div class="sale-price d-none">US {{$relatedProductItem->regular_price}}</div>
                                @endif
                            </div>
                            <h5 class="title">{{$relatedProductItem->name}}</h5>
                        </div>
                    </figure>
                </div>
            @endforeach
        </div>
    </div>
</section>

</main>
@endsection