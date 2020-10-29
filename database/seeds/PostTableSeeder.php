<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Post');

        for ($i=0; $i < 30; $i++) { 
            DB::table('posts')->insert([
                'vTitle' => $faker->sentence(),
                'vBody' => $faker->paragraph(50),
                'iUserId' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
