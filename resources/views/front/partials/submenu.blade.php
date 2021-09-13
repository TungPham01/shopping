@if($categoryParent->categoryChildren->count())
    <ul role="menu" class="sub-menu">
        {{-- lấy ra các con của nó thông qua  categoryChildren--}}
        @foreach($categoryParent->categoryChildren as $categoryChild)
            <li>
                <a href="shop.html">{{ $categoryChild->name }}</a>
                {{-- kiểm tra xem còn con ko --}}
                {{-- nếu có lặp tiếp đệ quy gọi lại include, truyền thông qua biến cha item của nó--}}
                @if($categoryChild->categoryChildren->count())
                    @include('front.partials.submenu',['categoryParent'=> $categoryChild])
                @endif
            </li>
        @endforeach
    </ul>
@endif