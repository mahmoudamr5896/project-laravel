<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'media_url', 'media_type', 'text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
