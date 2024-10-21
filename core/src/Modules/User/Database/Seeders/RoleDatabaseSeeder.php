<?php

namespace Rahweb\CmsCore\Modules\User\Database\Seeders;

use Rahweb\CmsCore\Modules\User\Entities\Role;
use Rahweb\CmsCore\Modules\User\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $full_access = ["admin.dashboard"];
        foreach (Config::get('site.permissions') as $key => $permission) {
            if (isset($permission['access'])) {
                foreach ($permission['access'] as $keyAccess => $access) {
                    $full_access[] = 'admin.' . $key . '.' . $keyAccess;
                }
            }
        }

        DB::table('roles')->updateOrInsert(
            ['id' => 1], // شرط بر اساس id
            [
                'name' => 'main',
                'permission' => serialize($full_access)
            ]
        );

    }
}
