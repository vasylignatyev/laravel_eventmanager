<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_url', 
        'start_date',
        'end_date'
    ];

    public function donors() 
    {
        return $this->hasMany(Donor::class);
    }


}
