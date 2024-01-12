<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BoardMember;
use App\Models\BoardList;

class Board extends Model
{
    use HasFactory;

    public $fillable = [
        'name', 'creator_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function members()
    {
        return $this->hasMany(BoardMember::class);
    }
    public function lists()
    {
        return $this->hasMany(BoardList::class);
    }
}
