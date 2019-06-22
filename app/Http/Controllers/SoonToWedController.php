<?php

namespace App\Http\Controllers;

use App\BudgetItem;
use DB;
use PDF;
use App\Budget;
use App\CouplePage;
use App\Guest;
use App\MealType;
use App\Payments;
use App\User;
use App\Vendor;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ReportVendor;
use App\Notifications\NewBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SoonToWedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:web','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $profiles = DB::table('soon_to_weds')
            ->select('bride_first_name', 'bride_last_name', 'wedding_date', 'groom_first_name', 'groom_last_name',
                'profile_picture')
            ->where('id', Auth::id())
            ->get();

        return view('dashboard')->with('profiles', $profiles);
    }

    public function edit_profile($id) {
        $profile = User::find($id);

        return view('auth.edit')->with(['profile' => $profile]);
    }

    public function update_profile(Request $request, $id) {
        $profile = User::find($id);

        $profile->bride_first_name = $request->bride_first_name;
        $profile->bride_last_name = $request->bride_last_name;
        $profile->groom_first_name = $request->groom_first_name;
        $profile->groom_last_name = $request->groom_last_name;
        $profile->wedding_date = $request->wedding_date;

        $profile->update(['bride_first_name' => $request->bride_first_name,
                            'bride_last_name' => $request->bride_last_name,
                            'groom_first_name' => $request->groom_first_name,
                            'groom_last_name' => $request->groom_last_name,
                            'wedding_date' => $request->wedding_date,
                        ]);
        return redirect('/dashboard')->withMessage('Your profile has been successfully saved.');
    }

    public function update_profile_picture(Request $request, $id)
    {
        $profile = User::find($id);

        if ($request->hasFile('profile_picture'))
        {
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

    public function request($id)
    {
        $profile = Vendor::find($id);

        return view('auth.request')->with(['profile' => $profile]);
    }

    public function view_profile($id)
    {
        $profile = Vendor::find($id);

        $feedbacks = DB::table('feedbacks')
            ->select('feedbacks.*', DB::raw('avg(feedbacks.promptness) as avg_promptness'), DB::raw('avg(feedbacks.value) as avg_value'),
                DB::raw('avg(feedbacks.overall) as avg_overall'), DB::raw('avg(feedbacks.quality) as avg_quality'),
                DB::raw('avg(feedbacks.professionalism) as avg_professionalism'))
            ->join('vendors', 'vendors.id', '=', 'feedbacks.vendor_id')
            ->where('vendor_id', $id)
            ->get();
        return view('auth.view')->with(['profile' => $profile])->with(['feedbacks' => $feedbacks]);
    }

    public function save_vendor($id)
    {
        $vendor = Vendor::find($id);

        $vendor->soon_to_weds()->attach(Auth::id());

        return back()->withMessage('You have successfully saved this vendor.');
    }

    public function remove_vendor($id)
    {
        $vendor = Vendor::find($id);
        $vendor->soon_to_weds()->detach(Auth::id());

        return redirect()->route('auth.vendors')->withMessage('This vendor has been removed successfully.');
    }

    public function my_vendors()
    {
        $lists = DB::table('soon_to_wed_vendor')
            ->select(['soon_to_wed_vendor.id', 'vendors.id', 'vendors.company_name', 'vendors.price_range',
                'vendors.first_name', 'vendors.last_name', 'vendors.vendor_type'])
            ->join('vendors', 'vendors.id', '=', 'soon_to_wed_vendor.vendor_id')
            ->where('soon_to_wed_vendor.soon_to_wed_id', Auth::id())
            ->get();

        return view('auth.vendors')->with('lists', $lists);
    }

    public function book(Request $request, $id)
    {
        $vendor = Vendor::find($id);

        $vendor->soon_to_wed_bookings()->attach(Auth::id(), [
            'date' => $request['date'],
            'time' => $request['time'],
            'details' => $request['notes'],
            'cancel_date' => $request['cancel_date'],
            'status' => 'Pending'
        ]);


        $vendor->notify(new NewBooking());

        return back()->withMessage('You have successfully booked an appointment with this vendor.');
    }

    public function booking_list()
    {
        $lists = DB::table('bookings')
            ->select(['bookings.id', 'vendors.id', 'vendors.first_name', 'vendors.last_name', 'vendors.company_name',
                'vendors.mobile', 'vendors.vendor_type', 'bookings.date', 'bookings.time', 'bookings.details', 'bookings.status',
                'bookings.created_at'])
            ->join('vendors', 'vendors.id', '=', 'bookings.vendor_id')
            ->where('bookings.soon_to_wed_id', Auth::id())
            ->get();

        return view('auth.booking-requests')->with('lists', $lists);
    }

    public function report_vendor($id)
    {
        $profile = Vendor::find($id);

        return view('auth.report')->with(['profile' => $profile]);
    }

    public function submit_report(Request $request, $id)
    {
        $vendor = Vendor::find($id);

        $vendor->reports()->attach(Auth::id(), [
            'subject' => $request['subject'],
            'report_type' => $request['report_type'],
            'report' => $request['report'],
            'status' => 'New'
        ]);

        $vendor->notify(new ReportVendor());

        return back()->withMessage('You have successfully reported this user. We will look into your report as soon as possible.');
    }

    public function view_portfolio($id)
    {
        $vendor = Vendor::find($id);

        $portfolios = DB::table('vendor_portfolios')
            ->select('vendor_portfolio')
            ->where('vendor_id', $id)
            ->get();

        return view('auth.view-portfolio')->with(['vendor' => $vendor])->with(['portfolios' => $portfolios]);
    }

    public function budget_tracker()
    {
        $query = DB::table('budgets');

        $budget = DB::table('budgets')
            ->select('budget')
            ->where('soon_to_wed_id', Auth::id())
            ->get();

        $lists = DB::table('budget_items')
            ->select('budget_items.*', 'vendors.*')
            ->join('vendors', 'vendors.id', '=', 'budget_items.vendor_id')
            ->where('budget_items.soon_to_wed_id', Auth::id())
            ->get();

        if ($budget->isEmpty())
        {
            $query->where('soon_to_wed_id', Auth::id());
        }

        if ($budget->isNotEmpty() && $lists->isNotEmpty())
        {
            $query->select('budgets.*', 'soon_to_weds.id', 'vendors.*', 'budget_items.*',
                DB::raw('SUM(budgets.budget) - SUM(budget_items.cost) as difference'),
                DB::raw('SUM(budget_items.cost) as used'))
                ->join('soon_to_weds', 'soon_to_weds.id', '=', 'budgets.soon_to_wed_id')
                ->join('budget_items', 'budget_items.soon_to_wed_id', '=', 'soon_to_weds.id')
                ->join('vendors', 'vendors.id', '=', 'budget_items.vendor_id');
        }

        $results = $query->get();

        return view('auth.budget-tracker.budget-tracker')->with(['results' => $results])->with(['lists' => $lists]);
    }

    public function add_budget()
    {
        return view('auth.budget-tracker.add-budget');
    }

    public function save_budget(Request $request, $id) {
        $profile = User::find($id);

        $stw_budget = new Budget;
        $stw_budget->budget = $request->input('budget');

        $profile->budgets()->save($stw_budget);
        return back()->withMessage('The new budget amount you inputted has been saved successfully.');
    }

    public function edit_budget($id)
    {
        $profile = Budget::find($id);

        return view('auth.budget-tracker.edit-budget')->with(['profile' => $profile]);
    }

    public function update_budget(Request $request, $id) {
        $profile = Budget::find($id);

        $profile->budget = $request->budget;

        $profile->update(['budget' => $request->budget]);
        return back()->withMessage('The new budget amount you inputted has been saved successfully.');
    }

    public function add_item($id)
    {
        $profile = User::find($id);

        $vendors = array('vendor' => DB::table('soon_to_wed_vendor')
            ->join('vendors', 'vendors.id', '=', 'soon_to_wed_vendor.vendor_id')
            ->where('soon_to_wed_vendor.soon_to_wed_id', Auth::id())
            ->get());

        return view('auth.budget-tracker.add-item', $vendors)->with(['profile' => $profile]);
    }

    public function save_item(Request $request, $id)
    {
        $profile = User::find($id);

        $item = new BudgetItem();
        $item->budget_item = $request->budget_item;
        $item->vendor_id = $request->vendor_id;
        $item->cost = $request->cost;
        $item->is_paid = $request->input('is_paid')=='on' ? 1:0;
        $item->notes = $request->notes;

        $profile->budget_items()->save($item);
        return back()->withMessage('You have successfully added an item.');
    }

    public function edit_item($id)
    {
        $item = BudgetItem::find($id);

        return view('auth.budget-tracker.edit-item')->with(['item' => $item]);
    }

    public function update_item(Request $request, $id)
    {
        $item = BudgetItem::find($id);

        $item->budget_item = $request->budget_item;
        $item->cost = $request->cost;
        $item->is_paid = $request->is_paid;
        $item->notes = $request->notes;

        $item->update(['budget_item' => $request->budget_item,
            'cost' => $request->cost,
            'is_paid' => $request->input('is_paid')=='on' ? 1:0,
            'notes' => $request->notes]);

        return back()->withMessage('You have successfully edited this item.');
    }

    public function export_budget()
    {
        $data = DB::table('budget_items')
            ->select('soon_to_weds.id', 'vendors.*', 'budget_items.*')
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'budget_items.soon_to_wed_id')
            ->join('vendors', 'vendors.id', '=', 'budget_items.vendor_id')
            ->where('budget_items.soon_to_wed_id', Auth::id())
            ->get();

        $pdf = PDF::loadView('auth.budget-tracker.export', compact('data'))->setPaper('a4', 'portrait');

        return $pdf->stream(now() . '.pdf');
    }

    public function guestlist()
    {
        $guests = DB::table('guests')
            ->select(DB::raw('SUM(status = "Attending") as attending'),
                DB::raw('SUM(plus_one = "1") as additional'),
                DB::raw('SUM(plus_one = "1") + SUM(status = "Attending") as total'),
                DB::raw('SUM(status = "Pending") as pending'),
                DB::raw('SUM(status = "Declined") as declined'))
            ->where('soon_to_wed_id', Auth::id())
            ->get();

        $details = DB::table('guests')
            ->leftJoin('meal_types', 'meal_types.id', '=', 'guests.meal_type_id')
            ->where('guests.soon_to_wed_id', Auth::id())
            ->paginate(10);

        return view('auth.guestlist.guestlist')->with(['details' => $details])->with(['guests' => $guests]);
    }

    public function meals()
    {
        $meals = DB::table('meal_types')
            ->select(['soon_to_weds.id', 'meal_types.meal_type', 'meal_types.created_at'])
            ->join('soon_to_weds', 'soon_to_weds.id', '=', 'meal_types.soon_to_wed_id')
            ->where('soon_to_weds.id', Auth::id())
            ->get();

        return view('auth.guestlist.meals')->with(['meals' => $meals]);
    }

    public function set_meal($id)
    {
        $profiles = User::find($id);

        return view('auth.guestlist.add-meal')->with(['profiles' => $profiles]);
    }

    public function add_meal(Request $request, $id)
    {
        $profile = User::find($id);

        $meal = new MealType;
        $meal->meal_type = $request->meal_type;

        $profile->meal_types()->save($meal);
        return back()->withMessage('The new response date you inputted has been saved successfully.');
    }

    public function add_guest($id)
    {
        $profiles = User::find($id);

        return view('auth.guestlist.add-guest')->with(['profiles' => $profiles]);
    }

    public function save_guest(Request $request, $id)
    {
        $profiles = User::find($id);

        $guest = new Guest;
        $guest->first_name = $request->first_name;
        $guest->last_name = $request->last_name;
        $guest->email = $request->email;
        $guest->status = 'Invite Not Sent';

        $profiles->guests()->save($guest);
        return back()->withMessage('You have successfully added a guest.');
    }

    public function send(Request $request, $id)
    {
        $guest = Guest::find($id);

        $couple = User::where('id', Auth::id())->first();

        $guest->status = $request->status;

        $guest->update(['status' => 'Pending']);

        $data = [
            'first_name' => $guest->first_name,
            'last_name' => $guest->last_name,
            'email' => $guest->email,
            'bride_first_name' => $couple->bride_first_name,
            'bride_last_name' => $couple->bride_last_name,
            'groom_first_name' => $couple->groom_first_name,
            'groom_last_name' => $couple->groom_last_name,
            'couple_email' => $couple->email,
            'wedding_date' => $couple->wedding_date,
            'id' => $couple->id
        ];

        Mail::send('emails.invitation', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'], $data['first_name'] . ' ' . $data['last_name'])
                ->from($data['couple_email'], $data['bride_first_name'] . ' ' . $data['bride_last_name']
                    . ' & ' . $data['groom_first_name'] . ' ' . $data['groom_last_name'])
                ->subject('You are cordially invited to...');
        });

        return back()->with(['guest' => $guest])->with(['couple' => $couple]);
    }

    public function edit_guest($id)
    {
        $guest = Guest::find($id);

        $meals = array('meal' => DB::table('meal_types')
            ->where('meal_types.soon_to_wed_id', Auth::id())
            ->get());

        return view('auth.guestlist.edit-guest', $meals)->with(['guest' => $guest]);
    }

    public function update_guest(Request $request, $id)
    {
        $guest = Guest::find($id);

        $guest->first_name = $request->first_name;
        $guest->last_name = $request->last_name;
        $guest->meal_type_id = $request->meal_type_id;
        $guest->allergy = $request->allergy;
        $guest->plus_one = $request->plus_one;
        $guest->status = $request->status;

        $guest->update(['first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'meal_type_id' => $request->meal_type_id,
            'allergy' => $request->allergy,
            'plus_one' => $request->input('plus_one')=='on' ? 1:0,
            'status' => $request->status]);

        return back()->withMessage('You have successfully edited these details.');
    }

    public function export_guestlist()
    {
        $data = DB::table('guests')
            ->leftJoin('meal_types', 'meal_types.id', '=', 'guests.meal_type_id')
            ->where('guests.soon_to_wed_id', Auth::id())
            ->get();

        $pdf = PDF::loadView('auth.guestlist.export', compact('data'))->setPaper('a4', 'portrait');

        return $pdf->stream(now() . '.pdf');
    }

    public function couple_page()
    {
        $pages = DB::table('couple_pages')
            ->where('soon_to_wed_id', Auth::id())
            ->get();

        return view('auth.couple-page')->with(['pages' => $pages]);
    }

    public function create_couple_page()
    {
        return view('auth.create-page');
    }

    public function save_couple_page(Request $request, $id)
    {
        $profile = User::find($id);

        $couple_page = new CouplePage;
        $couple_page->couple_page = $request->input('couple_page');

        $profile->couple_pages()->save($couple_page);

        return back()->withMessage('Creation successful.');
    }

    public function edit_couple_page($id)
    {
        $page = CouplePage::find($id);

        return view('auth.edit-page')->with(['page' => $page]);
    }

    public function update_couple_page(Request $request, $id)
    {
        $page = CouplePage::find($id);

        $page->couple_page = $request->couple_page;

        $page->update(['couple_page' => $request->couple_page]);
        return back()->withMessage('You have saved changes to your couple page successfully.');
    }

    public function payments()
    {
        $lists = DB::table('payments')
            ->select(['payments.is_full', 'payments.is_installment', 'payments.status', 'payments.payment_type', 'payments.date_paid',
                'payments.amount', 'vendors.first_name', 'vendors.last_name', 'vendors.vendor_type', 'vendors.company_name'])
            ->join('vendors', 'vendors.id', '=', 'payments.vendor_id')
            ->where('payments.soon_to_wed_id', '=', Auth::id())
            ->paginate(15);

        return view('auth.payment.payments')->with(['lists' => $lists]);
    }

    public function add_payment($id)
    {
        $profiles = User::find($id);

        $vendors = array('vendor' => DB::table('soon_to_wed_vendor')
            ->join('vendors', 'vendors.id', '=', 'soon_to_wed_vendor.vendor_id')
            ->where('soon_to_wed_vendor.soon_to_wed_id', Auth::id())
            ->get());

        return view('auth.payment.add', $vendors)->with(['profiles' => $profiles]);
    }

    public function save_payment(Request $request, $id)
    {
        $profiles = User::find($id);

        $profiles->vendor_payments()->attach(Auth::id(), [
            'vendor_id' => $request['vendor_id'],
            'payment_type' => $request['payment_type'],
            'status' => $request['status'],
            'date_paid' => $request['date_paid']
        ]);

        return view('auth.payment.payments')->withMessage('You have successfully added a payment transaction.');
    }

    public function edit_payment($id)
    {
        $payment = Payments::find($id);

        return view('auth.payment.edit')->with(['payment' => $payment]);
    }

    public function update_payment(Request $request, $id)
    {
        $payment = Payments::find($id);

        $payment->payment_type = $request->payment_type;
        $payment->is_installment = $request->input('is_installment')=='on' ? 1:0;
        $payment->is_full = $request->input('is_full')=='on' ? 1:0;
        $payment->amount = $request->amount;
        $payment->status = $request->status;
        $payment->date_paid = $request->date_paid;

        $payment->update(['payment_type' => $request->payment_type,
                                        'is_installment' => $request->input('is_installment')=='on' ? 1:0,
                                        'is_full' => $request->input('is_full')=='on' ? 1:0,
                                        'amount' => $request->amount,
                                        'status' => $request->status,
                                        'date_paid' => $request->date_paid]);

        return view('auth.payment.payments')->withMessage('You have saved changes to your couple page successfully.');
    }

    public function feedback_form($id)
    {
        $profile = Vendor::find($id);

        return view('auth.feedback')->with(['profile' => $profile]);
    }

    public function submit_feedback(Request $request, $id)
    {
        $profile = Vendor::find($id);

        $profile->soon_to_wed_feedbacks()->attach(Auth::id(), [
            'value' => $request['value'],
            'promptness' => $request['promptness'],
            'quality' => $request['quality'],
            'professionalism' => $request['professionalism'],
            'overall' => $request['overall']
        ]);

        return view('auth.feedback')->withMessage('You have successfully submitted your feedback to this vendor.');
    }

    public function paypal()
    {
        return view('auth.paypal');
    }

    public function summary()
    {
        return view('auth.summary');
    }

    /*public function view_feedback()
    {
        $feedbacks = DB::table('feedbacks')
            ->join('vendors', 'vendor.id', '=', 'feedbacks.vendor_id')
            ->get();

        return view('auth.view')->with(['feedbacks' => $feedbacks]);
    }*/
}
