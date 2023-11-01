<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function streetlight()
    {
        return $this->belongsTo(Streetlight::class, 'streetlight_id');
    }
}
