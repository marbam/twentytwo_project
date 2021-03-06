<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateEntry extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'user_id',
        'populated',
        "description",
        "highlight",
        "movies",
        "shows",
        "games",
        "books",
        "learnings",
        "exercises",
        "walked",
        "alcohol"
    ];
}
