<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class Exercise extends Model
{
    protected $table = 'exercises';
    protected $fillable = [
        'name', 'group_exercise_id'
    ];

    public function group_exercise()
    {
        return $this->belongsTo(GroupExercise::class);
    }

	public function day_week_trainings()
    {
        return $this->belongsToMany(DayWeekTraining::class, 'day_week_training_exercises')->withPivot(['series', 'repetition', 'charge']);
    }


    /* Mutators */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }
}

