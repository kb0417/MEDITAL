<?php

namespace App\Http\Controllers;

use App\Models\Analyse;
use Illuminate\Http\Request;

class DoctorAnalyseController extends Controller
{
    public function index()
    {
        $analyses = Analyse::with('patient')
            ->where('doctor_id', auth()->id())
            ->latest()
            ->get();

        return view('doctor.analyses.index', compact('analyses'));
    }
}
