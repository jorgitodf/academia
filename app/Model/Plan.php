<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class Plan extends Model
{
    protected $table = 'plans';
    protected $fillable = [
        'plan', 'value', 'active'
    ];



    /* Mutators */
    public function setPlanAttribute($value)
    {
        $this->attributes['plan'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = trim(Helpers::formatarMoeda($value));
    }

    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }
}
