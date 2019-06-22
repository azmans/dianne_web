<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use Auditable;

    protected $table = 'payments';

    protected $fillable = [
        'payment_type', 'is_installment', 'is_full', 'amount', 'status', 'date_paid'
    ];

    public function vendor_payments()
    {
        return $this->belongsTo('App\User');
    }
}
