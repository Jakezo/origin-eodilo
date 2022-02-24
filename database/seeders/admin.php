<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'admin_id' => Str::random(20),
            'admin_passwd' => Hash::make('password'),
            'admin_name' => Str::random(20),
            'admin_email' => Str::random(10).'@gmail.com'
        ]);
    }
}
