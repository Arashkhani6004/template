<?php

namespace Rahweb\CmsCore\Modules\Setting\Database\Seeders;

use Illuminate\Support\Facades\Config;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;
use Illuminate\Database\Seeder;

class SettingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partials = Config::get('setting_structure.setting_partials');
        foreach ($partials as $partial) {
            foreach ($partial['fields'] as $field) {
                $this->createSettingRecord($field['key'], $field);
            }
            foreach ($partial['partials'] as $sub_partial) {
                foreach ($sub_partial['fields'] as $field) {
                    $this->createSettingRecord($field['key'], $field);
                }
            }
        }
    }

    private function createSettingRecord($key, $data)
    {
        $record = Setting::where('key', $key)->first();
        if (!$record) {
            if ($data['type'] == "menu" || $data['type'] == "work_hours") {
                $data['value'] = json_encode($data['value']);
            }
            Setting::create($data);
        }
    }
}

