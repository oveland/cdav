<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'name' => "Oscar Velásquez",
            'username' => "oveland",
            'is_admin' => true,
            'password' => bcrypt("oveland")
        ]);

        factory(\App\User::class)->create([
            'name' => "Omar",
            'username' => "omar",
            'is_admin' => true,
            'password' => bcrypt("olatorre")
        ]);

        factory(\App\User::class)->create([
            'name' => "Usuario Demo",
            'username' => "demo",
            'is_admin' => false,
            'password' => bcrypt("demo2017")
        ]);
    }
}
