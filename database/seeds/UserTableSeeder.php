<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
    }

    private function createClients()
    {
        User::create([
            'name' => 'Kaleb Hawi',
            'email' => 'admin',
            'password' => 'md5(admin)',
            'id' => 1,
        ]);
    }
}
