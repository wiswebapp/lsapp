<?php

use App\Blog;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = factory(App\User::class)->create();
        for ($i=0; $i < 100; $i++) {
            $userData[] = [
                'user_id' => $user->id,
                'title' => $faker->sentence(10),
                'content' => $faker->paragraph(50),
                'views' => $i,
                'earning' => ($i * 0.50),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        foreach ($userData as $user) {
            Blog::create($user);
        }
    }
}
