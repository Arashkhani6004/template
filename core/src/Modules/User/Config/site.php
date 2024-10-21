<?php
return [
    'admin' => 'admin',
    'panel' => 'panel',
    'permissions' => [

        'dashboard' => [
            'title' => 'داشبورد پنل',
        ],

        'admin' => array(
            'title' => 'مدیران سایت',
            'access' => array(
                'index' => 'مشاهده مدیران',
                'add' => 'اضافه کردن مدیر ',
                'edit' => ' ویرایش مدیر ',
                'delete' => 'حذف مدیر ',
            ),
        ),
        'common' => array(
            'title' => 'مشترکات',
            'access' => array(
                'delete-image' => 'حذف تصاویر چندتایی',
                'remove-image' => 'حذف تصاویر',
                'set-thumb' => 'تصویر شاخص',
                'sort-image' => 'ترتیب تصاویر',
            ),
        ),

        'user' => array(
            'title' => 'کاربران',
            'access' => array(
                'index' => 'مشاهده کاربر',
                'add' => 'اضافه کردن کاربر',
                'edit' => ' ویرایش کاربر',
                'delete' => 'حذف کاربر',
            ),
        ),
        'setting' => array(
            'title' => 'تنظیمات',
            'access' => array(
                'index' => 'مشاهده ',
                'edit' => 'ویرایش ',
                'clear-cache' => 'پاک کردن کش سایت ',
            ),
        ),
        'setting-partial' => array(
            'title' => 'تنظیمات برنامه نویس',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'theme' => array(
            'title' => 'منو و تم',
            'access' => array(
                'index' => 'مشاهده ',
                'edit' => 'ویرایش ',
            ),
        ),
        'comment' => array(
            'title' => 'نظرات',
            'access' => array(
                'index' => 'مشاهده ',
                'edit' => 'ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'contact' => array(
            'title' => 'تماس با ما',
            'access' => array(
                'index' => 'مشاهده ',
                'status' => 'بررسی شد ',
                'delete' => 'حذف ',
            ),
        ),
        'permission' => array(
            'title' => 'دسترسی',
            'access' => array(
                'index' => 'مشاهده دسترسی',
                'add' => 'اضافه دسترسی',
                'edit' => 'ویرایش دسترسی',
                'delete' => 'حذف دسترسی',
            ),
        ),
        'service' => array(
            'title' => 'خدمات',
            'access' => array(
                'index' => 'مشاهده خدمات',
                'create' => 'اضافه کردن خدمات',
                'edit' => ' ویرایش خدمات',
                'delete' => 'حذف خدمات',
                'delete-root' => 'حذف کامل خدمات',
            ),
        ),
        'seo' => array(
            'title' => 'سئو متاها',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'create' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
            ),
        ),
        'redirect' => array(
            'title' => 'ریدایرکت ها',
            'access' => array(
                'index' => 'مشاهده ',
                'create' => 'اضافه کردن ',
                'delete' => 'حذف ',
            ),
        ),
        'canonical' => array(
            'title' => 'کنونیکال',
            'access' => array(
                'index' => 'مشاهده کنونیکال',
                'create' => 'اضافه کردن کنونیکال',
                'edit' => ' ویرایش کنونیکال',
                'delete' => 'حذف کنونیکال',
            ),
        ),
        'blog' => array(
            'title' => 'مطالب',
            'access' => array(
                'index' => 'مشاهده مطالب',
                'create' => 'اضافه کردن مطالب',
                'edit' => ' ویرایش مطالب',
                'delete' => 'حذف مطالب',
            ),
        ),
        'blog-category' => array(
            'title' => 'دسته بندی مطلب',
            'access' => array(
                'index' => 'مشاهده دسته بندی مطلب',
                'create' => 'اضافه کردن دسته بندی مطلب',
                'edit' => ' ویرایش دسته بندی مطلب',
                'delete' => 'حذف دسته بندی مطلب',
            ),
        ),
        'gallery-category' => array(
            'title' => 'دسته بندی تصاویر',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'gallery' => array(
            'title' => 'تصاویر',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'worksample' => array(
            'title' => 'نمونه کارها',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
                'image' => 'تصاویر ',
                'thumbnail' => 'انتخاب تصویر مشخصه ',
                'deleteImage' => 'حذف تصویر ',
                'createImage' => 'اضافه کردن تصویر ',
            ),
        ),
        'fee' => array(
            'title' => 'نرخ ها',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'certificate' => array(
            'title' => 'گواهینامه ها',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'package' => array(
            'title' => 'پکیج ها',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'banner' => array(
            'title' => 'اسلایدر ها (بنر ها)',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'branch' => array(
            'title' => 'شعب',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'social' => array(
            'title' => 'شبکه های اجتماعی',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'course' => array(
            'title' => 'دوره ها',
            'access' => array(
                'index' => 'مشاهده دوره ها',
                'add' => 'اضافه کردن دوره ها',
                'edit' => ' ویرایش دوره ها',
                'delete' => 'حذف دوره ها',
            ),
        ),
        'course-category' => array(
            'title' => 'دسته بندی دوره ها',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'session' => array(
            'title' => 'جلسات',
            'access' => array(
                'index' => 'مشاهده ',
                'add' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
                'order' => 'مرتبط سازی',
            ),
        ),
        'session-file' => array(
            'title' => 'فایل جلسات',
            'access' => array(
                'delete' => 'حذف ',
            ),
        ),
        'product-category' => array(
            'title' => 'دسته بندی محصول',
            'access' => array(
                'index' => 'مشاهده دسته بندی محصول',
                'create' => 'اضافه کردن دسته بندی محصول',
                'edit' => ' ویرایش دسته بندی محصول',
                'delete' => 'حذف دسته بندی محصول',
                'delete-root' => 'حذف کامل دسته بندی محصول',
                'sort' => 'ترتیب دسته بندی',
            ),
        ),
        'product' => array(
            'title' => 'محصولات',
            'access' => array(
                'index' => 'مشاهده محصولات',
                'create' => 'اضافه کردن محصولات',
                'edit' => ' ویرایش محصولات',
                'delete' => 'حذف محصولات',
                'timer' => 'تایمر',
                'sort' => 'ترتیب محصولات',
            ),
        ),
        'brand' => array(
            'title' => 'برند محصول',
            'access' => array(
                'index' => 'مشاهده برند محصول',
                'create' => 'اضافه کردن برند محصول',
                'edit' => ' ویرایش برند محصول',
                'delete' => 'حذف برند محصول',
            ),
        ),
        'tag' => array(
            'title' => 'تگ',
            'access' => array(
                'index' => 'مشاهده تگ',
                'create' => 'اضافه کردن تگ',
                'edit' => ' ویرایش تگ',
                'delete' => 'حذف تگ',
            ),
        ),
        'specification' => array(
            'title' => 'مشخصه',
            'access' => array(
                'index' => 'مشاهده مشخصه',
                'create' => 'اضافه کردن مشخصه',
                'edit' => ' ویرایش مشخصه',
                'delete' => 'حذف مشخصه',
            ),
        ),
        'specification-value' => array(
            'title' => 'مقادیر',
            'access' => array(
                'index' => 'مشاهده مقادیر',
                'create' => 'اضافه کردن مقادیر',
                'edit' => ' ویرایش مقادیر',
                'delete' => 'حذف مقادیر',
            ),
        ),
        'slogan' => array(
            'title' => 'شعار ها',
            'access' => array(
                'index' => 'مشاهده شعار',
                'create' => 'اضافه کردن شعار',
                'edit' => ' ویرایش شعار',
                'delete' => 'حذف شعار',
            ),
        ),
        'product-video-faq' => array(
            'title' => 'سوالات متداول و ویدیوی محصول',
            'access' => array(
                'index' => 'مشاهده ',
                'create' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete-video' => 'حذف ویدیو ',
                'delete-faq' => 'حذف سوال ',
            ),
        ),
        'product-image' => array(
            'title' => 'تصاویر محصول',
            'access' => array(
                'index' => 'مشاهده ',
                'create' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
            ),
        ),
        'product-variant' => array(
            'title' => 'متغیرهای محصول',
            'access' => array(
                'index' => 'مشاهده ',
                'create' => 'اضافه کردن ',
                'create-main' => 'اضافه کردن متغییر اصلی ',
                'edit' => ' ویرایش ',
                'delete' => ' حذف ',
            ),
        ),
        'product-property-spf-tag' => array(
            'title' => 'اختصاص مشخصه و تگ و ویژگی به محصول',
            'access' => array(
                'index' => 'مشاهده ',
                'create' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete-prop' => 'حذف ویژگی ',

            ),
        ),
        'order' => array(
            'title' => 'سفارش',
            'access' => array(
                'index' => 'مشاهده ',
                'factor' => ' فاکتور ',
                'detail' => ' جزییات ',
                'change-shipping-status' => ' تغییر وضعیت ',
                'delete' => 'حذف ',
            ),
        ),
        'bank' => array(
            'title' => 'درگاه های بانکی',
            'access' => array(
                'index' => 'مشاهده ',
                'edit' => ' ویرایش ',
            ),
        ),
        'order-shipping-status' => array(
            'title' => ' وضعیت سفارش',
            'access' => array(
                'index' => 'مشاهده ',
                'create' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'shipping-method' => array(
            'title' => 'روش ارسال',
            'access' => array(
                'index' => 'مشاهده ',
                'create' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'discount' => array(
            'title' => 'کد تخفیف',
            'access' => array(
                'index' => 'مشاهده ',
                'create' => 'اضافه کردن ',
                'edit' => ' ویرایش ',
                'delete' => 'حذف ',
            ),
        ),
        'state' => array(
            'title' => 'استان',
            'access' => array(
                'index' => 'مشاهده ',
                'change-status' => 'تغییر وضعیت ',

            ),
        ),
        'city' => array(
            'title' => 'شهر',
            'access' => array(
                'index' => 'مشاهده ',
                'change-status' => 'تغییر وضعیت ',
            ),
        ),
        'address' => array(
            'title' => 'آدرس',
            'access' => array(
                'index' => 'مشاهده ',
            ),
        ),
    ],
    'user_types' => [
        'Teacher' => 'پرسنل',
        'Student' => 'دانشجو',
        'Admin' => 'مدیر',
    ],
];
