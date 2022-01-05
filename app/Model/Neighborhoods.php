<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Neighborhoods extends Model
{
    protected $table = 'neighborhoods';
    protected $fillable = [
        'name'
    ];

    public function adresses()
    {
        return $this->hasMany(Adress::class);
    }
}
