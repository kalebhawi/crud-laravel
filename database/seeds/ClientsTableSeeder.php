<?php

use Illuminate\Database\Seeder;
use App\Client;
use App\Phone;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('clients')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->createClients();
    }

    private function createClients(){
        Client::create([
            'name' => 'Kaleb Hawi',
            'address' => 'Rua Batista Xavier, 14',
            'birthDate' => '1995-07-14',
            'cpf' => '01234585265',
            'group_id' => 1,
        ]);
        Phone::create([
            'ddd' => '51',
            'number' => '99999999',
            'type' => 'Work',
            'client_id' => 1,
        ]);
    }
}
