
@foreach($items as $menu_item)
<li class="@if(!$menu_item->children->isEmpty()) menu-item-has-children @endif"><a href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a>
    @if(!$menu_item->children->isEmpty())
    <ul class="submenu">
        @foreach ($menu_item->children as $children)
        <li><a href="{{$children->link() }}">{{$children->title}}</a></li>
        @endforeach
    </ul>
    @endif
</li>
@endforeach
