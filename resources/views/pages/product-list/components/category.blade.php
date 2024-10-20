<ul class="p-0 m-0">
    @foreach($children as $child)
    <li class="list-unstyled">
        <a href="{{ route('category.detail', ['url' => @$child['url']]) }}" class="color-title d-flex align-items-center small">
            <i class="bi bi-chevron-left d-flex me-1"></i>
            {{@$child['title']}}
        </a>
    </li>
    @endforeach

</ul>