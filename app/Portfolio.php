<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use Auditable;

    protected $table = 'vendor_portfolios';

    protected $fillable = ['vendor_portfolio'];

    public function vendor_portfolios()
    {
        return $this->belongsTo('App\Vendor');
    }
}
