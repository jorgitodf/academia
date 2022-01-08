<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class TrainingSheets extends Model
{
    protected $table = 'training_sheets';
    protected $fillable = [
        'start_date', 'end_date', 'active', 'user_id', 'instructor_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class);
    }

    public function day_week_trainings()
    {
        return $this->hasMany(DayWeekTraining::class);
    }


    /* Mutators */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = trim(Helpers::formataData($value));
    }
}
