<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public $fillable = [
        'list_id', 'order', 'task'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

}
