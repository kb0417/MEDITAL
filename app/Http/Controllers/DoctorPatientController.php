<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class DoctorPatientController extends Controller
{
    public function index()
    {
        $patients = Patient::withCount([
                'analyses as analyses_count' => function ($q) {
                    $q->where('doctor_id', auth()->id());
                }
            ])
            ->with(['analyses' => function ($q) {
                $q->where('doctor_id', auth()->id())
                ->latest();
            }])
            ->latest()
            ->get();

        return view('doctor.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('doctor.patients.create');
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:patients,email',
            'phone'     => 'nullable|string|max:50',
        ]);

        // Créer le patient
        $patient = Patient::create($validated);

        //  SI C'EST UNE REQUÊTE AJAX (depuis le modal)
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Patient créé avec succès',
                'patient' => [
                    'id' => $patient->id,
                    'full_name' => $patient->full_name,
                    'email' => $patient->email,
                    'phone' => $patient->phone,
                ]
            ], 201);
        }

        // SINON redirection classique (si quelqu'un accède directement à la page)
        return redirect()
            ->route('doctor.analyses.create')
            ->with('success', 'Patient créé. Vous pouvez maintenant lui associer une analyse.');
    }
}