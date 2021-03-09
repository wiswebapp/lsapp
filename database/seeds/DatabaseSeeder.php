<?php

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
        factory(App\User::class,9)->create();
        factory(App\Admin::class)->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
        ]);
        factory(App\Admin::class)->create([
            'name' => 'Reviewer Admin',
            'email' => 'reviewer@example.com',
        ]);

        $this->call(BlogSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
    }
}
