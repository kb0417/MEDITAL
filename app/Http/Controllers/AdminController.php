<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $doctorsActive = User::where('role', 'doctor')
            ->where('is_validated', true)
            ->count();

        // IMPORTANT: si certains anciens comptes ont is_validated = NULL
        // ils doivent aussi compter comme "en attente"
        $doctorsPending = User::where('role', 'doctor')
            ->where(function ($q) {
                $q->where('is_validated', false)
                ->orWhereNull('is_validated');
            })
            ->count();

        return view('admin.dashboard', compact('doctorsActive', 'doctorsPending'));
    }


    public function doctors()
    {
        // $pending = User::where('role', 'doctor')
        //     ->where('is_validated', false)
        //     ->latest()
        //     ->get();
        $pending = User::where('role', 'doctor')
            ->where(function ($q) {
                $q->where('is_validated', false)
                ->orWhereNull('is_validated');
            })
            ->latest()
            ->get();


        $validated = User::where('role', 'doctor')
            ->where('is_validated', true)
            ->latest()
            ->get();

        return view('admin.doctors', compact('pending', 'validated'));
    }

    public function validateDoctor(User $user)
    {
        // sécurité : on valide uniquement un doctor
        if ($user->role !== 'doctor') {
            abort(403, 'Utilisateur non médecin');
        }

        $user->update([
            'is_validated' => true,
        ]);

        return redirect()
            ->route('admin.doctors')
            ->with('success', 'Médecin validé avec succès ✅');
    }
}
