<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Transactions;
use App\Models\Deposit;
use App\Models\MainWallet;
use App\Models\ParentInvestmentPlan;
use App\Models\ChildInvestmentPlan;
use App\Models\AccountFundingRequest;
use App\Models\CardDetails;
use App\Models\Withdrawal;
use App\Models\Reviews;
use App\Models\Savings;
use App\Models\SiteSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller {
    public function __construct() {
        //  $this->middleware('maintainance');
        // SiteSettings::where('id', 1)->increment('visit_count', 1);
        $this->middleware('login');
         $this->middleware('admin');
    }
    public function index(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Dashboard";
        $mode = 'dark';
        $user = Auth::user();
        $users = User::all();
        $pending_deposits = Savings::count();
        $running_investments =  CardDetails::count();
        $total_users = User::count();
        $total_deposited = Transactions::sum('amount');
        return view('admin.index', compact('page_title', 'mode', 'user', 'pending_deposits', 'running_investments', 'total_deposited', 'total_users', 'users'));
    }
    public function referralBonus(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Manage Referral Bonus";
        $mode = 'dark';
        $user = Auth::user();
        $users = User::all();
        return view('admin.referral-bonus', compact('page_title', 'mode', 'user', 'users'));
    }
    public function walletBalance(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Manage Wallet Balance";
        $mode = 'dark';
        $user = Auth::user();
        $users = User::all();
        return view('admin.wallet-balance', compact('page_title', 'mode', 'user','users'));
    }

    public function currentInvested(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Manage Current Invested";
        $mode = 'dark';
        $user = Auth::user();
        $users = User::all();
        return view('admin.current-invested', compact('page_title', 'mode', 'user', 'users'));
    }

    public function confirmCredit(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Confirm Credit";
        $mode = 'dark';
        $user = Auth::user();
        $funds = AccountFundingRequest::where([
            'type' => 'deposit_balance',
            'action' => 'credit',
            'approved_at' => null,
            'denied_at' => null
        ])->get();
        return view('admin.confirm-credit', compact('page_title', 'mode', 'user', 'funds'));
    }
    public function confirmCiCredit(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Confirm Current Invested Credit";
        $mode = 'dark';
        $user = Auth::user();
        $funds = AccountFundingRequest::where([
            'type' => 'currently_invested',
            'action' => 'credit'    
        ])->get();
        return view('admin.confirm-ci-credit', compact('page_title', 'mode', 'user', 'funds'));
    }

    public function confirmDebit(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Confirm Debit";
        $mode = 'dark';
        $user = Auth::user();
        $funds = AccountFundingRequest::where([
            'type' => 'deposit_balance',
            'action' => 'debit'    
        ])->get();
        return view('admin.confirm-debit', compact('page_title', 'mode', 'user', 'funds'));
    }
    public function confirmCiDebit(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Confirm Current Invested Debit";
        $mode = 'dark';
        $user = Auth::user();
        $funds = AccountFundingRequest::where([
            'type' => 'currently_invested',
            'action' => 'debit'    
        ])->get();
        return view('admin.confirm-ci-debit', compact('page_title', 'mode', 'user', 'funds'));
    }

    public function childPlan(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Child Plans";
        $mode = 'dark';
        $user = Auth::user();
        $parent_plans = ParentInvestmentPlan::all();
        $child_plans = ChildInvestmentPlan::all();
        return view('admin.child-plan', compact('page_title', 'mode', 'user', 'parent_plans', 'child_plans'));
    }
    public function parentPlan(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Parent Plans";
        $mode = 'dark';
        $user = Auth::user();
        $plans = ParentInvestmentPlan::all();
        return view('admin.parent-plan', compact('page_title', 'mode', 'user', 'plans'));
    }
    public function files(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Files";
        $mode = 'dark';
        $user = Auth::user();
        return view('admin.files', compact('page_title', 'mode', 'user'));
    }
    public function faqs(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Faqs";
        $mode = 'dark';
        $user = Auth::user();
        $faqs = Faq::all();
        return view('admin.faqs', compact('page_title', 'mode', 'user', 'faqs'));
    }
    public function reviews(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Manage Reviews";
        $mode = 'dark';
        $user = Auth::user();
        $reviews = Reviews::all();
        $plans = ChildInvestmentPlan::all();
        return view('admin.reviews', compact('page_title', 'mode', 'user', 'reviews', 'plans'));
    }
    public function wallets(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Wallets";
        $mode = 'dark';
        $user = Auth::user();
        $wallets = MainWallet::all();
        return view('admin.wallets', compact('page_title', 'mode', 'user', 'wallets'));
    }

    public function terms(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Terms";
        $mode = 'dark';
        $user = Auth::user();
        $settings = SiteSettings::latest()->pluck('terms_and_conditions');
        $terms_and_conditions = $settings[0];
        return view('admin.terms', compact('page_title', 'mode', 'user', 'terms_and_conditions'));
    }
    public function about(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | About";
        $mode = 'dark';
        $user = Auth::user();
        $settings = SiteSettings::latest()->pluck('site_about_us');
        $site_about_us = $settings[0];
        return view('admin.about', compact('page_title', 'mode', 'user', 'site_about_us'));
    }
    public function privacyPolicy(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        $settings = SiteSettings::latest()->pluck('privacy_and_policy');
        $privacy_and_policy = $settings[0];
        return view('admin.privacy-policy', compact('page_title', 'mode', 'user', 'privacy_and_policy'));
    }
    public function meetOurTraders(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        $settings = SiteSettings::latest()->pluck('meet_our_traders');
        $meet_our_traders = $settings[0];
        return view('admin.meet-our-traders', compact('page_title', 'mode', 'user', 'meet_our_traders'));
    }
    public function howItWorks(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        $settings = SiteSettings::latest()->pluck('how_it_works');
        $how_it_works = $settings[0];
        return view('admin.how-it-works', compact('page_title', 'mode', 'user', 'how_it_works'));
    }
    public function quickWithdrawal(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        return view('admin.quickwithdrawal', compact('page_title', 'mode', 'user'));
    }
    public function members(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Members";
        $mode = 'dark';
        $user = Auth::user();
        $users = User::where('suspended', '0')->get();
        return view('admin.members', compact('page_title', 'mode', 'user', 'users'));
    }
    public function suspendedMembers(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        $users = User::where('suspended', '1')->get();
        return view('admin.suspended-members', compact('page_title', 'mode', 'user', 'users'));
    }
    public function deniedDeposits(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        $deposits = Deposit::where('status', 'denied')->get();
        return view('admin.denied-deposits', compact('page_title', 'mode', 'user', 'deposits'));
    }
    public function approvedDeposits(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        $deposits = Deposit::where('status', 'accepted')->get();
        return view('admin.approved-deposits', compact('page_title', 'mode', 'user', 'deposits'));
    }
    public function pendingDeposits(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        $deposits = Deposit::where('status', 'pending')->get();
        return view('admin.pending-deposits', compact('page_title', 'mode', 'user', 'deposits'));
    }

    public function deniedWithdrawals(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        $withdrawals = Withdrawal::where('status', 'denied')->get();
        return view('admin.denied-withdrawals', compact('page_title', 'mode', 'user', 'withdrawals'));
    }
    public function approvedWithdrawals(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        $withdrawals = Withdrawal::where('status', 'accepted')->get();
        return view('admin.approved-withdrawals', compact('page_title', 'mode', 'user', 'withdrawals'));
    }
    public function pendingWithdrawals(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        $withdrawals = Withdrawal::where('status', 'pending')->get();
        return view('admin.pending-withdrawals', compact('page_title', 'mode', 'user', 'withdrawals'));
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }
    
    
     public function deleteUser(Request $request) {
        $delete_user = User::where('id', $request->id)->delete();

        if($delete_user) {
            return response()->json(
                [
                'success'=> ['message' => ["User deleted successfully"]]
                ], 201
            );
        }

        return response()->json(
            [
            'error'=> ['message' => ["Error deleting the user"]]
            ], 401
        );
    }

    public function ToggleSuspendUser(Request $request) {
        $user = User::where('id', $request->id)->select(['suspended'])->first();

        if($user->suspended) {
            $unsuspend_user = User::where('id', $request->id)->update([
                'suspended' => '0'
            ]);

            if($unsuspend_user) {
                return response()->json(
                    [
                    'success'=> ['message' => ["User unsuspended successfully"]]
                    ], 201
                );
            }
    
            return response()->json(
                [
                'error'=> ['message' => ["Error unsuspending the user"]]
                ], 401
            );
        } else {
            $suspend_user = User::where('id', $request->id)->update([
                'suspended' => '1'
            ]);

            if($suspend_user) {
                return response()->json(
                    [
                    'success'=> ['message' => ["User suspended successfully"]]
                    ], 201
                );
            }
    
            return response()->json(
                [
                'error'=> ['message' => ["Error suspending the user"]]
                ], 401
            );
        }
    }

    public function viewUser(Request $request) {

        $user = User::where('id', $request->id)->first();

        if(!$user) {
            return response()->json(
                [
                'error'=> ['message' => ["Unknown user account"]]
                ], 401
            );
        }

        $user->browsing_as = $request->id;

        $admin_access = Auth::login($user);
        return response()->json(
            [
            'success'=> ['message' => ["Session updated"]]
            ], 201
        );
    }
    
    public function ToggleAdmin(Request $request) {
        $user = User::where('id', $request->id)->select(['is_admin'])->first();

        if($user->is_admin == '0') {
            $make_user_admin = User::where('id', $request->id)->update([
                'is_admin' => '1'
            ]);

            if($make_user_admin) {
                return response()->json(
                    [
                    'success'=> ['message' => ["User has been upgraded to an Admin"]]
                    ], 201
                );
            }
    
            return response()->json(
                [
                'error'=> ['message' => ["Error making user an admin"]]
                ], 401
            );
        } else {
            $remove_user_admin = User::where('id', $request->id)->update([
                'is_admin' => '0'
            ]);

            if($remove_user_admin) {
                return response()->json(
                    [
                    'success'=> ['message' => ["User has been downgraded to a normal clients"]]
                    ], 201
                );
            }
    
            return response()->json(
                [
                'error'=> ['message' => ["Error removing user as a Admin"]]
                ], 401
            );
        }
    }
    
    public function ToggleUserMod(Request $request) {
        $user = User::where('id', $request->id)->select(['permission'])->first();

        if($user->permission == '1') {
            $make_user_moderator = User::where('id', $request->id)->update([
                'permission' => '2'
            ]);

            if($make_user_moderator) {
                return response()->json(
                    [
                    'success'=> ['message' => ["User has been upgraded to a Moderator"]]
                    ], 201
                );
            }
    
            return response()->json(
                [
                'error'=> ['message' => ["Error making user a moderator"]]
                ], 401
            );
        } else {
            $remove_user_moderator = User::where('id', $request->id)->update([
                'permission' => '1'
            ]);

            if($remove_user_moderator) {
                return response()->json(
                    [
                    'success'=> ['message' => ["User has been downgraded to a normal clients"]]
                    ], 201
                );
            }
    
            return response()->json(
                [
                'error'=> ['message' => ["Error removing user as a moderator"]]
                ], 401
            );
        }
    }
}