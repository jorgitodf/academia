<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class Registration extends Model
{
    protected $table = 'registrations';
    protected $fillable = [
        'registration', 'start_date', 'end_date', 'paid_out', 'user_id', 'plan_id', 'form_payment_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function form_payment()
    {
        return $this->belongsTo(FormPayment::class);
    }


    /* Mutators */
    public function setRegistrationAttribute($value)
    {
        $this->attributes['registration'] = trim($value);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = trim(Helpers::formataData($value));
    }

    public function setPaidOutAttribute($value)
    {
        $this->attributes['paid_out'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }
}
