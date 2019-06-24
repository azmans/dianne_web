<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use Notifiable, Auditable;

    protected $table = 'guests';

    protected $fillable = [
        'first_name', 'last_name', 'allergy', 'meal_type_id', 'plus_one', 'status'
    ];

    public function setAllergyAttribute($value)
    {
        if(is_null($value)) {
            return $value;
        }

        return $this->attributes['allergy'] = Crypt::encrypt($value);
    }

    public function getAllergyAttribute($value)
    {
        if(is_null($value)) {
            return $value;
        }

        return Crypt::decrypt($value);
    }

    public function soon_to_weds_guest()
    {
        return $this->belongsTo('App\User');
    }

    public function guests()
    {
        return $this->belongsToMany('App\User', 'guests', 'meal_type_id',
            'soon_to_wed_id')->withPivot('first_name', 'last_name', 'email', 'allergy',
            'plus_one', 'status')
            ->withTimestamps();
    }
}
