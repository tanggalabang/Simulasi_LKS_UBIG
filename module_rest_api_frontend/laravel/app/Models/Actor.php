<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    public $fillable = [
        'username', 'first_name', 'last_name', 'password', 'token'
    ];


    public $timestamps = false;

    protected $hidden = [
        'password'
    ];
}
