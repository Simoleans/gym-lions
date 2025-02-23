<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Plan, Subscription};
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Str;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $users = User::with(['subscriptions.plan', 'attendances'])->whereRole(2)->paginate(20);
        //$users = User::whereRole(2)->paginate(20);

        return Inertia::render('Users/Index', [
            'users' => $users,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plans = Plan::all();
        return Inertia::render('Users/Create', ['plans' => $plans]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'id_number' => 'unique:users,id_number',
            'phone' => 'nullable',
            'allergy' => 'nullable',
            'role' => 'nullable',
            // Datos para suscripción
            'start_date' => 'required|date',
        ],
        [
            'id_number.required' => 'La cedula es requerida',
            'id_number.unique' => 'La cedula ya está registrada',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El email ya está registrado',
        ]
    );

        DB::beginTransaction();
        try {
            // 1. Crear el usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'id_number' => $request->id_number ?? Str::random(7),
                'phone' => $request->phone,
                'allergy' => $request->allergy,
                'role' => $request->role
            ]);

            $startDate = Carbon::parse($request->start_date);
            $endDate = $startDate->copy()->addMonth()->subDays(2);


            if ($request->plan_id != 'custom') {
                $plan = Plan::find($request->plan_id);
            }

            // 2. Crear la suscripción
             Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $request->plan_id == 'custom' ? null : $request->plan_id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'remaining_classes' => $request->remaining_classes ?? $plan->classes_per_month,
                'status' => 'active',
            ]);

            DB::commit();

            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Error al registrar usuario y suscripción: ' . $e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function renewSubscription(User $user, Request $request)
    {
        $subscription = $user->subscriptions->first();


        if ($subscription->status !== 'inactive') {
            return redirect()->back()->with('error', 'La suscripción aún está activa.');
        }

        if ($request->plan_id != 'custom') {
            $plan = Plan::find($request->plan_id);

            $subscription->update([
                'plan_id' => $plan->id,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonth(),
                'status' => 'active',
                'remaining_classes' => $plan->classes_per_month,
                'status' => 'active',
            ]);
        } else {
            // Renovar con un plan personalizado (sumar clases)
            $newRemainingClasses = $subscription->remaining_classes + $request->remaining_classes;

            $subscription->update([
                'plan_id' => null,
                'remaining_classes' => $newRemainingClasses,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonth(),
                'status' => 'active',
            ]);
        }

        return redirect()->back()->with('success', 'Suscripción renovada exitosamente.');
    }


}
