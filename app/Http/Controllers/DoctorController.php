<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analyse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnalyseDisponibleMail;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $analyses = Analyse::where('doctor_id', auth()->id())
            ->latest()
            ->get();

        return view('doctor.dashboard', compact('analyses'));
    }

    public function create()
    {
        return view('doctor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        // Générer ID unique
        $accessId = strtoupper(Str::random(8));

        // Stocker le PDF
        $path = $request->file('pdf')->store('analyses', 'public');

        // Enregistrer en base
        Analyse::create([
            'access_id' => $accessId,
            'pdf_path' => $path,
            'doctor_id' => auth()->id(),
        ]);

        // Envoi du mail au patient
        // Ici il faudrait idéalement récupérer l’email du patient lié à cet ID. 
        // Si tu n’as pas de table patient, on peut utiliser un email de test pour l’instant.
        $analyse = Analyse::where('access_id', $accessId)->first();
        $patientEmail = 'essobadj17@gmail.com';
        Mail::to($patientEmail)->send(new AnalyseDisponibleMail($analyse));

        return redirect()
            ->route('doctor.dashboard')
            ->with('success', 'Analyse ajoutée. ID patient : ' . $accessId);
    }
}

