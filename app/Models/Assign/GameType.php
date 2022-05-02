<?php

namespace App\Models\Assign;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
    ];
    protected $table = "gametypes";
}
