<?php

use Illuminate\Database\Seeder;

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
        Groups::create([
            'name' => 'Admins Group',
            'description' => 'Only users admin can into this group',
            'client_quantity' => 1,
            'admin' => 1,
        ]);
    }
}
