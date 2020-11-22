@extends('layouts.html')

@section('title', 'create')

@section('content')

    <h1 class="mx-auto mt-5" style="max-width: 1200px;">{{__('content.createTitle')}}</h1>

    <form style="font-size: 15px; width: 600px;" class="main" method="post" action="{{route('shop.create')}}">
        @csrf

        <div class="form-group">
            <label for="category">{{__('content.form.category')}}</label>
            <select class="form-control" name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
            @error('category_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">{{__('content.form.descriptionEn')}}</label>
            <textarea class="form-control" name="description_en" rows="2">{{old('description_en')}}</textarea>
            @error('description_en')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">{{__('content.form.descriptionRu')}}</label>
            <textarea class="form-control" name="description_ru" rows="2">{{old('description_ru')}}</textarea>
            @error('description_ru')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="row">
            <div class="form-group col">
                <label for="old_price">{{__('content.form.oldPrice')}}, €</label>
                <input type="number" class="form-control" name="old_price" step="0.01" value="{{old('old_price')}}">
                @error('old_price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group col">
                <label for="sales">{{__('content.form.sale')}}, %</label>
                <input type="number" class="form-control" name="sales" value="{{old('sales')}}">
                @error('sales')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="img_url">{{__('content.form.link')}}</label>
            <input type="url" class="form-control" name="img_url"
                   value="https://ae01.alicdn.com/kf/HTB1vvDsXbr1gK0jSZR0q6zP8XXaG/Zogaa-2018.jpg_Q90.jpg_.webp">
            @error('img_url')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="row">
            <div class="form-group col">
                <label for="order_count">{{__('content.form.orders')}}</label>
                <input type="number" class="form-control" name="order_count" value="{{old('order_count')}}">
                @error('order_count')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group col">
                <label for="stock_availability">{{__('content.form.inStock')}}</label>
                <input type="number" class="form-control" name="stock_availability"
                       value="{{old('stock_availability')}}">
                @error('stock_availability')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-group pb-5 mt-5">
            <input type="submit" class="form-control" value="{{__('content.form.createButton')}}">
        </div>

    </form>

@endsection
