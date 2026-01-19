<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Analyse;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Doctors
        $doctorsActive = User::where('role', 'doctor')
            ->where('is_validated', true)
            ->count();

        $doctorsPending = User::where('role', 'doctor')
            ->where(function ($q) {
                $q->where('is_validated', false)->orWhereNull('is_validated');
            })
            ->count();

        // Totaux
        $analysesTotal  = Analyse::count();
        $patientsTotal  = Patient::count();

        // Evolution analyses: ce mois vs mois dernier (en %)
        $startThisMonth = now()->startOfMonth();
        $startLastMonth = now()->subMonthNoOverflow()->startOfMonth();
        $endLastMonth   = now()->subMonthNoOverflow()->endOfMonth();

        $analysesThisMonth = Analyse::where('created_at', '>=', $startThisMonth)->count();
        $analysesLastMonth = Analyse::whereBetween('created_at', [$startLastMonth, $endLastMonth])->count();

        $analysesGrowthPct = $analysesLastMonth == 0
            ? ($analysesThisMonth > 0 ? 100 : 0)
            : round((($analysesThisMonth - $analysesLastMonth) / $analysesLastMonth) * 100);

        // Evolution patients: ce mois vs mois dernier (en %)
        $patientsThisMonth = Patient::where('created_at', '>=', $startThisMonth)->count();
        $patientsLastMonth = Patient::whereBetween('created_at', [$startLastMonth, $endLastMonth])->count();

        $patientsGrowthPct = $patientsLastMonth == 0
            ? ($patientsThisMonth > 0 ? 100 : 0)
            : round((($patientsThisMonth - $patientsLastMonth) / $patientsLastMonth) * 100);

        // Analyses par médecin (top 8)
        $analysesByDoctor = User::query()
            ->where('role', 'doctor')
            ->select('users.id', 'users.name', 'users.email', 'users.is_validated')
            ->leftJoin('analyses', 'analyses.doctor_id', '=', 'users.id')
            ->selectRaw('COUNT(analyses.id) as analyses_count')
            ->groupBy('users.id', 'users.name', 'users.email', 'users.is_validated')
            ->orderByDesc('analyses_count')
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact(
            'doctorsActive',
            'doctorsPending',
            'analysesTotal',
            'patientsTotal',
            'analysesGrowthPct',
            'patientsGrowthPct',
            'analysesByDoctor',
            'analysesThisMonth',
            'patientsThisMonth'
        ));
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
