<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $settingData = [
            [
                'name' => 'large_logo',
                'value' => null,
                'type' => 'General',
            ],
            [
                'name' => 'small_logo',
                'value' => null,
                'type' => 'General',
            ],
            [
                'name' => 'favicon',
                'value' => null,
                'type' => 'General',
            ],
            [
                'name' => 'row_per_page',
                'value' => null,
                'type' => 'General',
            ],
            [
                'name' => 'max_file_size',
                'value' => null,
                'type' => 'General',
            ],
        ];

        \Modules\Setting\Entities\Setting::insert($settingData);
    }
}
