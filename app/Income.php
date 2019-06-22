<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use Auditable;

    protected $table = 'incomes';

    protected $fillable = [
        'payment_type', 'is_installment', 'is_full', 'amount', 'status', 'date_paid'
    ];

    public function soon_to_wed_incomes()
    {
        return $this->belongsTo('App\Vendor');
    }
}
