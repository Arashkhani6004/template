@if(count($services) > 0)
<div class="related-service mt-4">
                        <p class="font-bold color-title mb-2">خدمات مرتبط</p>
                        <ul class="p-0 m-0">
                        @foreach($services as $service)
                            <li class="list-unstyled related-item">
                                <a href="{{ route('service.detail', ['url' => $service['url']]) }}" class="d-flex align-items-center color-title font-re">
                                    <i class="bi bi-caret-left-fill me-1 d-flex color-title"></i>
                                    {{$service['title']}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
@endif
