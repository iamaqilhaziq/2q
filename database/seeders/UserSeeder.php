<?php

namespace Database\Seeders;

use App\Models\User;
use App\Helpers\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'admin@admin.com',//example email:superadmin@project-name.com
            'password' => '$2y$10$XS5kaiBVU8k7f.4jTDXyGun/g1yj2r/YeKOzTfxexC2RqxQMxR7wK', // password
            'user_type'=> Users::TYPE_ADMIN,
            'status'=>'active',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

    }
}
