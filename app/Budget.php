<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use Auditable;

    protected $table = 'budgets';

    protected $fillable = ['budget'];

    public function soon_to_wed_budgets()
    {
        return $this->belongsTo('App\User');
    }
}
