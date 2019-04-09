<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->truncate();

        $this->createClients();
    }

    private function createClients(){
        Client::create([
            'name' => 'Kaleb Hawi',
            'cpf' => '01234585265',
            'birthDate' => '1995-07-14',
            'address' => 'Rua Batista Xavier, 14',
        ]);
        Phone::create([
            'ddd' => ['51', '51', '51'],
            'number' => ['99999999', '88888888', '77777777'],
            'type' => ['Work', 'Home', 'Mobile'],
        ]);
    }
}
