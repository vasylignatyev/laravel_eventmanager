<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'logo_url', 
        'country',
        'tagline',
    ];

    public function projects() 
    {
        return $this->belongsToMany(Project::class)
            ->using('\App\Models\DonorProject');
    }
}
