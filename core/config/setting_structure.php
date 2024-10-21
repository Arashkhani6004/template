<?php

return [
    'setting_types' => [
        'text' => 'متن ها',
        'input_file' => 'فایل ها',
        'array' => 'متن های چندتایی',
        'array_files' => 'فایل های چندتایی',
        'textarea' => 'توضیحات',
        'menu' => 'منو',
        'work_hours' => 'ساعات کاری',
        'ckeditor' => 'متن های ادیتور',
        'input_file_about' => 'تصاویر درباره ما',
    ],
    'setting_partials' => [
        [
            "name" => "تنظیمات کلی",
            "partials" => [],
            "fields" => [
                [
                    "key" => "siteName_fa",
                    "value" => "نام سایت",
                    "p_name" => "عنوان فارسی سایت",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "siteName_en",
                    "value" => "lorem ipsum",
                    "p_name" => "عنوان انگلیسی سایت",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "logo",
                    "value" => null,
                    "p_name" => "لوگو",
                    "type" => "input_file",
                    "options" => [
                        "width" => 150,
                        "height" => 85,
                        "image" => "logo.jpg",
                    ],
                ],
                [
                    "key" => "favicon",
                    "value" => null,
                    "p_name" => "فوآیکون",
                    "type" => "input_file",
                    "options" => [
                        "width" => 64,
                        "height" => 64,
                        "image" => "favicon.jpg",
                    ],
                ],
                [
                    "key" => "location_header_title",
                    "value" => "عنوان مسیریابی هدر سایت",
                    "p_name" => "عنوان مسیریابی هدر سایت",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "site_header_title",
                    "value" => "عنوان تماس در هدر سایت",
                    "p_name" => "عنوان تماس در هدر سایت",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "head_codes",
                    "value" => null,
                    "p_name" => "تگ های سئو در head",
                    "type" => "textarea",
                    "options" => null,
                ],
                [
                    "key" => "body_codes",
                    "value" => null,
                    "p_name" => "تگ های سئو در body",
                    "type" => "textarea",
                    "options" => null,
                ],
            ],
        ],
        [
            "name" => "تنظیمات منو",
            "partials" => [],
            "fields" => [
                [
                    "key" => "menu_links",
                    "value" => [
                        ["title" => "صفحه اصلی", "type" => "default", "url" => "/"],
                        ["title" => "خدمات", "type" => "service", "url" => ""],
                        [
                            "title" => "نمونه کارها",
                            "type" => "default",
                            "url" => "portfolios",
                        ],
                        ["title" => "محصولات", "type" => "product", "url" => ""],
                        [
                            "title" => "گالری",
                            "type" => "default",
                            "url" => "galleries",
                        ],
                    ],
                    "p_name" => "لینک های منو",
                    "type" => "menu",
                    "options" => null,
                ],
            ],
        ],
        [
            "name" => "تنظیمات صفحه اول",
            "partials" => [
                [
                    "name" => "اسلایدر",
                    "fields" => [
                        [
                            "key" => "slider_animation",
                            "value" =>
                                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Egestas purus viverra accumsan in nisl nisi Arcu cursus vitae congue mauris rhoncus aenean vel elit scelerisque In egestas erat imperdiet sed euismod nisi porta lorem mollis Morbi tristique senectus et netus Mattis pellentesque id nibh tortor id aliquet lectus proin ",
                            "p_name" => "متن متحرک اسلایدر",
                            "type" => "array",
                            "options" => null,
                        ],
                        [
                            "key" => "video_link",
                            "value" => null,
                            "p_name" => "لینک ویدیو صفحه اول",
                            "type" => "textarea",
                            "options" => null,
                        ],
                        [
                            "key" => "video_cover",
                            "value" => null,
                            "p_name" => "تصویر کاور ویدیو",
                            "type" => "input_file",
                            "options" => [
                                "width" => 510,
                                "height" => 300,
                                "image" => "cover-video.jpg",
                            ],
                        ],
                        [
                            "key" => "first_button",
                            "value" => "مشاهده خدمات",
                            "p_name" => "متن دکمه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "first_link",
                            "value" => "/services",
                            "p_name" => "لینک دکمه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "second_link",
                            "value" => "/portfolios",
                            "p_name" => "متن دکمه دوم",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "second_button",
                            "value" => "نمونه کارها",
                            "p_name" => "لینک دکمه دوم",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "slider_description",
                            "value" =>
                                "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده ",
                            "p_name" => "توضیحات اسلایدر",
                            "type" => "textarea",
                            "options" => null,
                        ],
                        [
                            "key" => "slider_title",
                            "value" => "لورم ایپسوم متن ساختگی",
                            "p_name" => "متن روی اسلایدر",
                            "type" => "text",
                            "options" => null,
                        ],
                    ],
                ],
                [
                    "name" => "خدمات",
                    "fields" => [
                        [
                            "key" => "first_page_service_text",
                            "value" =>
                                "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده ",
                            "p_name" => "متن قسمت خدمات صفحه اول",
                            "type" => "textarea",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_service_title",
                            "value" => "خدمات فروشگاه ما",
                            "p_name" => "عنوان قسمت خدمات صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                    ],
                ],
                [
                    "name" => "درباره ما",
                    "fields" => [
                        [
                            "key" => "first_page_first_title",
                            "value" => "لورم ایپسوم متن ساختگی",
                            "p_name" => "عنوان اولین قسمت در صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_first_text",
                            "value" =>
                                "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده ",
                            "p_name" => "متن اولین قسمت در صفحه اول",
                            "type" => "textarea",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_first_animation",
                            "value" => "Lorem ipsum dolor sit amet, consectetur",
                            "p_name" => "متن متحرک اولین قسمت در صفحه اول",
                            "type" => "textarea",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_about_image_1",
                            "value" => null,
                            "p_name" => "تصویر اول از سمت راست درباره ما",
                            "type" => "input_file_about",
                            "options" => [
                                "width" => 332,
                                "height" => 480,
                                "image" => "about-right-1.jpg",
                            ],
                        ],
                        [
                            "key" => "first_page_about_image_2",
                            "value" => null,
                            "p_name" => "تصویر دوم از سمت راست درباره ما",
                            "type" => "input_file_about",
                            "options" => [
                                "width" => 332,
                                "height" => 179,
                                "image" => "about-right-2.jpg",
                            ],
                        ],
                        [
                            "key" => "first_page_about_image_3",
                            "value" => null,
                            "p_name" => "تصویر سوم از سمت راست درباره ما",
                            "type" => "input_file_about",
                            "options" => [
                                "width" => 332,
                                "height" => 359,
                                "image" => "about-right-3.jpg",
                            ],
                        ],
                        [
                            "key" => "first_page_about_image_4",
                            "value" => null,
                            "p_name" => "تصویر چهارم از سمت راست درباره ما",
                            "type" => "input_file_about",
                            "options" => [
                                "width" => 332,
                                "height" => 252,
                                "image" => "about-right-4.jpg",
                            ],
                        ],
                        [
                            "key" => "first_page_about_image_5",
                            "value" => null,
                            "p_name" => "تصویر پنجم از سمت راست درباره ما",
                            "type" => "input_file_about",
                            "options" => [
                                "width" => 332,
                                "height" => 480,
                                "image" => "about-right-5.jpg",
                            ],
                        ],
                    ],
                ],
                [
                    "name" => "نمونه کار",
                    "fields" => [
                        [
                            "key" => "first_page_sample_text",
                            "value" =>
                                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua",
                            "p_name" => "متن قسمت نمونه کار صفحه اول",
                            "type" => "array",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_sample_title",
                            "value" => "نمونه پروژه های فروشگاه",
                            "p_name" => "عنوان قسمت نمونه کار صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "sample_button",
                            "value" => "مشاهده تمام پروژه ها",
                            "p_name" => "دکمه مشاهده نمونه کار",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_category_text",
                            "value" =>
                                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua",
                            "p_name" => "متن قسمت دسته بندی صفحه اول",
                            "type" => "array",
                            "options" => null,
                        ],
                    ],
                ],
                [
                    "name" => "ساعت کاری",
                    "fields" => [
                        [
                            "key" => "work_hours",
                            "value" => [
                                "شنبه" => ["from" => "10", "to" => "22"],
                                "یکشنبه" => ["from" => "10", "to" => "22"],
                                "دوشنبه" => ["from" => "10", "to" => "22"],
                                "سه شنبه" => ["from" => "10", "to" => "22"],
                                "چهارشنبه" => ["from" => "10", "to" => "22"],
                                "پنجشنبه" => ["from" => "10", "to" => "22"],
                                "جمعه" => ["from" => "10", "to" => "22"],
                            ],
                            "p_name" => "ساعت کاری",
                            "type" => "work_hours",
                            "options" => null,
                        ],
                        [
                            "key" => "work_hours_first_page",
                            "value" =>
                                "ما در ساعات کاری منعطف آماده ارائه خدمت به شما عزیزان هستیم.",
                            "p_name" => "توضیحات ساعات کاری صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "work_hours_big_image",
                            "value" => null,
                            "p_name" => "تصویر بزرگ ساعات کاری صفحه اول",
                            "type" => "input_file",
                            "options" => [
                                "width" => 2100,
                                "height" => 1200,
                                "image" => "time-back.jpg",
                            ],
                        ],
                        [
                            "key" => "work_hours_small_image",
                            "value" => null,
                            "p_name" => "تصویر کوچک ساعات کاری صفحه اول",
                            "type" => "input_file",
                            "options" => [
                                "width" => 310,
                                "height" => 450,
                                "image" => "time-sm-img.jpg",
                            ],
                        ],
                        [
                            "key" => "work_hours_first_page_text",
                            "value" => "جهت رزرو می توانید با ما تماس بگیرید!",
                            "p_name" => "متن دکمه ساعات کاری صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "work_hours_first_page_title",
                            "value" => " ساعات کاری گالری ",
                            "p_name" => "عنوان قسمت ساعات کاری صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                    ],
                ],
                [
                    "name" => "گالری",
                    "fields" => [
                        [
                            "key" => "first_page_gallery_title",
                            "value" => "گالری تصاویر و فیلم ها",
                            "p_name" => "عنوان گالری صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_gallery_text",
                            "value" => "پرسنل فروشگاه",
                            "p_name" => "متن گالری صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "gallery_button",
                            "value" => "مشاهده گالری فروشگاه ما ",
                            "p_name" => "دکمه گالری",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_gallery_animation",
                            "value" => "Lorem ipsum dolor sit amet, consectetur ",
                            "p_name" => "متن متحرک قسمت گالری در صفحه اول",
                            "type" => "textarea",
                            "options" => null,
                        ],
                    ],
                ],
                [
                    "name" => "متخصصان",
                    "fields" => [
                        [
                            "key" => "first_page_team_title",
                            "value" => "متخصصان ما",
                            "p_name" => "عنوان قسمت متخصصان صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_team_text",
                            "value" => null,
                            "p_name" => "متن قسمت متخصصان صفحه اول",
                            "type" => "textarea",
                            "options" => null,
                        ],
                    ],
                ],
                [
                    "name" => "افتخارات",
                    "fields" => [
                        [
                            "key" => "first_page_certificate_title",
                            "value" => "افتخارات و گواهینامه ها",
                            "p_name" => "عنوان قسمت گواهینامه صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_certificate_text",
                            "value" =>
                                "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است ",
                            "p_name" => "متن قسمت گواهینامه صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                    ],
                ],
                [
                    "name" => "پکیج",
                    "fields" => [
                        [
                            "key" => "first_page_package_title",
                            "value" => "پکیج های دکوراسیون",
                            "p_name" => "عنوان قسمت پکیج صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "first_page_package_text",
                            "value" => "تیم حرفه ای و متخصص فروشگاه",
                            "p_name" => "متن قسمت پکیج صفحه اول",
                            "type" => "textarea",
                            "options" => null,
                        ],
                        [
                            "key" => "online_support_link",
                            "value" => "https://t.me/(021) 88 23 56 22",
                            "p_name" => "لینک کامل برنامه پشتیبانی",
                            "type" => "textarea",
                            "options" => null,
                        ],
                        [
                            "key" => "support_call_text",
                            "value" => "تماس با پشتیبانی",
                            "p_name" => "متن قسمت پشتیبانی صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "support_call_hours",
                            "value" => "از ساعت ۱۰ صبح تا ۸ شب",
                            "p_name" => "ساعات پشتیبانی",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "online_support_text",
                            "value" => "ارتباط آنلاین با پشتیبانی",
                            "p_name" => "متن پشتیبانی آنلاین",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "online_support_hours",
                            "value" => "به صورت ۲۴ ساعته",
                            "p_name" => "ساعات پشتیبانی آنلاین پر صفحه اول",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "online_support_title",
                            "value" => "شماره تلگرام",
                            "p_name" => "عنوان پشتیبانی آنلاین",
                            "type" => "text",
                            "options" => null,
                        ],
                        [
                            "key" => "online_support_image",
                            "value" => null,
                            "p_name" => "تصویر پشتیبانی آنلاین در صفحه اول",
                            "type" => "input_file",
                            "options" => [
                                "width" => 132,
                                "height" => 130,
                                "image" => "support-img-bottom.jpg",
                            ],
                        ],
                    ],
                ],
                [
                    "name" => "محصول",
                    "fields" => [
                        [
                            "key" => "timer_image",
                            "value" => null,
                            "p_name" => "تصویر بک گراند تایمر صفحه اول",
                            "type" => "input_file",
                            "options" => [
                                "width" => 1000,
                                "height" => 667,
                                "image" => "discounted-back.jpg",
                            ],
                        ],
                    ],
                ],
            ],
            "fields" => [],
        ],
        [
            "name" => "تنظیمات فوتر",
            "partials" => [],
            "fields" => [
                [
                    "key" => "enamad",
                    "value" => null,
                    "p_name" => "اینماد",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "footer_valids",
                    "value" => null,
                    "p_name" => "کدهای مربوط به اعتبار",
                    "type" => "array",
                    "options" => null,
                ],
                [
                    "key" => "footer_animation",
                    "value" =>
                        "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است ",
                    "p_name" => "متن متحرک فوتر",
                    "type" => "array",
                    "options" => null,
                ],
                [
                    "key" => "footer_contacts",
                    "value" => "(021) 88 23 56 22",
                    "p_name" => "شماره تماس های فوتر",
                    "type" => "array",
                    "options" => null,
                ],
                [
                    "key" => "footer_logo",
                    "value" => null,
                    "p_name" => "لوگو فوتر",
                    "type" => "input_file",
                    "options" => [
                        "width" => 150,
                        "height" => 85,
                        "image" => "logo-footer.jpg",
                    ],
                ],
                [
                    "key" => "footer_about_title",
                    "value" => "لورم ایپسوم",
                    "p_name" => "عنوان درباره ما فوتر",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "footer_about_text",
                    "value" =>
                        "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده ",
                    "p_name" => "متن درباره ما فوتر",
                    "type" => "textarea",
                    "options" => null,
                ],
                [
                    "key" => "call_to_action_text",
                    "value" => "منتظر صدای گرم شما هستیم",
                    "p_name" => "متن تماس بگیرید در فوتر",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "phones_first_page_text",
                    "value" => "شماره های تماس",
                    "p_name" => "متن شماره های تماس در صفحه اول",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "call_to_action_footer_text",
                    "value" => " تماس با ما ",
                    "p_name" => "متن تماس بگیرید بالای فوتر",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "service_in_footer",
                    "value" => 0,
                    "p_name" => " نمایش خدمات در فوتر ",
                    "type" => "checkbox",
                    "options" => null,
                ],
                [
                    "key" => "category_in_footer",
                    "value" => 1,
                    "p_name" => " نمایش دسته بندی در فوتر ",
                    "type" => "checkbox",
                    "options" => null,
                ],
                [
                    "key" => "service_title_footer",
                    "value" => " خدمات ما ",
                    "p_name" => "عنوان خدمات در فوتر",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "category_title_footer",
                    "value" => " دسته بندی ها ",
                    "p_name" => "عنوان دسته بندی ها در فوتر",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "gallery_title_footer",
                    "value" => " رویدادها ",
                    "p_name" => "عنوان گالری در منو و فوتر",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "product_title_footer",
                    "value" => " محصولات ",
                    "p_name" => "عنوان محصولات در منو و فوتر",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "sample_title_footer",
                    "value" => " نمونه کار ",
                    "p_name" => "عنوان نمونه کار در منو و فوتر",
                    "type" => "text",
                    "options" => null,
                ],
            ],
        ],
        [
            "name" => "تنظیمات صفحات داخلی",
            "partials" => [
                [
                    "name" => "مشترک بین صفحات",
                    "fields" => [
                        [
                            "key" => "image_header",
                            "value" => null,
                            "p_name" => "تصویر هدر صفحات داخلی",
                            "type" => "input_file",
                            "options" => [
                                "width" => 1920,
                                "height" => 350,
                                "image" => "service-header-detail.jpg",
                            ],
                        ],
                    ],
                ],
                [
                    "name" => "خدمات",
                    "fields" => [
                        [
                            "key" => "service_description",
                            "value" =>
                                "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده ",
                            "p_name" => "توضیحات لیست خدمات",
                            "type" => "ckeditor",
                            "options" => null,
                        ],
                        [
                            "key" => "service_header",
                            "value" => null,
                            "p_name" => "تصویر هدر صفحه جزییات خدمات",
                            "type" => "input_file",
                            "options" => [
                                "width" => 1920,
                                "height" => 350,
                                "image" => "service-header-detail.jpg",
                            ],
                        ],
                    ],
                ],
                [
                    "name" => "نمونه کار",
                    "fields" => [
                        [
                            "key" => "portfolio_description",
                            "value" =>
                                "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده ",
                            "p_name" => "توضیحات لیست نمونه کار",
                            "type" => "ckeditor",
                            "options" => null,
                        ],
                    ],
                ],
                [
                    "name" => "مطالب",
                    "fields" => [
                        [
                            "key" => "blog_list_header",
                            "value" => null,
                            "p_name" => "تصویر هدر لیست مطالب",
                            "type" => "input_file",
                            "options" => [
                                "width" => 1920,
                                "height" => 350,
                                "image" => "blogs-header.jpg",
                            ],
                        ],
                    ],
                ],
                [
                    "name" => "درباره ما",
                    "fields" => [
                        [
                            "key" => "about_us",
                            "value" =>
                                "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده ",
                            "p_name" => "صفحه درباره ما",
                            "type" => "ckeditor",
                            "options" => null,
                        ],
                    ],
                ],
                [
                    "name" => "دسته بندی",
                    "fields" => [
                        [
                            "key" => "category_description",
                            "value" =>
                                "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد ",
                            "p_name" => "توضیحات لیست دسته بندی",
                            "type" => "ckeditor",
                            "options" => null,
                        ],
                    ],
                ],
            ],
            "fields" => [],
        ],
        [
            "name" => "تنظیمات تماس",
            "partials" => [],
            "fields" => [
                [
                    "key" => "main_phone_number",
                    "value" => "02156378201",
                    "p_name" => "شماره تلفن اصلی",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "phone_numbers",
                    "value" => "02188602886",
                    "p_name" => "شماره ها",
                    "type" => "array",
                    "options" => null,
                ],
                [
                    "key" => "email",
                    "value" => "info@email.com",
                    "p_name" => "ایمیل",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "map",
                    "value" => "https://goo.gl/maps/8FoiwF8NSvFXZhgg9",
                    "p_name" => "نقشه",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "phone_call",
                    "value" => "تماس فروشگاه ما",
                    "p_name" => "متن تماس",
                    "type" => "text",
                    "options" => null,
                ],
            ],
        ],
        [
            "name" => "تنظیمات پیامک",
            "partials" => [],
            "fields" => [
                [
                    "key" => "kavenegar_key",
                    "value" => null,
                    "p_name" => "شناسه کاوه نگار",
                    "type" => "text",
                    "options" => null,
                ],
                [
                    "key" => "admin_mobile",
                    "value" => null,
                    "p_name" => "تلفن ادمین برای ارسال پیامک",
                    "type" => "text",
                    "options" => null,
                ],
            ],
        ],
    ]
];
