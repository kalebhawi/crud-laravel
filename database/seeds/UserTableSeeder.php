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
        $this->createUser();
    }

    private function createUser()
    {
        User::create([
            'name' => 'Kaleb Hawi',
            'email' => 'admin@admin',
            'password' => Hash::make('admin'),
            'id' => 1,
        ]);
    }
}
