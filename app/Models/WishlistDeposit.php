<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistDeposit extends Model
{
    use HasFactory;

    protected $fillable = [
        "wishlist_id",
        "amount",
        "deposit_date",
        "description",
    ];

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }
}
