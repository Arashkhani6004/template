<?php

namespace Rahweb\CmsCore\Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Rahweb\CmsCore\Modules\Setting\Entities\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Theme::where('key','menu_type')->delete();
        Theme::where('key','menu_type_category')->delete();
        Theme::where('key','color_type')->delete();
        Theme::insert([
            [
                'key' => 'menu_type',
                'value' => 'drop_down',
                'type' => 'select_box',
                'p_name' => 'نوع منوی خدمات'
            ],
            [
                'key' => 'menu_type_category',
                'value' => 'drop_down',
                'type' => 'select_box',
                'p_name' => 'نوع منوی دسته بندی'
            ],
            [
                'key' => 'color_type',
                'value' => '{"color-one":"#E7E0F2","color-two":"#FFC093","color-body":"#FFF7F4"}',
                'type' => 'select_box_color',
                'p_name' => 'ترکیب رنگی '
            ],
        ]);
    }
}
