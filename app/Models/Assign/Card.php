<?php

namespace App\Models\Assign;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_id',
    ];
    protected $table = "cards";
}
