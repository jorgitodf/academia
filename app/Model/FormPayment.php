<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class FormPayment extends Model
{
    protected $table = 'form_payment';
    protected $fillable = [
        'payment_method'
    ];

    public function registrations()
    {
        return $this->hasOne(Registration::class);
    }


    /* Mutators */
    public function setFormPaymentAttribute($value)
    {
        $this->attributes['payment_method'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

}
