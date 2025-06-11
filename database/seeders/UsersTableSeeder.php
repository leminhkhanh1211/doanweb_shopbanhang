<?php

namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Roles;
use Database\Factories\AdminFactory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Admin::truncate();
    DB::table('admin_roles')->truncate();

    $adminRoles = Roles::where('name', 'admin')->first();
    $authorRoles = Roles::where('name', 'author')->first();
    $userRoles = Roles::where('name', 'user')->first();

    $admin = Admin::create([
        'admin_name' => 'khanhleadmin',
        'admin_email' => 'khanhleadmin@gmail.com',
        'admin_phone' => '0932023991',
        'admin_password' => md5('123456')
    ]);

    $author = Admin::create([
        'admin_name' => 'khanhle123',
        'admin_email' => 'khanhle123@gmail.com',
        'admin_phone' => '0932023992',
        'admin_password' => md5('123456')
    ]);

    $user = Admin::create([
        'admin_name' => 'khanhle456',
        'admin_email' => 'khanhle456@gmail.com',
        'admin_phone' => '0932023993',
        'admin_password' => md5('123456')
    ]);

    $admin->roles()->attach($adminRoles);
    $author->roles()->attach($authorRoles);
    $user->roles()->attach($userRoles);
    AdminFactory::new()->count(10)->create();
}

}
