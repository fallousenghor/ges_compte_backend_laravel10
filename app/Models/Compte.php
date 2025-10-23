<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'solde',
        'statut',
        'dateCreation',
        'user_id'
    ];

    protected $casts = [
        'dateCreation' => 'date',
        'solde' => 'decimal:2'
    ];

    public function titulaire()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Génère automatiquement le numéro de compte avant la création
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($compte) {
            $date = now()->format('Ymd');
            $lastCompte = self::where('numero', 'like', "CPT-{$date}-%")
                ->orderBy('numero', 'desc')
                ->first();

            if ($lastCompte) {
                $lastNumber = intval(substr($lastCompte->numero, -5));
                $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '00001';
            }

            $compte->numero = "CPT-{$date}-{$newNumber}";
        });
    }
}
