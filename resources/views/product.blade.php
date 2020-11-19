@extends('layouts.html')

@section('title', $product->description)

@section('content')

    <h1 class="mx-auto mt-5" style="max-width: 1200px;">{{__('content.productTitle')}}</h1>

    <div class="container mt-5">
        <div class="row">
            <div class="col-4">
                <img class="img-fluid" src="{{$product->img_url}}" alt="">
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col">
                        <p style="font-size: 20px;">{{$product->description}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col font-weight-bold">
                        {{$product->price}} €
                    </div>
                    <div class="col font-weight-bold">
                        <s style="opacity: .5">{{$product->old_price}} €</s>
                    </div>
                    <div class="col">
                        <span class="badge badge-danger"
                              style="height: 30px;">{{$product->sales}} %</span>
                    </div>
                </div>
                <div class="row mt-3" style="font-size: 18px;">
                    <div class="col">
                        {{__('content.orders')}}: {{$product->order_count}}
                    </div>
                    <div class="col">
                        {{__('content.inStock')}}: {{$product->stock_availability}}
                    </div>
                </div>
                <div class="row mt-5 text-right" style="opacity: 0.7; ">
                    <div class="col">
                        <p style="font-size: 20px;">{{__('content.dateAdded')}}: {{date('Y-m-d', strtotime($product->created_at))}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex mt-5">
            <a href="{{route('shop.update.view', $product->id)}}"
               class="btn btn-sm btn-outline-secondary">{{__('navigation.edit')}}</a>
            <a href="{{route('shop.delete', $product->id)}}"
               class="btn btn-sm btn-outline-secondary">{{__('navigation.delete')}}</a>
        </div>

    </div>

@endsection
