<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    protected $table = 'type_users';
    protected $fillable = [
        'type'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
