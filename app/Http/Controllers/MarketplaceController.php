<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index()
    {
        $items = DB::table('vendors')
            ->select(['id', 'company_name', 'profile_picture', 'price_range', 'first_name', 'last_name', 'vendor_type',
                'profile_picture'])
            ->whereNotNull('approved_at')
            ->whereNull('blacklisted_at')
            ->paginate(9);

        return view('marketplace')->with('items', $items);
    }
}
