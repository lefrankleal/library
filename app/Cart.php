<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user', 'book', 'quant',
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function books()
    {
        return $this->belongsTo('App\Book');
    }
}
