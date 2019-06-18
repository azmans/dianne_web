<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyClients extends Model
{
    protected $table = 'my_clients';

    protected $fillable = [
        'notes', 'fully_paid', 'deposit_paid'
    ];

    public function soon_to_wed_clients()
    {
        return $this->belongsTo('App\Vendor');
    }
}
