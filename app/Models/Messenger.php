<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    use HasFactory;

    protected $fillable = ['text_messenger'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
