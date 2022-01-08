<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class DayWeekTraining extends Model
{
    protected $table = 'day_week_trainings';
    protected $fillable = [
        'day_week', 'training_sheet_id'
    ];

    public function training_sheet()
    {
        return $this->belongsTo(TrainingSheets::class);
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'day_week_training_exercises')->withPivot(['series', 'repetition', 'charge']);
    }

    /* Mutators */
    public function setDayWeekAttribute($value)
    {
        $this->attributes['day_week'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }
}
