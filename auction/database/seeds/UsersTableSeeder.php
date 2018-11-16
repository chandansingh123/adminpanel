<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Auction',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => str_random(10),
            'password' => bcrypt('123456'),
            'status' => 1,
            'created_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
}
