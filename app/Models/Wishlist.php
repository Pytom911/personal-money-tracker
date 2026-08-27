<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "image",
        "target_amount",
        "description",
        "deadline",
        "status",
    ];

    public function deposits()
    {
        return $this->hasMany(WishlistDeposit::class);
    }
}
