<?php

namespace App\Models;

class Project extends BaseModel
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'short_desc',
        'full_desc',
        'logo_url',
        'start_date',
        'end_date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function donors()
    {
        return $this->belongsToMany(Donor::class)
            ->using('\App\Models\DonorProject');
    }
}
