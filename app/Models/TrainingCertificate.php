<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCertificate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }
}
