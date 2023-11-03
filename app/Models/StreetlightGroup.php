<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreetlightGroup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function streetlights()
    {
        return $this->hasMany(Streetlight::class, 'streetlight_group_id');
    }
}
