<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li>
            <a href="{{ route('front.home') }}" class="active">Home</a>
        </li>
        @foreach($categoriesLimit as $categoryParent)
            <li class="dropdown">
                <a href="#">{{ $categoryParent->name }}
                    {{-- kiểm tra xem cái nào có con thì mới hiện nút xuống--}}
                    @if($categoryParent->categoryChildren->count())
                        <i class="fa fa-angle-down"></i>
                    @endif
                </a>
                {{-- gọi submenu xử lý riêng--}}
               @include('front.partials.submenu',['categoryParent'=> $categoryParent])
            </li>
        @endforeach
    </ul>
</div>