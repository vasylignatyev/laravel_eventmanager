<?php

namespace App\Models;

class Donor extends BaseModel
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
