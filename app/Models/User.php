<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'allergy',
        'id_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'is_moroso',
        'attendance_count',
        'plan_name',
        'plan_personalizado',
        'clases_restantes',
        'plans',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //boot passqword is id_number
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->password = Hash::make($user->id_number);
        });
    }
    /**
     * Relación con la tabla subscriptions
     * Un usuario (cliente) puede tener múltiples suscripciones a lo largo del tiempo
     */
    public function subscriptions()
    {
        return $this->hasOne(Subscription::class);
    }

    /**
     * Relación con la tabla attendances
     * Un usuario puede tener muchos registros de asistencia
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function scopeWhereRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * DÍAS RESTANTES de su suscripción activa
     */


    /**
     * ¿ESTÁ MOROSO?
     */
    public function getIsMorosoAttribute()
    {
        $activeSubscription = $this->subscriptions()
            ->where('status', 'active')
            ->latest('start_date')
            ->first();

        if (!$activeSubscription) {
            return true;
        }

        $endDate = \Carbon\Carbon::parse($activeSubscription->end_date);
        return $endDate->isPast(); // true si ya pasó la fecha de vencimiento
    }

    /**
     * CUÁNTOS DÍAS HA ASISTIDO
     */
    public function getAttendanceCountAttribute()
    {
        return $this->attendances()->count();
    }

    /**
     * PLAN QUE TIENE EL USUARIO (si es personalizado o no)
     */
    public function getPlanNameAttribute()
    {
        $activeSubscription = $this->subscriptions()
            ->where('status', 'active')
            ->latest('start_date')
            ->first();

        if (!$activeSubscription) {
            return 'Sin suscripción';
        }

        if (is_null($activeSubscription->plan_id)) {
            return 'Personalizado (' . $activeSubscription->remaining_classes . ' clases)';
        }

        $plan = $activeSubscription->plan;
        return $plan ? $plan->name : 'Plan no encontrado';
    }

    public function getPlanPersonalizadoAttribute()
    {
        $activeSubscription = $this->subscriptions()
            ->where('status', 'active')
            ->latest('start_date')
            ->first();

        if (!$activeSubscription) {
            return false;
        }

        if (is_null($activeSubscription->plan_id)) {
            return $activeSubscription->remaining_classes;
        }

        return false;
    }

    /**
     * CLASES RESTANTES si el plan es personalizado
     */
    public function getClasesRestantesAttribute()
    {
        if (!$this->plan_personalizado) {
            return null;
        }

        return max($this->plan_personalizado - $this->attendance_count, 0);
    }

    //attr plans
    public function getPlansAttribute()
    {
        return Plan::all();
    }


}
