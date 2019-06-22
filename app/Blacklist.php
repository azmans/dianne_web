<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    use Auditable;

    protected $table = 'blacklists';

    protected $fillable = [
      'soon_to_wed_id', 'vendor_id', 'reason'
    ];

    public function stw_blacklist()
    {
        return $this->belongsTo('App\User');
    }

    public function vendor_blacklist()
    {
        return $this->belongsTo('App\Vendor');
    }
}
