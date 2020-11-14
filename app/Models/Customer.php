<?php

namespace App\Models;

class Customer extends BaseModel
{
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'second_name',
        'last_name',
        'sex',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
