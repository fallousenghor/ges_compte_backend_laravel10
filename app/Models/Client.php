<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_client',
        'numero_client'
    ];

    /**
     * Get the user record associated with the client.
     */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
