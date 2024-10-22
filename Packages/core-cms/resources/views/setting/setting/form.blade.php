<div class="container-fluid">
    <div class="card-block row w-100 m-0 ">
        <div class="overflow-auto pb-2">
            <nav>
                <ul class="setting-tab nav nav-tabs list-inline" id="nav-tab" role="tablist">
                    @foreach($partials as $key => $partial)
                        <li class="nav-item list-inline-item">
                            <button class="nav-link @if($key == $active_tab_key) active @endif"
                                    id="nav-{{ $key }}-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-{{ $key }}"
                                    type="button" role="tab" aria-controls="nav-{{ @$key }}"
                                    aria-selected="true">{{ @$partial['name'] }}</button>
                        </li>
                    @endforeach
                </ul>

            </nav>
            <div class="tab-content" id="nav-tabContent">
                @foreach($partials as $key => $partial)
                    <div class="tab-pane fade @if($key == $active_tab_key) show active @endif"
                         id="nav-{{ $key }}"
                         role="tabpanel" aria-labelledby="nav-{{ $key }}-tab" tabindex="0">
                        <div class="row w-100 m-0">
                            @if(count($partial['partials']) > 0)
                                @foreach($partial['partials'] as $child)
                                    @if(!$loop->first)
                                        <hr class="mt-0 mb-2">
                                    @endif
                                    <h2>
                                        {{@$child['name']}}
                                    </h2>
                                    @foreach($child['fields'] as $setting)
                                        @php
                                            $options = $setting['options'];
                                            $setting = \Rahweb\CmsCore\Modules\Setting\Entities\Setting::where('key',$setting['key'])->first();
                                        @endphp
                                        @component('CmsCore::setting.setting.inputs.'.@$setting['type'], ['data' => @$setting,'options'=>$options])
                                        @endcomponent
                                    @endforeach
                                @endforeach
                            @else
                                @foreach($partial['fields'] as $setting)
                                    @php
                                        $options = $setting['options'];
                                        $setting = \Rahweb\CmsCore\Modules\Setting\Entities\Setting::where('key',$setting['key'])->first();
                                    @endphp
                                    @component('CmsCore::setting.setting.inputs.'.@$setting['type'], ['data' => @$setting,'options'=>$options])
                                    @endcomponent
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach


            </div>

        </div>
        <div class="pe-3 text-end">
            <button type="submit" class="btn btn-custom rounded-custom w-fit px-4 py-2">
                ذخیره
            </button>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function getNavId(event) {
            event.preventDefault();
            let tab = document.querySelector('.nav-link.active');
            let activeTabId = tab.getAttribute('data-bs-target').substring(1);

            const inputHidden = document.createElement("input");
            inputHidden.setAttribute('name', 'active_tab');
            inputHidden.setAttribute('type', 'hidden');
            inputHidden.setAttribute('value', activeTabId);

            let form = document.getElementById('cms-form');
            form.appendChild(inputHidden);

            form.submit();
        }
    </script>

@endpush
