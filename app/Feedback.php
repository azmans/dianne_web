<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use Auditable;

    protected $table = 'feedbacks';

    public function v_feedbacks()
    {
        return $this->belongsTo('App\Vendor');
    }
}
