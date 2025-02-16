<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_id',
        'attended_at',
    ];

    /**
     * Relación: la asistencia pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: la asistencia pertenece a una suscripción
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
