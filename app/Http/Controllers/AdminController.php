<?php

namespace App\Http\Controllers;

use App\Notifications\BlacklistUser;
use DB;
use App\User;
use App\Vendor;
use App\Blacklist;
use App\Notifications\BlacklistVendor;
use App\Notifications\VendorApproved;
use App\Notifications\VendorRejected;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function new_vendors()
    {
        $vendors = Vendor::whereNull('approved_at')
            ->get();

        return view('admin.new-vendors', compact('vendors'));
    }

    public function approve($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update(['approved_at' => now()]);

        if ($vendor) {
            $vendor->notify(new VendorApproved($vendor));
        }

        return redirect()->route('admin.new-vendors')->withMessage('Vendor has been approved successfully.');
    }

    public function reject($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        if ($vendor) {
            $vendor->notify(new VendorRejected($vendor));
        }

        return redirect()->route('admin.new-vendors')->withMessage('Vendor has been rejected.');
    }

    public function soon_to_weds()
    {
        $users = User::paginate(10);

        return view('admin.users')->with(['users' => $users]);
    }

    public function vendors()
    {
        $vendors = Vendor::paginate(10);

        return view('admin.vendors')->with(['vendors' => $vendors]);
    }

    public function view_stw($id)
    {
        $profile = User::find($id);

        return view('admin.view-stw')->with(['profile' => $profile]);
    }

    public function view_vendor($id)
    {
        $profile = Vendor::find($id);

        $feedbacks = DB::table('feedbacks')
            ->select('feedbacks.*', DB::raw('avg(feedbacks.promptness) as avg_promptness'), DB::raw('avg(feedbacks.value) as avg_value'),
                DB::raw('avg(feedbacks.overall) as avg_overall'), DB::raw('avg(feedbacks.quality) as avg_quality'),
                DB::raw('avg(feedbacks.professionalism) as avg_professionalism'))
            ->join('vendors', 'vendors.id', '=', 'feedbacks.vendor_id')
            ->where('vendor_id', $id)
            ->get();

        return view('admin.view-vendor')->with(['profile' => $profile])->with(['feedbacks' => $feedbacks]);
    }

    public function view_portfolio($id)
    {
        $vendor = Vendor::find($id);

        $portfolios = DB::table('vendor_portfolios')
            ->select('vendor_portfolio')
            ->where('vendor_id', $id)
            ->get();

        return view('admin.view-portfolio')->with(['vendor' => $vendor])->with(['portfolios' => $portfolios]);
    }

    public function stw_reports()
    {
        $reports = DB::table('report_soon_to_weds')
            ->select('report_soon_to_weds.*', 'soon_to_weds.bride_first_name', 'soon_to_weds.bride_last_name', 'soon_to_weds.groom_first_name',
                'soon_to_weds.groom_last_name', 'vendors.first_name', 'vendors.last_name')
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'report_soon_to_weds.soon_to_wed_id')
            ->join('vendors', 'vendors.id', '=', 'report_soon_to_weds.vendor_id')
            ->get();

        return view('admin.stw-reports')->with(['reports' => $reports]);
    }

    public function vendor_reports()
    {
        $reports = DB::table('report_vendors')
            ->select('report_vendors.*', 'soon_to_weds.bride_first_name', 'soon_to_weds.bride_last_name', 'soon_to_weds.groom_first_name',
                'soon_to_weds.groom_last_name', 'vendors.first_name', 'vendors.last_name')
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'report_vendors.soon_to_wed_id')
            ->join('vendors', 'vendors.id', '=', 'report_vendors.vendor_id')
            ->get();

        return view('admin.vendor-reports')->with(['reports' => $reports]);
    }

    public function view_blacklist_stw($id)
    {
        $user = User::find($id);

        return view('admin.blacklist.add-stw')->with(['user' => $user]);
    }

    public function blacklist_stw(Request $request, $id)
    {
        $users = User::find($id);

        $users->blacklisted_at = now();

        $users->save();

        $blacklist = new Blacklist;
        $blacklist->soon_to_wed_id = $request->soon_to_wed_id;
        $blacklist->reason = $request->reason;

        $users->soon_to_wed_blacklists()->save($blacklist);

        if ($users) {
            $users->notify(new BlacklistUser($users));
        }

        return back()->withMessage('You have successfully blacklisted this user.');
    }

    public function view_blacklist_vendor($id)
    {
        $vendor = Vendor::find($id);

        return view('admin.blacklist.add-vendor')->with(['vendor' => $vendor]);
    }

    public function blacklist_vendor(Request $request, $id)
    {
        $vendors = Vendor::find($id);

        $vendors->blacklisted_at = now();

        $vendors->save();

        $blacklist = new Blacklist;
        $blacklist->vendor_id = $request->vendor_id;
        $blacklist->reason = $request->reason;

        $vendors->vendor_blacklists()->save($blacklist);

        if ($vendors) {
            $vendors->notify(new BlacklistVendor($vendors));
        }

        return back()->withMessage('You have successfully blacklisted this user.');
    }

    public function blacklist()
    {
        $blacklists = DB::table('blacklists')
            ->select('blacklists.*', 'soon_to_weds.*', 'vendors.*')
            ->leftJoin('vendors', 'vendors.id', '=', 'blacklists.vendor_id')
            ->leftJoin('soon_to_weds', 'soon_to_weds.id', '=', 'blacklists.soon_to_wed_id')
            //->whereNotNull('soon_to_weds.blacklisted_at')
            //->whereNotNull('vendors.blacklisted_at')
            ->get();

        //dd($blacklists);

        return view('admin.blacklist.blacklist')->with(['blacklists' => $blacklists]);
    }

    public function audit_logs()
    {
        $audits = DB::table('audit_logs')
            ->select('*')
            ->paginate(10);

        $stw = DB::table('soon_to_weds')
            ->select('id', 'bride_first_name AS first_name', 'groom_first_name as last_name', 'user_type', 'last_login_at')
            ->whereNotNull('last_login_at');

        $vendor = DB::table('vendors')
            ->select('id', 'first_name', 'last_name', 'user_type', 'last_login_at')
            ->whereNotNull('last_login_at');

        $logins = DB::table('admins')
            ->select('id', 'first_name', 'last_name', 'user_type', 'last_login_at')
            ->whereNotNull('last_login_at')
            ->unionAll($stw)
            ->unionAll($vendor)
            ->paginate(10);

        return view ('admin.audits')->with(['audits' => $audits])->with(['logins' => $logins]);
    }
}
