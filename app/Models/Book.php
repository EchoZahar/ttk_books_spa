<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Book
 * @package App\Models
 * @property string $title
 * @property integer $year
 * @property string $description
 * @property string $cover
 * @property boolean $published
 * @property integer $author_id
 *
 * @property Author $author
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'year', 'description', 'cover', 'published', 'author_id'
    ];

    /**
     * @return BelongsTo
     */
    public function authorBook(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    /**
     * Polymorphic relation with section book.
     */
    public function sections()
    {
        return $this->morphedByMany(Section::class, 'bookable');
    }
}
