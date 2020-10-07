<?php

namespace App\Models;

class Company extends BaseModel
{
    protected $fillable = [
        'title', 'options', 'description',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
