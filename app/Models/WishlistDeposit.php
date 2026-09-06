<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistDeposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'wishlist_id',
        'amount',
        'description',
        'deposit_date',
    ];

    protected function casts(): array
    {
        return [
            'deposit_date' => 'date',
            'amount' => 'decimal:0',
        ];
    }

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }
}