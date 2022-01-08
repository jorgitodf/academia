<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class GroupExercise extends Model
{
    protected $table = 'group_exercises';
    protected $fillable = [
        'name'
    ];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }


    /* Mutators */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

}
