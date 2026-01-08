<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analyse;

class PatientController extends Controller
{
    /**
     * Affiche la page publique patient
     */
    public function index()
    {
        return view('patient.index');
    }

    /**
     * Recherche un résultat via l'ID unique
     */
    public function search(Request $request)
    {
        // Validation simple
        $request->validate([
            'access_id' => 'required|string'
        ], [
            'access_id.required' => 'Veuillez saisir votre ID unique.',
            'access_id.string' => 'L’ID doit être une chaîne de caractères.'
        ]);

        // Recherche dans la base
        $analyse = Analyse::where('access_id', $request->access_id)->first();

        if (!$analyse) {
            // Message métier si ID invalide
            return redirect()->back()->withErrors(['access_id' => 'ID invalide ou résultat indisponible.']);
        }

        // Téléchargement du PDF
        $pdfPath = storage_path('app/public/' . $analyse->pdf_path);

       if (!file_exists($pdfPath)) {
            return redirect()->back()->withErrors(['access_id' => 'Le fichier PDF est introuvable. Veuillez contacter votre médecin.']);
      }

      $dateAnalyse = $analyse->created_at->format('d-m-Y');

      return response()->download($pdfPath, "resultat_$dateAnalyse.pdf");
    }

}
