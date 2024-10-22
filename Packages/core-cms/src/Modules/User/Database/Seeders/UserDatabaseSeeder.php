<?php

namespace Rahweb\CmsCore\Modules\User\Database\Seeders;

use Rahweb\CmsCore\Modules\User\Entities\Role;
use Rahweb\CmsCore\Modules\User\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class UserDatabaseSeeder extends Seeder
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

        DB::table('roles')->insert([
            'name' => 'main',
            'permission' => serialize($full_access)
        ]);

        $user = User::create([
            'full_name' => "ادمین اصلی",
            'email' => "admin@gmail.com",
            'password' => bcrypt('RahWeb2024'),
        ]);

        $role = Role::first();
        $user->syncUserTypes(['Admin']);
        $user->roles()->attach($role->id);
    }
}
