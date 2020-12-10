<div class="sidenav" style="width: 200px;">
    <a href="{{route('shop')}}">{{__('navigation.allProducts')}} ({{$productsCount}})</a>
    @foreach($categories as $category)
        <a href="{{route('shop.category', $category->slug)}}">{{$category->value}}
            ({{$category->products()->count()}})</a>
    @endforeach
    <a href="{{route('shop.create.view')}}" class="mt-5">{{__('navigation.addProduct')}}</a>

    <ul class="row fixed-bottom" style="list-style: none; margin-left: 48px;">
        @foreach($localizations as $localization)
            <li class="nav-item">
                <a class="nav-link"
                   href="{{ route('locale', ['locale' => $localization->lang]) }}">{{mb_strtoupper($localization->lang)}}</a>
            </li>
        @endforeach
    </ul>

</div>
