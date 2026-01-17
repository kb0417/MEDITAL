<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analyse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnalyseDisponibleMail;
use App\Models\Patient;

class DoctorController extends Controller
{
    public function dashboard()
    {
        // Stats globales (pas paginées)
        $totalAnalyses = Analyse::where('doctor_id', auth()->id())->count();
        $analysesMois = Analyse::where('doctor_id', auth()->id())
            ->where('created_at', '>=', now()->startOfMonth())
            ->count();
        $analysesSemaine = Analyse::where('doctor_id', auth()->id())
            ->where('created_at', '>=', now()->startOfWeek())
            ->count();

        // Liste paginée
        $analyses = Analyse::where('doctor_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('doctor.dashboard', compact('analyses', 'totalAnalyses', 'analysesMois', 'analysesSemaine'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('doctor.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        // Générer ID unique
        $accessId = strtoupper(Str::random(8));

        // Stocker le PDF
        $path = $request->file('pdf')->store('analyses', 'public');

        // Enregistrer en base
        $analyse = Analyse::create([
            'access_id' => $accessId,
            'pdf_path'  => $path,
            'doctor_id' => auth()->id(),
            'patient_id'=> $request->patient_id,
        ]);
        
        // Envoi du mail au patient
        // Ici il faudrait idéalement récupérer l’email du patient lié à cet ID. 
        // Si tu n’as pas de table patient, on peut utiliser un email de test pour l’instant.
        // $analyse = Analyse::where('access_id', $accessId)->first();
        $patient = Patient::find($request->patient_id);
        if (!$patient) {
            return back()->withErrors(['patient_id' => 'Patient introuvable.']);
        }
        $patientEmail = $patient->email;
        Mail::to($patientEmail)->send(new AnalyseDisponibleMail($analyse));

        return redirect()
            ->route('doctor.dashboard')
            ->with('success', 'Analyse ajoutée. ID patient : ' . $accessId);
    }
}

