<div class="sidenav">
    <a href="{{route('shop')}}">{{__('navigation.allProducts')}} ({{$productsCount}})</a>
    @foreach($categories as $category)
        <a href="{{route('shop.category', $category->name)}}">{{$category->name}} ({{$category->products()->count()}})</a>
    @endforeach
    <a href="{{route('shop.create.view')}}" class="mt-5">{{__('navigation.addProduct')}}</a>

    <ul class="row fixed-bottom ml-4" style="list-style: none; vertical-align: bottom">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('locale', ['locale' => 'en']) }}">EN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('locale', ['locale' => 'ru']) }}">RU</a>
        </li>
    </ul>

</div>
