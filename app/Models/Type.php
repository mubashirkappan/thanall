<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'credit_or_debit'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
