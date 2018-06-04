<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'image', 'stock', 'price',
    ];

    public function cart()
    {
        return $this->hasMany('App\Cart');
    }
}
