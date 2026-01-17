<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Patient;

class Analyse extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'access_id',
        'pdf_path',
        'doctor_id',
        'patient_id'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}

