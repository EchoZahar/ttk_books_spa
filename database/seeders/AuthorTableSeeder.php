<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('type', 'author')->get();
        foreach ($users as $user) {
            Author::create([
                'name'              =>  fake()->name(),
                'country_of_birth'  =>  fake()->country(),
                'comments'          =>  fake()->realText(rand(200, 500)),
                'user_id'           =>  $user->id
            ]);
        }
    }
}
