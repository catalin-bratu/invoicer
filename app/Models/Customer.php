<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory, HasUlids;

    protected $fillable = [
        'user_id',
        'name',
        'vat',
        'email',
        'phone',
        'iban',
        'bank',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
