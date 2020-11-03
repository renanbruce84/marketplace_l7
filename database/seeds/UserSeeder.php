<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Cria os usuários
        // factory(\App\User::class, 20)->create();

        // DB::table('users')->insert(
        //     [
        //         'name' => 'Teste',
        //         'email' => 'teste@teste.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('teste'), // password
        //         'remember_token' => Str::random(10)        
        //     ]
        // );

        //  Cria os Usuário juntamente com as lojas
        factory(\App\User::class, 10)->create()->each(
            function ($user) {
                $user->store()->save(
                    factory(\App\Store::class)->make()
                );
            }
        );
    }
}
