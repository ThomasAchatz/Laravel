<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Book extends Model
{

    protected $fillable = ['isbn', 'title', 'subtitle', 'published', 'price', 'rating',
        'description', 'user_id'];


    public function scopeFavourite($query){
        return $query->where('rating', '>=',8);
    }

    public function images() : HasMany {
        return $this->hasMany(Image::class);
    }
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function authors() : BelongsToMany {
        return $this->belongsToMany(Author::class);
    }
    public function orders() : BelongsToMany {
        return $this->BelongsToMany(Order::class)->withPivot('quantity');
    }
}