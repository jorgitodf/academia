<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class PhysicalEvaluationForm extends Model
{
    protected $table = 'physical_evaluation_form';
    protected $fillable = [
        'valuation', 'revaluation', 'objective', 'activity', 'pathologies', 'injuries_surgeries', 'controlled_medication',
        'smoking', 'alcoholic_beverage', 'weight', 'height', 'chest', 'waist', 'left_arm', 'right_arm', 'left_leg', 'right_leg',
        'user_id', 'instructor_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class);
    }


    /* Mutators */
    public function setValuationAttribute($value)
    {
        $this->attributes['valuation'] = trim(Helpers::formataData($value));
    }

    public function setRevaluationAttribute($value)
    {
        $this->attributes['revaluation'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setObjectiveAttribute($value)
    {
        $this->attributes['objective'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setActivityAttribute($value)
    {
        $this->attributes['activity'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setPathologiesAttribute($value)
    {
        $this->attributes['pathologies'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setInjuriesSurgeriesAttribute($value)
    {
        $this->attributes['injuries_surgeries'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setControlledMedicationAttribute($value)
    {
        $this->attributes['controlled_medication'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setSmokingAttribute($value)
    {
        $this->attributes['smoking'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setWeightAttribute($value)
    {
        $this->attributes['weight'] = trim($value);
    }

    public function setHeightAttribute($value)
    {
        $this->attributes['height'] = trim($value);
    }

    public function setChestAttribute($value)
    {
        $this->attributes['chest'] = trim($value);
    }

    public function setWaistAttribute($value)
    {
        $this->attributes['waist'] = trim($value);
    }

    public function setLeftArmAttribute($value)
    {
        $this->attributes['left_arm'] = trim($value);
    }

    public function setRightArmAttribute($value)
    {
        $this->attributes['right_arm'] = trim($value);
    }

    public function setLeftLegAttribute($value)
    {
        $this->attributes['left_leg'] = trim($value);
    }

    public function setRightLegAttribute($value)
    {
        $this->attributes['right_leg'] = trim($value);
    }

}
