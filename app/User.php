<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'soon_to_weds';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type', 'bride_first_name', 'bride_last_name', 'groom_first_name', 'groom_last_name', 'email',
        'password', 'dob', 'wedding_date', 'profile_picture', 'last_login_at', 'blacklisted_at'
    ];

    public function getProfilePictureAttribute()
    {
        if (! $this->attributes['profile_picture']) {
            return '/img/user.png';
        }
            return $this->attributes['profile_picture'];
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_type', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vendors()
    {
        return $this->belongsToMany('App\Vendor', 'soon_to_wed_vendor',
            'soon_to_wed_id', 'vendor_id')
            ->withTimestamps();
    }

    public function vendor_bookings()
    {
        return $this->belongsToMany('App\Vendor', 'bookings',
            'soon_to_wed_id', 'vendor_id')->withPivot('date', 'time', 'details',
                'cancel_date', 'status')
            ->withTimestamps();
    }

    public function vendor_clients()
    {
        return $this->belongsToMany('App\Vendor', 'my_clients',
            'soon_to_wed_id', 'vendor_id')->withPivot('notes', 'fully_paid',
                'deposit_paid')
            ->withTimestamps();
    }

    public function vendor_reports()
    {
        return $this->belongsToMany('App\Vendor', 'report_soon_to_weds', 'soon_to_wed_id',
            'vendor_id')->withPivot('subject', 'report_type', 'report', 'status')
            ->withTimestamps();
    }

    public function reports()
    {
        return $this->belongsToMany('App\Vendor', 'report_vendors', 'soon_to_wed_id',
            'vendor_id')->withPivot('subject', 'report_type', 'report', 'status')
            ->withTimestamps();
    }

    public function vendor_payments()
    {
        return $this->belongsToMany('App\Vendor', 'payments', 'soon_to_wed_id',
            'vendor_id')->withPivot('amount', 'payment_type', 'is_full', 'status',
            'is_installment', 'date_paid')
            ->withTimestamps();
    }

    public function vendor_feedbacks()
    {
        return $this->belongsToMany('App\Vendor', 'feedbacks', 'soon_to_wed_id',
            'vendor_id')->withPivot('value', 'promptness', 'quality', 'professionalism',
            'overall')
            ->withTimestamps();
    }

    public function vendor_incomes()
    {
        return $this->belongsToMany('App\Vendor', 'incomes', 'soon_to_wed_id',
            'vendor_id')->withPivot('amount', 'payment_type', 'is_full', 'status',
            'is_installment', 'date_paid')
            ->withTimestamps();
    }

    public function budgets()
    {
        return $this->hasMany('App\Budget', 'soon_to_wed_id');
    }

    public function budget_items()
    {
        return $this->hasMany('App\BudgetItem', 'soon_to_wed_id');
            //->join('budgets', 'budget.soon_to_wed_id', '=', 'soon_to_weds.id')
            //->where('budgets.soon_to_wed_id', auth()->user()->id);
    }

    public function guests()
    {
        return $this->hasMany('App\Guest', 'soon_to_wed_id');
    }

    public function meal_types()
    {
        return $this->hasMany('App\MealType', 'soon_to_wed_id');
    }

    public function couple_pages()
    {
        return $this->hasMany('App\CouplePage', 'soon_to_wed_id');
    }

    public function soon_to_wed_blacklists()
    {
        return $this->hasMany('App\Blacklist', 'soon_to_wed_id');
    }

    /*public function payments()
    {
        return $this->hasMany('App\Payments', 'soon_to_wed_id');
    }*/
}
