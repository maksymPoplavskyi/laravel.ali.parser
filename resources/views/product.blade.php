@extends('layouts.html')

@section('title', $product->description)

@section('content')

    <h1 class="mx-auto mt-5" style="max-width: 1200px;">VIEW PRODUCT</h1>

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
                        количество заказов: {{$product->order_count}}
                    </div>
                    <div class="col">
                        количество на складе: {{$product->stock_availability}}
                    </div>
                </div>
                <div class="row mt-5 text-right" style="opacity: 0.7; ">
                    <div class="col">
                        <p style="font-size: 20px;">дата
                            добавления: {{date('Y-m-d', strtotime($product->created_at))}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-5">
            <div class="btn-group">
                <a href="{{route('shop.update.view', [$product->category_name, $product->id])}}"
                   class="btn btn-sm btn-outline-secondary">Edit</a>
                <a href="{{route('shop.delete', [$product->category_name, $product->id])}}"
                   class="btn btn-sm btn-outline-secondary">Delete</a>
            </div>
        </div>

    </div>


@endsection
