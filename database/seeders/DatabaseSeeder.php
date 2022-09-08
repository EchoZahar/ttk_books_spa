<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(UserTableSeeder::class);
        $this->command->info('User seeds uploaded.');

        $this->call(SectionTableSeeder::class);
        $this->command->info('Section seeds uploaded.');

        $this->call(AuthorTableSeeder::class);
        $this->command->info('Author seeds uploaded.');

        $this->call(BookTableSeeder::class);
        $this->command->info('Book seeds uploaded.');
    }
}
