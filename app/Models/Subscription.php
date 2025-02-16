<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
        'remaining_classes',
        'status',
    ];

    /**
     * Relación: la suscripción pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: la suscripción pertenece a un plan
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Relación con asistencias: una suscripción puede tener muchas asistencias registradas
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}
