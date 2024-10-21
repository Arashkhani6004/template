<?php

namespace Rahweb\CmsCore\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Rahweb\CmsCore\Modules\General\Helper\ModuleUtils;
use Rahweb\CmsCore\Modules\Location\Database\Seeders\StateSeeder;
use Rahweb\CmsCore\Modules\Order\Database\Seeders\BankSeeder;
use Rahweb\CmsCore\Modules\Order\Database\Seeders\OrderShippingStatusSeeder;
use Rahweb\CmsCore\Modules\Setting\Database\Seeders\SettingsDatabaseSeeder;
use Rahweb\CmsCore\Modules\Setting\Database\Seeders\SettingSmsSeeder;
use Rahweb\CmsCore\Modules\Setting\Database\Seeders\ThemeSeeder;
use Rahweb\CmsCore\Modules\User\Database\Seeders\RoleDatabaseSeeder;

class ShopSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BankSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(OrderShippingStatusSeeder::class);
        $this->call(SettingsDatabaseSeeder::class);
        $this->call(RoleDatabaseSeeder::class);
    }
}
