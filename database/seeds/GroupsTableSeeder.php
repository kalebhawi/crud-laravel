<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->truncate();

        $this->createGroups();
    }

    private function createGroups(){
        Group::create([
            'name' => 'Admins Group',
            'description' => 'Only users admin can into this group',
            'client_quantity' => 1,
            'admin' => 1,
        ]);
    }
}
