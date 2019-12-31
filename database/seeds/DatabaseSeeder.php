<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(File::get(base_path() . '/database/seeds/mmc_times.sql'));
        DB::table('mmc_employees')->insert([
            'mmc_name' => 'Admin',
            'mmc_employeeid' => 'MMC_GVadmin',
            'password' => Hash::make('123456'),
            'email' => 'admin@gmail.com',
            'mmc_level'=> '1',
        ]);
    }
}
