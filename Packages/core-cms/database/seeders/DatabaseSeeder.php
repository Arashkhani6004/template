<?php

namespace Rahweb\CmsCore\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Rahweb\CmsCore\Modules\General\Helper\ModuleUtils;
use Rahweb\CmsCore\Modules\Setting\Database\Seeders\ThemeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //        $this->call(ThemeSeeder::class);
        $seeds_paths = [];
        foreach (config('modules.modules') as $row) {
            $path = ModuleUtils::app_module_path($row . "/Database/Seeders");
            foreach (File::allFiles($path) as $file) {
                $module_name = str_replace("/", "\\", $row);
                $seeds_paths[] = "Rahweb\CmsCore\Modules\\$module_name\Database\Seeders\\" . pathinfo($file)['filename'];
            }
        }
//        $custom_seeder_order = [
//            'Rahweb\CmsCore\Modules\Setting\Database\Seeders\SettingsDatabaseSeeder',
//            'Rahweb\CmsCore\Modules\AnotherModule\Database\Seeders\SecondSeeder',
//        ];
//        $sorted_seeds_paths = array_merge($custom_seeder_order, array_diff($seeds_paths, $custom_seeder_order));
        foreach ($seeds_paths as $path) {
            $this->call($path);
        }
    }
}
