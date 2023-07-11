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
use App\Models\LockedFunds;
use App\Models\Withdrawal;
use App\Models\Reviews;
use App\Models\Savings;
use App\Models\SiteSettings;
use App\Models\User;
use App\Models\UserAccountData;
use App\Models\UserSettings;
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
        $total_users = User::count();
        $count_transactions = Transactions::count();
        $total_transactions = Transactions::sum('amount');
        $total_funded_cards = CardDetails::sum('balance');
        $total_savings = Savings::sum('saved');
        $total_account_balance = UserAccountData::sum('account_balance');
        $total_sent_out = UserAccountData::sum('total_outgoing');
        $total_sent_in = UserAccountData::sum('total_incoming');
        $total_locked_funds = LockedFunds::sum('amount');
        return view('admin.index', compact('page_title', 'user', 'count_transactions', 'total_transactions', 'total_funded_cards', 'total_users', 'users', 'total_savings', 'total_account_balance', 'total_sent_out', 'total_sent_in', 'total_locked_funds'));
    }

    public function members(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Dashboard";
        $mode = 'dark';
        $user = Auth::user();
        $users = User::all();
        
        return view('admin.members', compact('page_title', 'users', 'user'));
    }

    public function creditAccount(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Dashboard";
        $mode = 'dark';
        $user = Auth::user();
        $users = User::all();
        
        return view('admin.credit-account', compact('page_title', 'users', 'user'));
    }

    public function debitAccount(Request $request){
        $page_title = env('SITE_NAME') . " Finance | Dashboard";
        $mode = 'dark';
        $user = Auth::user();
        $users = User::all();
        
        return view('admin.debit-account', compact('page_title', 'users', 'user'));
    }

    public function kycUpgrade(Request $request){
        $page_title = env('SITE_NAME') . " Finance | Dashboard";
        $mode = 'dark';
        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        $users = User::all();
        $user_accounts = UserAccountData::all();
        $user_settings_ = UserSettings::all();
        
        return view('admin.kyc-upgrade', compact('page_title', 'users', 'user', 'user_account', 'user_accounts', 'user_settings_'));
    }

    public function creditAccountAction(Request $request){
        $credit = UserAccountData::where('user_id', $request->user_id)->increment('account_balance', $request->amount);

        return response()->json(
            [
                'success' => ['message' => ["User has been funded £$request->amount!"]]
            ], 201
        );
    }

    public function upgradeKycAction(Request $request){
        $upgrade = UserAccountData::where('user_id', $request->id)->update(['kyc_level' => $request->kyc_level]);
        UserSettings::where('user_id', $request->id)->update(['current_kyc_level' => $request->kyc_level]);

        if($upgrade) {
            // send email
        }
        return response()->json(
            [
                'success' => ['message' => ["User has been upgraded to  $request->kyc_level!!"]]
            ], 201
        );
    }

    public function debitAccountAction(Request $request){
        $credit = UserAccountData::where('user_id', $request->user_id)->decrement('account_balance', $request->amount);

        return response()->json(
            [
                'success' => ['message' => ["User has been debited £$request->amount!"]]
            ], 201
        );
    }

    public function toggleSuspend(Request $request) {
        $user = User::where('id', $request->id)->first();

        if($user->suspended) {
            User::where('id', $request->id)->update(['suspended' => 0]);

            return response()->json(
                [
                    'success' => ['message' => ['User unsuspended.']]
                ], 201
            );
        } else {
            User::where('id', $request->id)->update(['suspended' => 1]);

            return response()->json(
                [
                    'success' => ['message' => ['User suspended.']]
                ], 201
            );
        }
    }

    public function toggleBlock(Request $request) {
        $user = User::where('id', $request->id)->first();

        if($user->blocked) {
            User::where('id', $request->id)->update(['blocked' => 0]);

            return response()->json(
                [
                    'success' => ['message' => ['User unblocked.']]
                ], 201
            );
        } else {
            User::where('id', $request->id)->update(['blocked' => 1]);

            return response()->json(
                [
                    'success' => ['message' => ['User blocked.']]
                ], 201
            );
        }
    }

    public function deleteUser(Request $request) {
        User::where('id', $request->id)->forceDelete();

            return response()->json(
                [
                    'success' => ['message' => ['User Deleted.']]
                ], 201
            );
    }

    public function editTransactions(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Transactions";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        $transactions = Transactions::orderBy('created_at', 'desc')->get();
        $new_transaction_arr = array();
        $dates = array();
        foreach($transactions as $key => $item) {
            $new_transaction_arr[$item->created_at->format('d/m/Y')][$key] = $item;
            $dates[$item->created_at->format('d/m/Y')] = $item->created_at;
        }
        // ksort($new_transaction_arr, SORT_NUMERIC);
        $transaction_count = Transactions::count();
        return view('admin.edit-transaction', compact('page_title', 'mode', 'user', 'transactions', 'transaction_count', 'new_transaction_arr', 'dates', 'user_account'));
    }

    public function deleteTransactions($id){
        $page_title = env('SITE_NAME') . "  Transactions";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $transaction = Transactions::where('id',  $id)->first();
        if(!$transaction) {
            return redirect('/admin/edit/transactions');
        }
        $sender_setings = UserSettings::where('user_id', $transaction->user_id)->first();
        $beneficiary_setings = UserSettings::where('user_id', $transaction->beneficiary_id)->first();
        if(!$beneficiary_setings) {
            $beneficiary_setings = $sender_setings;
        }

        
        return view('admin.delete-transaction', compact('page_title', 'mode', 'user', 'transaction', 'sender_setings', 'beneficiary_setings'));

    }

    public function editCards(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Transactions";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        $cards = CardDetails::orderBy('created_at', 'desc')->get();
        
        
        
        return view('admin.edit-card', compact('page_title', 'user', 'cards',  'user_account'));
    }
}

