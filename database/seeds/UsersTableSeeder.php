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
            'password' => bcrypt("oveland")
        ]);

        factory(\App\User::class)->create([
            'name' => "Omar",
            'username' => "omar",
            'password' => bcrypt("olatorre2017")
        ]);

        factory(\App\User::class)->create([
            'name' => "Usuario Demo",
            'username' => "demo",
            'password' => bcrypt("demo2017")
        ]);
    }
}
