<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        @foreach($categories as $category)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if($category->categoryChildren->count())
                            <a data-toggle="collapse" data-parent="#accordian" href="#sportswear_{{ $category->id }}">
                            <span class="badge pull-right">
                                <i class="fa fa-plus"></i>
                            </span>
                                {{ $category->name }}
                            </a>
                        @else
                            <a href="{{ route('front.category',['slug'=>$category->slug,'id'=>$category->id]) }}">
                                {{ $category->name }}
                            </a>
                        @endif
                    </h4>
                </div>

                {{-- chỉ có 2 cấp category --}}
                <div id="sportswear_{{ $category->id }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            {{-- duyệt con qua relation--}}
                            @foreach($category->categoryChildren as $child)
                                <li>
                                    <a href="{{ route('front.category',['slug'=>$child->slug,'id'=>$child->id]) }}">
                                        {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!--/category-products-->

</div>