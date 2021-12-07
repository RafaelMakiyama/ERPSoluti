<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

       // \App\Models\Unidade::factory(2)->create();
      //\App\Models\Pedido::factory(2)->create();
        //\App\Models\Client::factory(2)->create();

    \App\Models\Produto::factory(2)->create();
       // \App\Models\Unidade::factory(2)->create();
    }
}
