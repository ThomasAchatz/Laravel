<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Author extends Model
{
    protected $fillable = [
        'fistname', 'lastname'
    ];
    public function books() : BelongsToMany {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
}