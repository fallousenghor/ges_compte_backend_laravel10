<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'departement',
        'fonction'
    ];

    /**
     * Get the user record associated with the admin.
     */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
