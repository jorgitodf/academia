<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PublicPlace extends Model
{
    protected $table = 'public_places';
    protected $fillable = [
        'name'
    ];

    public function adresses()
    {
        return $this->hasMany(Adress::class);
    }
}
