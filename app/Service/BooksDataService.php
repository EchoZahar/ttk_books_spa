<?php


namespace App\Service;


use App\Models\Author;
use App\Models\User;

class BooksDataService
{
    public function checkBookStoreData(User $user, $country, $comments)
    {
        switch($user->type) {
            case 'admin':
                return Author::create([
                    'name' => $user->name,
                    'country_of_birth' => $country,
                    'comments' => $comments,
                    'user_id' => $user->id
                ]);
            case 'author':
                return Author::firstOrCreate(
                    ['name' => $user->name],
                    ['country' => $country, 'comments' => $comments, 'user_id' => $user->id]);
            case 'user':
                User::where('email', $user->email)->update(['type' => 'author']);
                return Author::create([
                        'name' => $user->name,
                        'country_of_birth' => $country,
                        'comments' => $comments,
                        'user_id' => $user->id
                    ]);
        }
    }

    public function checkAuthorName($authors, $user)
    {
        foreach($authors as $author)
        {
            if ($author->name === $user->name || $user->type === 'admin') {
                return true;
            }
            return false;
        }
    }
}
