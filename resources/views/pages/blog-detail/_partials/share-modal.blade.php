<div class="modal fade" id="shareBlog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title " id="exampleModalLabel">اشتراک گذاری</p>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="d-flex align-items-center justify-content-around">
                    <li class="list-unstyled">
                        <a href="https://t.me/share/url?url={{ route('blog.detail', ['url' => $blog['url']]) }}">
                            <i class="bi bi-telegram fs-4 d-flex color-title"></i>
                        </a>
                    </li>
                    <li class="list-unstyled">
                        <a href="https://whatsapp://send?text={{ route('blog.detail', ['url' => $blog['url']]) }}">
                            <i class="bi bi-whatsapp fs-4 d-flex color-title"></i>
                        </a>
                    </li>
                    <li class="list-unstyled">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog.detail', ['url' => $blog['url']]) }}">
                            <i class="bi bi-facebook fs-4 d-flex color-title"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
