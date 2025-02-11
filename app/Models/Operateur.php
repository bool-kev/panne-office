<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operateur extends Model
{
    use HasFactory;
    
    protected $fillable=['user_id','departement_id'];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function incidents()
    {
        return $this->departement->incidents->where('statut_id',1)->load(['statut','user','service','departement','images']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
