<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    protected $guarded = [];

    public function konten()
    {
        return $this->belongsTo(konten::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
