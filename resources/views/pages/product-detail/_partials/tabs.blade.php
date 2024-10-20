<div class="tabs mt-5">
    <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" onclick="updateTextColorActive();" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">توضیحات</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" onclick="updateTextColorActive();" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">مشخصات</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" onclick="updateTextColorActive();" id="video-tab" data-bs-toggle="tab" data-bs-target="#video-tab-pane" type="button" role="tab" aria-controls="video-tab-pane" aria-selected="false">ویدیو و
                تیزر</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" onclick="updateTextColorActive();" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq-tab-pane" type="button" role="tab" aria-controls="faq-tab-pane" aria-selected="false">سوالات
                متداول</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" onclick="updateTextColorActive();" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">نظرات</button>
        </li>
    </ul>
    <div class="tab-content bg-white p-3 rounded-4 mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            @include('pages.product-detail._partials.tabs.description')
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            @include('pages.product-detail._partials.tabs.specifications')
        </div>
        <div class="tab-pane fade" id="video-tab-pane" role="tabpanel" aria-labelledby="video-tab" tabindex="0">
            @include('pages.product-detail._partials.tabs.videos')
        </div>
        <div class="tab-pane fade" id="faq-tab-pane" role="tabpanel" aria-labelledby="faq-tab" tabindex="0">
            @include('pages.product-detail._partials.tabs.faq')
        </div>
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            @include('layouts.common.comment._partials.comment-base',['commentable_id'=>$product['id'],'commentable_type'=>get_class($product)])

        </div>
    </div>
</div>
