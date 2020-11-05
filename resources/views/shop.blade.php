@extends('layouts.html')

@section('title', 'Shop')

@section('content')

    <h1 class="mx-auto mt-5" style="width: 400px;">THIS IS SHOP PAGE</h1>

    <div class="album py-5">
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="card-img-top" src="{{$product->img_url}}">
                            <div class="card-body">
                                <p class="card-text text-truncate">{{$product->description}}</p>
                                <div class="d-flex justify-content-between">
                                    <h3 style="font-weight: 700;">{{$product->price}} €</h3>
                                    <h3 style="font-weight: 700; opacity: .5; text-decoration: line-through">
                                        {{$product->old_price}} €</h3>
                                    <span class="badge badge-danger"
                                          style="height: 30px;">{{$product->sales}} %</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{route('shop.view', [$product->category_name, $product->id])}}"
                                           class="btn btn-sm btn-outline-secondary">View</a>
                                        <a href="{{route('shop.update.view', [$product->category_name, $product->id])}}"
                                            class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <a href="{{route('shop.delete', [$product->category_name, $product->id])}}"
                                            class="btn btn-sm btn-outline-secondary">Delete</a>
                                    </div>
                                    <small class="text-muted">{{date('Y-m-d', strtotime($product->created_at))}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection
