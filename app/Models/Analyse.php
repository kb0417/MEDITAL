<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Analyse extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'access_id',
        'pdf_path',
        'doctor_id'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}

