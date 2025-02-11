<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = ['service_id','ville_id'];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function operateurs()
    {
        return $this->hasMany(Operateur::class);
    }
}
