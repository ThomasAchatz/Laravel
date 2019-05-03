<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Order extends Model
{
    protected $fillable = ['date', 'total_brutto', 'total_netto', 'user_id'];
    public function books() : BelongsToMany {
        return $this->belongsToMany(Book::class)->withPivot('quantity');
    }
    public function stati() : HasMany {
        return $this->HasMany(Status::class);
    }
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}