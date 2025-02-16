<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'classes_per_month',
        'price',
        'description',
    ];

    /**
     * Relación con subscriptions
     * Un plan puede estar asociado a muchas suscripciones diferentes
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
