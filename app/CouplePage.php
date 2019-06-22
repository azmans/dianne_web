<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class CouplePage extends Model
{
    use Auditable;

    protected $table = 'couple_pages';

    protected $fillable = ['couple_page'];

    public function soon_to_wed_couple_pages()
    {
        return $this->belongsTo('App\User');
    }
}
