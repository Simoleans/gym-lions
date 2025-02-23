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

    protected $casts = [
        'attended_at' => 'datetime',
    ];

    //boot
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->attended_at = now();
        });
    }
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
