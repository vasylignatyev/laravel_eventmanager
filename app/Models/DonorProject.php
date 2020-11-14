<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DonorProject extends Pivot
{
    protected $fillable = ['description',];
    protected $table = 'donor_project';
    public $incrementing = true;



}
