<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class DoctorPatientController extends Controller
{
    public function create()
    {
        return view('doctor.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:patients,email',
            'phone'     => 'nullable|string|max:50',
        ]);

        Patient::create($request->only(['full_name','email','phone']));

        return redirect()->route('doctor.analyses.create')
            ->with('success', 'Patient créé. Vous pouvez maintenant lui associer une analyse.');
    }
}
