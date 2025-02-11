<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $fillable=[
        'description',
        'departement_id',
        'note_id',
        'location',
        'user_id',
        'statut_id',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statut()
    {
        return $this->belongsTo(Statut::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function service()
    {
        return $this->hasOneThrough(Service::class,Departement::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function scopeToday(Builder $query)
    {
        $query->whereDate('created_at', Carbon::today());
    }

    public function casts()
    {
        return [
            'point'=>'int'
        ];
    }

    
    
}
