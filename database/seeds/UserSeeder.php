<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member = User::create([
            'name' => 'member1',
            'email' => 'member1@test.com',
            'password' => bcrypt('12345678'),
        ]);
        $member->assignRole('member');

        $admin = User::create([
            'name' => 'admin1',
            'email' => 'admin1@test.com',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('admin');

        $kasir = User::create([
            'name' => 'kasir1',
            'email' => 'kasir1@test.com',
            'password' => bcrypt('12345678'),
        ]);
        $kasir->assignRole('kasir');

        $owner = User::create([
            'name' => 'owner1',
            'email' => 'owner1@test.com',
            'password' => bcrypt('12345678'),
        ]);
        $owner->assignRole('owner');
    }
}
