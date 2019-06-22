<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class MyClients extends Model
{
    use Auditable;

    protected $table = 'my_clients';

    protected $fillable = [
        'notes', 'fully_paid', 'deposit_paid'
    ];

    public function soon_to_wed_clients()
    {
        return $this->belongsTo('App\Vendor');
    }
}
