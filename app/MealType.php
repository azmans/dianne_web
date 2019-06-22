<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class MealType extends Model
{
    use Auditable;

    protected $table = 'meal_types';

    public function soon_to_wed_meal_types()
    {
        return $this->belongsTo('App\User');
    }
}
