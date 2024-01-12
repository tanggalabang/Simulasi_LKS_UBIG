<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Card;


class BoardList extends Model
{
    use HasFactory;

    public $fillable = [
        'board_id', 'order', 'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];


    public function cards()
    {
        return $this->hasMany(Card::class, 'list_id');
    }

}
