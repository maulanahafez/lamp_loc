<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Streetlight extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function streetlight_group()
    {
        return $this->belongsTo(StreetlightGroup::class, 'streetlight_group_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'streetlight_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'streetlight_id');
    }
}
