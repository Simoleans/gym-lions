<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;



class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Attendance/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $user = User::where('id_number', $request->code)->first();
        $attendance_count = Attendance::where('user_id', $user->id)->count();

        if ($attendance_count >= $user->subscriptions->first()->remaining_classes) {
            return response()->json([
                'error' => true,
                'message' => 'Usuario no tiene clases disponibles',
                'user' => $user,
            ]);
        }

        //dd($user,$user->subscriptions->first()->id);

        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        Attendance::create([
            'user_id' => $user->id,
            'subscription_id' => $user->subscriptions->first()->id,
            'date' => now(),
        ]);

        return response()->json([
            'error' => false,
            'user' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
