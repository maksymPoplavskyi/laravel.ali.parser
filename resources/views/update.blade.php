@extends('layouts.html')

@section('title', $product->description)

@section('content')

    <h1 class="mx-auto mt-5" style="max-width: 1200px;">UPDATE PRODUCT</h1>
    <div class="row main">

        <form style="font-size: 15px; width: 600px;" class="col" method="post" action="{{route('shop.update', $product->id)}}">
            @csrf

            <div class="form-group">
                <label for="category">категория</label>
                <select class="form-control" name="category_id">
                    @foreach($categories as $category)
                        <option {{($category->name === $product->category_name) ? "selected='selected'" : ''}}
                        value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">описание</label>
                <textarea class="form-control" name="description" rows="2">{{$product->description}}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="old_price">старая цена, €</label>
                    <input type="number" class="form-control" name="old_price" step="0.01"
                           value="{{$product->old_price}}">
                    @error('old_price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group col">
                    <label for="price">новая цена, €</label>
                    <input type="number" class="form-control" name="price" step="0.01" value="{{$product->price}}">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group col">
                    <label for="sales">скидка, %</label>
                    <input type="number" class="form-control" name="sales" value="{{$product->sales}}">
                    @error('sales')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="img_url">ссылка на картинку</label>
                <input type="url" class="form-control" name="img_url"
                       value="{{$product->img_url}}">
                @error('img_url')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="order_count">количество продаж</label>
                    <input type="number" class="form-control" name="order_count" value="{{$product->order_count}}">
                    @error('order_count')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group col">
                    <label for="stock_availability">в стоке</label>
                    <input type="number" class="form-control" name="stock_availability"
                           value="{{$product->stock_availability}}">
                    @error('stock_availability')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group pb-5 mt-5">
                <input type="submit" class="form-control" value="обновить">
            </div>

        </form>
        <div class="col">

            <h1 class="mx-auto mt-5" style="width: 400px;">PREVIEW PRODUCT</h1>

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
            </div>
        </div>
    </div>

@endsection
