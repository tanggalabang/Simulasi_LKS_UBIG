<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    use HasFactory;

    public $fillable = [
        'board_id', 'actor_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

}
