<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Section
 * @package App\Models
 * @property $name
 * @property $description
 * @property $published
 *
 * @property User $user
 */
class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'published', 'user_id'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $dates = [
        'deleted_at'
    ];
}
