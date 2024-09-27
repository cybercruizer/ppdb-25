<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // data faker indonesia
        $faker = Faker::create('id_ID');

        // membuat data dummy sebanyak 10 record
        for($x = 1; $x <= 50; $x++){

        	// insert data dummy pegawai dengan faker
        	DB::table('siswas')->insert([
        		'no_pendaf'=> $faker->optional()->passthrough(mt_rand(500, 1500)),
                'nama' => $faker->name,
        		'alamat' => $faker->address,
                'nisn' => $faker->optional()->passthrough(mt_rand(5000, 15000)),
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date,
        	]);

        }

    }
}
