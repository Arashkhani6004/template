<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($sitemaps as $sitemap)
        @php
            $route =\Illuminate\Support\Facades\Route::getRoutes()->getByName($sitemap['key']);
        @endphp
        @if(isset($route) && @$route->parameterNames()[0] != "url")
            @if(\App\Library\SiteHelper::checkRedirect(route($sitemap['key'])))
                <url>
                    <loc>{{ route($sitemap['key']) }}</loc>
                    <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                    <priority>{{$sitemap['priority']}}</priority>
                </url>
            @endif
        @elseif(isset($route) && @$route->parameterNames()[0] == "url")
            @if($sitemap['key'] == 'service.detail')
                @foreach($services as $service)
                    @if($service->seoIndex == 0 && !\App\Library\SiteHelper::checkRedirect(route('service.detail',['url'=>$service['url']])))
                        <url>
                            <loc>{{ route('service.detail',['url'=>$service['url']]) }}</loc>
                            <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                            <priority>{{$sitemap['priority']}}</priority>
                        </url>
                    @endif
                @endforeach
            @endif
            @if($sitemap['key'] == 'blog.detail')
                @foreach($blogs as $blog)
                    @if($blog->seoIndex == 0  && !\App\Library\SiteHelper::checkRedirect(route('blog.detail',['url'=>$blog['url']])))
                        <url>
                            <loc>{{ route('blog.detail',['url'=>$blog['url']]) }}</loc>
                            <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                            <priority>{{$sitemap['priority']}}</priority>
                        </url>
                    @endif
                @endforeach
            @endif
            @if($sitemap['key'] == 'blog.list')
                @foreach($blog_categories as $blog_category)
                    @if($blog_category->seoIndex && !\App\Library\SiteHelper::checkRedirect(route('blog.list',['url'=>$blog_category['url']])))
                        <url>
                            <loc>{{ route('blog.list',['url'=>$blog_category['url']]) }}</loc>
                            <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                            <priority>{{$sitemap['priority']}}</priority>
                        </url>
                    @endif
                @endforeach
            @endif
            @if($sitemap['key'] == 'portfolio.detail')
                @foreach($samples as $sample)
                    @if($sample->seoIndex == 0  && !\App\Library\SiteHelper::checkRedirect(route('portfolio.detail',['url'=>@$sample['url']])))
                        <url>
                            <loc>{{route('portfolio.detail',['url'=>@$sample['url']])}}</loc>
                            <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                            <priority>{{$sitemap['priority']}}</priority>
                        </url>
                    @endif
                @endforeach
            @endif
            @if($sitemap['key'] == 'gallery.list')
                @foreach($gallery_categories as $gallery_category)
                    @if($gallery_category->seoIndex == 0 && !\App\Library\SiteHelper::checkRedirect(route('gallery.list',['url'=>$gallery_category['url']])))
                        <url>
                            <loc>{{ route('gallery.list',['url'=>$gallery_category['url']]) }}</loc>
                            <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                            <priority>{{$sitemap['priority']}}</priority>
                        </url>
                    @endif
                @endforeach
            @endif
            @if($sitemap['key'] == 'package.list')
                @foreach($gallery_categories as $gallery_category)
                    @if($gallery_category->seoIndex == 0 && !\App\Library\SiteHelper::checkRedirect(route('gallery.list',['url'=>$gallery_category['url']])))
                        <url>
                            <loc>{{ route('gallery.list',['url'=>$gallery_category['url']]) }}</loc>
                            <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                            <priority>{{$sitemap['priority']}}</priority>
                        </url>
                    @endif
                @endforeach
            @endif
            @if($sitemap['key'] == 'category.list')
                @foreach($product_categories as $product_category)
                    @if($product_category->seoIndex == 0 && !\App\Library\SiteHelper::checkRedirect(route('category.list',['url'=>$product_category['url']])))
                        <url>
                            <loc>{{ route('category.list',['url'=>$product_category['url']]) }}</loc>
                            <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                            <priority>{{$sitemap['priority']}}</priority>
                        </url>
                    @endif
                @endforeach
            @endif
            @if($sitemap['key'] == 'brand.detail')
                @foreach($brands as $brand)
                    @if($brand->seoIndex == 0 && !\App\Library\SiteHelper::checkRedirect(route('brand.detail',['url'=>$brand['url']])))
                        <url>
                            <loc>{{ route('brand.detail',['url'=>$brand['url']]) }}</loc>
                            <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                            <priority>{{$sitemap['priority']}}</priority>
                        </url>
                    @endif
                @endforeach
            @endif
            @if($sitemap['key'] == 'product.detail')
                @foreach($products as $product)
                    @if($product->seoIndex == 0 && !\App\Library\SiteHelper::checkRedirect(route('product.detail',['url'=>$product['url']])))
                        <url>
                            <loc>{{ route('product.detail',['url'=>$product['url']]) }}</loc>
                            <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                            <priority>{{$sitemap['priority']}}</priority>
                        </url>
                    @endif
                @endforeach
            @endif
            @if($sitemap['key'] == 'tag.detail')
                @foreach($tags as $tag)
                    @if($tag->seoIndex == 0 && !\App\Library\SiteHelper::checkRedirect(route('tag.detail',['url'=>$tag['url']])))
                        <url>
                            <loc>{{ route('tag.detail',['url'=>$tag['url']]) }}</loc>
                            <changefreq>{{$sitemap['change_frequency']}}</changefreq>
                            <priority>{{$sitemap['priority']}}</priority>
                        </url>
                    @endif
                @endforeach
            @endif
        @endif
    @endforeach
</urlset>
