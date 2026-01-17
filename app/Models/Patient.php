<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Analyse;

class Patient extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone'
    ];

    public function analyses()
    {
        return $this->hasMany(Analyse::class);
    }
}

