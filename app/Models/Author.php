<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Author
 * @package App\Models
 *
 * @property string $name
 * @property string $country_of_birth
 * @property string $comments
 * @property integer $user_id
 *
 * @property User $ownerAuthor
 * @property Book $books
 */
class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'country_of_birth', 'comments', 'user_id'
    ];

    public function ownerAuthor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }

}
