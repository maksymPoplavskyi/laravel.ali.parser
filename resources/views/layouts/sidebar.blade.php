<div class="sidenav">
    <a href="{{route('shop')}}">Все продукты ({{$products_sum}})</a>
    @foreach($categories_count as $category_name => $category_count)
        <a href="{{route('shop.category', $category_name)}}">{{$category_name}} ({{$category_count}})</a>
    @endforeach
    <a href="{{route('shop.create.view')}}" class="mt-5">Добавить продукт</a>
</div>
