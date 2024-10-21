<?php

namespace Rahweb\CmsCore\Modules\Location\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Rahweb\CmsCore\Modules\Location\Entities\City;
use Rahweb\CmsCore\Modules\Location\Entities\State;
use Rahweb\CmsCore\Modules\Setting\Entities\Setting;
use Rahweb\CmsCore\Modules\Setting\Entities\SettingPartial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('data/states.json'));
        $data = json_decode($json, true);
        foreach ($data as $row){
            $state = State::create(
                [
                    'name'=>$row['state']['name'],
                    'status'=>$row['state']['status'] ?? 1,
                ]
            );
            foreach ($row['cities'] as $city){
                City::create(
                    [
                        'name'=>$city['name'],
                        'state_id'=>$state['id'],
                        'status'=>$city['status'] ?? 1,
                    ]
                );
            }
        }

    }
}
