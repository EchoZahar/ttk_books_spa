<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $author = Author::select('id', 'name')->inRandomorder()->first();
        return [
            'title'         =>  fake()->name(),
            'year'          =>  rand(1900, 2022),
            'description'   =>  fake()->realText(2000),
            'cover'         =>  'https://www.fillmurray.com/360/640',
            'author'        =>  $author->name,
            'author_id'     =>  $author->id,
            'published'     =>  rand(0,1),
        ];
    }
}
