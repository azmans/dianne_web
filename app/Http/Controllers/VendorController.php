<?php

namespace App\Http\Controllers;

use App\Mail\BookingRejected;
use App\Notifications\BookingAccepted;
use App\Notifications\BookingCancelledVendor;
use App\Notifications\NewUserReport;
use DB;
use PDF;
use App\MyClients;
use App\Portfolio;
use App\User;
use App\Vendor;
use App\Income;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function approval()
    {
        return view('approval');
    }

    public function profile($id)
    {
        $profile = User::find($id);

        return view('vendor.view')->with(['profile' => $profile]);
    }

    public function index()
    {
        $profiles = DB::table('vendors')
            ->select('id', 'first_name', 'last_name', 'email', 'mobile', 'company_name',
                'vendor_type', 'city', 'price_range', 'tin', 'sec_dti_number',
                'mayors_permit', 'profile_picture')
            ->where('id', Auth::guard('vendor')->user()->id)
            ->get();

        return view('vendor.dashboard')->with('profiles', $profiles);
    }

    public function edit_profile($id) {
        $profile = Vendor::find($id);

        return view('vendor.edit')->with(['profile' => $profile]);
    }

    public function update_profile(Request $request, $id) {
        $profile = Vendor::find($id);

        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->email = $request->email;
        $profile->mobile = $request->mobile;
        $profile->city = $request->city;
        $profile->price_range = $request->price_range;

        $profile->update(['first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'email' => $request->email,
                            'mobile' => $request->mobile,
                            'city' => $request->city,
                            'price_range' => $request->price_range,

        ]);
        $request->session()->flash('message', 'Your profile has been successfully saved.');
        return redirect('/vendor/dashboard');
    }

    public function update_profile_picture(Request $request)
    {
        $profile = Vendor::where('id', '=', auth()->guard('vendor')->user()->id)
            ->first();

        if ($request->hasFile('profile_picture'))
        {
            $image = public_path("/images/{$profile->profile_picture}"); // get previous image from folder
            if (file_exists($image)) { // unlink or remove previous image from folder
                unlink($image);
            }

            $request->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $image_name = $profile->id.'_profile_picture'.time().'.'.request()->profile_picture->getClientOriginalExtension();

            $request->profile_picture->storeAs('images',$image_name);

            $profile->profile_picture = $image_name;

            $profile->update(['profile_picture' => $image_name]);

            return back()->withMessage('You have successfully updated your profile picture.');
        }
    }

    public function view_delete($id)
    {
        $profile = Vendor::find($id);

        return view('vendor.delete')->with(['profile' => $profile]);
    }

    public function delete($id)
    {
        $profile = Vendor::find($id);

        $profile->delete();

        $image = str_replace('/storage', '', $profile->image_path);

        Storage::delete('/public' . $image);

        //Storage::delete(public_path('/images/{$profile->profile_picture}'));

        return view('index');
    }

    public function requests()
    {
        $lists = DB::table('bookings')
            ->select(['bookings.id', 'soon_to_weds.id', 'soon_to_weds.bride_first_name',
                'soon_to_weds.bride_last_name', 'soon_to_weds.groom_first_name', 'soon_to_weds.groom_last_name',
                'bookings.date', 'bookings.time', 'bookings.status',
                'bookings.details', 'bookings.created_at'])
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'bookings.soon_to_wed_id')
            ->where('bookings.status', 'Pending')
            ->where('bookings.vendor_id', auth()->guard('vendor')->user()->id)
            ->get();

        return view('vendor.booking.new-bookings')->with('lists', $lists);
    }

    public function accept(Request $request, $id)
    {
        $soon_to_wed = User::findOrFail($id);

        $vendor = Vendor::where('id', auth()->guard('vendor')->user()->id)
            ->first();

        $soon_to_wed->vendor_bookings()->updateExistingPivot(auth()->guard('vendor')->user()->id,
            ['status' => 'Accepted']);

        $soon_to_wed->vendor_clients()->attach(auth()->guard('vendor')->user()->id, [
            'notes' => $request['notes'],
            'fully_paid' => $request['fully_paid'],
            'deposit_paid' => $request['deposit_paid']
        ]);

        $soon_to_wed->notify(new BookingAccepted($vendor));

        return redirect()->route('vendor.booking.new-bookings')->withMessage('You have successfully accepted this booking request.');
    }

    public function reject_mail($id)
    {
        $user = User::find($id);

        return view('reject')->with(['user' => $user]);
    }

    public function reject_booking(Request $request, $id)
    {
        $user = User::find($id);

        $vendor = Vendor::where('id', auth()->guard('vendor')->user()->id)->first();

        $user->vendor_bookings()->updateExistingPivot(auth()->guard('vendor')->user()->id,
            ['status' => 'Rejected']);

        $data = [
            'bride_first_name' => $user->bride_first_name,
            'bride_last_name' => $user->bride_last_name,
            'groom_first_name' => $user->groom_first_name,
            'groom_last_name' => $user->groom_last_name,
            'stw_email' => $user->email,
            'first_name' => $vendor->first_name,
            'last_name' => $vendor->last_name,
            'email' => $vendor->email,
        ];

        Mail::send(new BookingRejected($request, $data), ['data' => $data]);

        return back()->withMessage('You have successfully rejected this user.');
    }

    public function manage_bookings()
    {
        $bookings = DB::table('bookings')
            ->select('bookings.*', 'soon_to_weds.*')
            ->where('vendor_id', auth()->guard('vendor')->user()->id)
            ->where('status', '=', 'Accepted')
            ->orWhere('status', '=', 'Rejected')
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'bookings.soon_to_wed_id')
            ->get();

        return view('vendor.booking.bookings')->with(['bookings' => $bookings]);
    }

    public function cancel_booking($id)
    {
        $user = User::find($id);

        $vendor = Vendor::where('id', auth()->guard('vendor')->user()->id)
            ->first();

        $user->vendor_bookings()->updateOrCreate(auth()->guard('vendor')->user()->id, [
            'cancel_date' => now(),
            'status' => 'Canceled'
        ]);

        $user->notify(new BookingCancelledVendor($vendor));

        return redirect()->route('vendor.booking.bookings')->withMessage('You have successfully cancelled an appointment with this user.');
    }

    public function clients()
    {
        $lists = DB::table('bookings')
            ->select(['soon_to_weds.id', 'soon_to_weds.bride_first_name', 'soon_to_weds.bride_last_name',
                'groom_first_name', 'groom_last_name', 'soon_to_weds.wedding_date', 'bookings.date', 'bookings.time',
                'my_clients.notes', 'my_clients.fully_paid', 'my_clients.deposit_paid'])
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'bookings.soon_to_wed_id')
            ->join('my_clients', 'my_clients.vendor_id', '=', 'bookings.vendor_id')
            ->where('bookings.status', 'Accepted')
            ->get();

        return view('vendor.clients')->with('lists', $lists);
    }

    public function edit_client($id)
    {
        $client = MyClients::find($id);

        return view('vendor.edit-client')->with(['client' => $client]);
    }

    public function update_client(Request $request, $id)
    {
        $client = MyClients::find($id);

        $client->vendor_clients()->updateExistingPivot(auth()->guard('vendor')->user()->id, [
            'notes' => $request->notes,
            'fully_paid' => $request->$request->input('fully_paid')=='on' ? 1:0,
            'deposit_paid' => $request->$request->input('deposit_paid')=='on' ? 1:0
        ]);

        return back()->withMessage('You have successfully added notes to this client.');
    }

    public function report($id)
    {
        $profile = User::find($id);

        return view('vendor.report')->with(['profile' => $profile]);
    }

    public function submit_report(Request $request, $id)
    {
        $profile = User::find($id);

        $profile->vendor_reports()->attach(auth()->guard('vendor')->user()->id, [
            'subject' => $request['subject'],
            'report_type' => $request['report_type'],
            'report' => $request['report'],
            'status' => 'New'
        ]);

        $profile->notify(new NewUserReport());

        return back()->withMessage('You have successfully reported this user. We will look into your report as soon as possible.');
    }

    public function view_profile($id)
    {
        $profile = User::find($id);

        return view('vendor.view')->with(['profile' => $profile]);
    }

    public function vendor_portfolio()
    {
        $portfolios = DB::table('vendor_portfolios')
            ->where('vendor_id', auth()->guard('vendor')->user()->id)
            ->get();

        return view('vendor.portfolio')->with(['portfolios' => $portfolios]);
    }

    public function create_portfolio()
    {
        return view('vendor.create-portfolio');
    }

    public function save_portfolio(Request $request, $id)
    {
        $profile = Vendor::find($id);

        $portfolio = new Portfolio;
        $portfolio->vendor_portfolio = $request->input('vendor_portfolio');

        $profile->portfolios()->save($portfolio);

        return back()->withMessage('You have successfully created your couple page.');
    }

    public function edit_portfolio($id)
    {
        $portfolio = Portfolio::find($id);

        return view('vendor.edit-portfolio')->with(['portfolio' => $portfolio]);
    }

    public function update_portfolio(Request $request, $id)
    {
        $portfolio = Portfolio::find($id);

        $portfolio->vendor_portfolio = $request->vendor_portfolio;

        $portfolio->update(['vendor_portfolio' => $request->vendor_portfolio]);
        return back()->withMessage('You have saved changes to your couple page successfully.');
    }

    public function incomes()
    {
        $lists = DB::table('incomes')
            ->select(['incomes.*', 'soon_to_weds.bride_first_name', 'soon_to_weds.bride_last_name', 'soon_to_weds.groom_first_name',
                'soon_to_weds.groom_last_name'])
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'incomes.soon_to_wed_id')
            ->where('incomes.vendor_id', '=', auth()->guard('vendor')->user()->id)
            ->get();

        return view('vendor.income.incomes')->with(['lists' => $lists]);
    }

    public function add_income($id)
    {
        $vendors = Vendor::find($id);

        $users = array('user' => DB::table('my_clients')
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'my_clients.soon_to_wed_id')
            ->where('my_clients.soon_to_wed_id', $id)
            ->get());

        return view('vendor.income.add', $users)->with(['vendors' => $vendors]);
    }

    public function save_income(Request $request, $id)
    {
        $vendors = Vendor::find($id);

        $vendors->soon_to_wed_incomes()->attach(auth()->guard('vendor')->user()->id, [
            'soon_to_wed_id' => $request['soon_to_wed_id'],
            'payment_type' => $request['payment_type'],
            'status' => $request['status'],
            'date_paid' => $request['date_paid']
        ]);

        return view('vendor.income.incomes')->withMessage('You have successfully added a payment transaction.');
    }

    public function edit_income($id)
    {
        $income = Income::find($id);

        return view('vendor.income.edit')->with(['income' => $income]);
    }

    public function update_income(Request $request, $id)
    {
        $income = Income::find($id);

        $income->payment_type = $request->payment_type;
        $income->is_installment = $request->input('is_installment')=='on' ? 1:0;
        $income->is_full = $request->input('is_full')=='on' ? 1:0;
        $income->amount = $request->amount;
        $income->status = $request->status;
        $income->date_paid = $request->date_paid;

        $income->update(['payment_type' => $request->payment_type,
            'is_installment' => $request->input('is_installment')=='on' ? 1:0,
            'is_full' => $request->input('is_full')=='on' ? 1:0,
            'amount' => $request->amount,
            'status' => $request->status,
            'date_paid' => $request->date_paid]);

        return view('vendor.income.incomes')->withMessage('You have saved changes to your couple page successfully.');
    }

    public function feedback()
    {
        $feedbacks = DB::table('feedbacks')
            ->select('feedbacks.*', 'soon_to_weds.*', 'vendors.*')
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'feedbacks.soon_to_wed_id')
            ->join('vendors', 'vendors.id', '=', 'feedbacks.vendor_id')
            ->where('feedbacks.vendor_id', auth()->guard('vendor')->user()->id)
            ->get();

        return view('vendor.feedback')->with(['feedbacks' => $feedbacks]);
    }

    public function summary()
    {
        $bookings = DB::table('bookings')
            ->select(['bookings.*', 'soon_to_weds.id', 'soon_to_weds.bride_first_name',
                'soon_to_weds.bride_last_name', 'soon_to_weds.groom_first_name', 'soon_to_weds.groom_last_name'])
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'bookings.soon_to_wed_id')
            ->where('bookings.status', 'Pending')
            ->where('bookings.vendor_id', Auth::id())
            ->get();

        return view('vendor.summary')->with(['bookings' => $bookings]);
    }
}
