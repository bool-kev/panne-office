<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;

    protected $fillable=['nom','icons'];

    public function departements()
    {
        return $this->hasMany(Departement::class);
    }

    public function dept_seed()
    {
        return $this->belongsToMany(Ville::class,'departements');
    }

    public function getIcons()
    {
        return Storage::disk('public')->url($this->icons);
    }

    public function incidents()
    {
        return $this->hasManyThrough(Incident::class,Departement::class);
    }

    
}
