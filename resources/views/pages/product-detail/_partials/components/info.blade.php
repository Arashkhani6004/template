<h1 class="mb-sm-0 mb-1 fw-bold color-title ">
    {{@$product['title']}}
</h1>
<div class="category d-flex align-items-center mb-1">
    @if(count($categories) > 0)
        دسته بندی :
    @endif
    @foreach($categories as $category)
        <a href="{{ route('category.detail', ['url' => $category['url']]) }}"
           class="font-bold m-0 font-small color-title">
            <span class="font-re">  {{@$category['title']}}</span>
        </a>@if(!$loop->last)
            ،
        @endif
    @endforeach
    <span class="mx-2 color-title op-lighter font-th">|</span>
    @if($brand)
        <a href="{{ route('brand.detail', ['url' => $brand['url']]) }}" class="font-bold m-0 font-small color-title">
            برند : <span class="font-re">{{@$brand['title']}}</span>
        </a>
    @endif
</div>
