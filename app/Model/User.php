<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Helpers\Helpers;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'birth_date', 'profession', 'registration', 'cpf', 'gender', 'photo', 'email', 'password', 'type_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function type_user()
    {
        return $this->belongsTo(TypeUser::class);
    }

    public function phone()
    {
        return $this->hasOne(Phone::class);
    }

    public function adress()
    {
        return $this->hasOne(Adress::class);
    }

    public function registrations()
    {
        return $this->hasOne(Registration::class);
    }

    public function physical_evaluation_form()
    {
        return $this->hasMany(PhysicalEvaluationForm::class);
    }

    /* Mutators */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setProfessionAttribute($value)
    {
        $this->attributes['profession'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = trim(Helpers::formataData($value));
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = trim(Helpers::limpaCPF($value));
    }

    public function setGenderAttribute($value)
    {
        $this->attributes['gender'] = trim(mb_convert_case($value, MB_CASE_TITLE, "UTF-8"));
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = trim(strtolower($value));
    }
}
