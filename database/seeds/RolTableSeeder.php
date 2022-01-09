<?php

use Illuminate\Database\Seeder;

use App\Rol;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Rol::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Rol::create([
                'NombreRol' => $faker->sentence,                
            ]);
        }
    }
}
