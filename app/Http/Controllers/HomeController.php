<?php

namespace App\Http\Controllers;

use App\Models\CardDetails;
use App\Models\Faq;
use App\Models\Transactions;
use App\Models\ChildInvestmentPlan;
use App\Models\ParentInvestmentPlan;
use App\Models\MainWallet;
use App\Models\UserWallet;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Reviews;
use App\Models\User;
use App\Models\FakeWithdrawal;
use App\Models\LockedFunds;
use App\Models\Notification;
use App\Models\Properties;
use App\Models\Savings;
use App\Models\UserDoc;
use Illuminate\Http\Request;
use App\Models\SiteSettings;
use App\Models\UserAccountData;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller {
    public function __construct() {
        //  $this->middleware('maintainance', ['except' => ['maintainance', 'login']]);
        $this->middleware('login', ['except' => ['index', 'support', 'login', 'register', 'faqs', 'terms', 'meetOurTraders', 'impression', 'privacyPolicy', 'aboutUs', 'forgotPass', 'propertyView', 'verifyToken', 'contact', 'maintainance', 'submitProperty']]);
    }
    
    public function maintainance(Request $request){
        $page_title = "Namecheap Maintenance";
        return view('visitor.maintenance');
    }
    
    public function index(Request $request){
        $page_title = env('SITE_NAME') . " - Home";
        return view('visitor.index', compact('page_title'));
    }

    public function dashboard(Request $request, UserSettings $userSettings){
        
        
        $page_title = env('SITE_NAME') . " Banking Website | Dashboard";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $user_settings = $userSettings->where('user_id', $user->id)->first();
        if(!$user_settings) {
            $userSettings::insert(['user_id' => $user->id, 'created_at' => date('Y-m-d H:i:s'), 'pin' => 1111]);
        }
        $transactions = Transactions::where('user_id', $user['id'])->orWhere('beneficiary_id', $user['id'])->orderBy('id', 'desc')->take(5)->get();
        $savings = Savings::where('user_id', $user->id)->get();
        $user_account = UserAccountData::where('user_id', Auth::id())->first();
        $total_locked_fund = LockedFunds::where('user_id', $user->id)->sum('amount');
        $total_savings = Savings::where('user_id', $user->id)->sum('saved');
        $total_card_balance = CardDetails::where('user_id', $user->id)->sum('balance');
        $cards = CardDetails::where('user_id', $user->id)->orderBy('id', 'desc')->get();

        return view('user.index', compact('page_title', 'mode', 'user', 'transactions', 'user_account', 'savings', 'total_locked_fund', 'total_savings', 'cards', 'total_card_balance'));
    }
    public function deposit(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Deposit";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $plans = ChildInvestmentPlan::all();
        $wallets = UserWallet::where('user_id', $user['id'])->get();
        return view('user.deposit', compact('page_title', 'mode', 'user', 'plans', 'wallets'));
    }
    
    public function impression(Request $request){
        $page_title = env('SITE_NAME') . " Impression ";
        return view('visitor.impression', compact('page_title'));
    }
    
    public function ids(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | User Docs";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $ids = UserDoc::all();
        return view('admin.ids', compact('page_title', 'mode', 'user', 'ids'));
    }
    public function deposits(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Deposit History";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $deposits = Deposit::where('user_id', $user['id'])->get();
        return view('user.deposits', compact('page_title', 'mode', 'user', 'deposits'));
    }

    public function cards(Request $request){
        $page_title = env('SITE_NAME') . " Cards";

        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        
        $cards = CardDetails::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('user.cards-view', compact('page_title', 'cards', 'user', 'user_account'));
    }

    public function withdrawals(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Withdrawal History";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $withdrawals = Withdrawal::where('user_id', $user['id'])->get();
        return view('user.withdrawals', compact('page_title', 'mode', 'user', 'withdrawals'));
    }

    public function transactions(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Transactions";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        $transactions = Transactions::where('user_id', $user['id'])->orWhere('beneficiary_id', $user['id'])->orderBy('created_at', 'desc')->get();
        $new_transaction_arr = array();
        $dates = array();
        foreach($transactions as $key => $item) {
            $new_transaction_arr[$item->created_at->format('d/m/Y')][$key] = $item;
            $dates[$item->created_at->format('d/m/Y')] = $item->created_at;
        }
        // ksort($new_transaction_arr, SORT_NUMERIC);
        $transaction_count = Transactions::where('user_id', $user['id'])->orWhere('beneficiary_id', $user['id'])->count();
        return view('user.transactions-view', compact('page_title', 'mode', 'user', 'transactions', 'transaction_count', 'new_transaction_arr', 'dates', 'user_account'));
    }

    public function transactionsItem($id) {
        $page_title = env('SITE_NAME') . " Transaction Details";
        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        $transaction = Transactions::where('transaction_id', $id)->first();
        return view('user.transaction-item', compact('transaction', 'page_title', 'user_account', 'user'));
    }

    public function savings(Request $request){
        $page_title = env('SITE_NAME') . " Savings";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        $savings = Savings::where('user_id', $user->id)->get();
        return view('user.savings_view', compact('page_title', 'mode', 'user', 'savings', 'user_account'));
    }

    public function security(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Dashboard";
        $mode = 'dark';
        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        return view('user.security', compact('page_title', 'mode', 'user'));
    }

    public function settings(Request $request, UserSettings $userSettings){
        $page_title = env('SITE_NAME') . " Settings";
        $mode = 'dark';
        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }

        $faqs = Faq::get();
        $user_settings = $userSettings->where('user_id', $user->id)->first();
        return view('user.settings', compact('page_title', 'mode', 'user', 'user_account', 'user_settings', 'faqs'));
    }

    public function notifications(Request $request, UserSettings $userSettings){
        $page_title = env('SITE_NAME') . " Notification";
        $mode = 'dark';
        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }

        $notifications = Notification::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        Notification::where('user_id', Auth::user()->id)->update(['seen' => true, 'delivered' => true]);

        $user_settings = $userSettings->where('user_id', $user->id)->first();
        echo view('user.notifications', compact('page_title', 'mode', 'user', 'user_account', 'user_settings', 'notifications'));
    }

    public function upgradeAccount(Request $request, UserSettings $userSettings){
        $page_title = env('SITE_NAME') . " Acount Upgrade";
        $mode = 'dark';
        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }

        
        $user_settings = $userSettings->where('user_id', $user->id)->first();
        return view('user.upgrade-kyc', compact('page_title', 'mode', 'user', 'user_account', 'user_settings'));
    }

    public function profile(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Dashboard";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $transactions = Transactions::where('user_id', $user['id'])->get();
        $referrals = User::where('referrer', $user['name'])->get();
        return view('user.profile', compact('page_title', 'mode', 'user', 'transactions', 'referrals'));
    }

    public function login(Request $request){
        
        $page_title = env('SITE_NAME') . " - Login";
        
        return view('visitor.login', compact('page_title'));
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }
    public function register(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        
        return view('visitor.register', compact('page_title'));
    }
    public function referralBonus(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Manage Referral Bonus";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $users = User::all();
        return view('user.referral-bonus', compact('page_title', 'mode', 'user', 'users'));
    }
    public function walletBalance(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Manage Wallet Balance";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $users = User::all();
        return view('user.wallet-balance', compact('page_title', 'mode', 'user','users'));
    }

    public function currentInvested(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Manage Current Invested";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $users = User::all();
        return view('user.current-invested', compact('page_title', 'mode', 'user', 'users'));
    }
    public function aboutUs(Request $request){
        $page_title = env('SITE_NAME') . " - About Us";
        return view('visitor.about-us', compact('page_title'));
    }
    
    public function terms(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Terms And Condition";
        $settings = SiteSettings::latest()->first();
        $terms_and_conditions = $settings['terms_and_conditions'];
        $main_wallets = MainWallet::all();
        return view('visitor.terms', compact('terms_and_conditions', 'page_title', 'settings', 'main_wallets'));
    }
    public function meetOurTraders(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Meet Our Traders";
        $settings = SiteSettings::latest()->first();
        $meet_our_traders = $settings['meet_our_traders'];
        $main_wallets = MainWallet::all();
        return view('visitor.meet-our-traders', compact('meet_our_traders', 'page_title', 'settings', 'main_wallets'));
    }
    public function howItWorks(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Meet Our Traders";
        $settings = SiteSettings::latest()->first();
        $how_it_works = $settings['how_it_works'];
        $main_wallets = MainWallet::all();
        return view('visitor.how-it-works', compact('how_it_works', 'page_title', 'settings', 'main_wallets'));
    }
    public function faqs(Request $request){
        $page_title = env('SITE_NAME') . " - Frequently Asked Questions";
        
        return view('visitor.faq', compact('page_title'));
    }
    
    public function contact(Request $request){
        $page_title = env("SITE_NAME") . " - Contact Us";
        return view('visitor.contact-us', compact('page_title',));
    }
    
    public function support(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Change Password";
        SiteSettings::where('id', 1)->increment('visit_count', 1);
        $settings = SiteSettings::latest()->first();
        return view('visitor.support', compact('page_title', 'settings'));
    }
    
    public function privacyPolicy(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Privacy And Policy";
        $settings = SiteSettings::latest()->first();
        $privacy_and_policy = $settings['privacy_and_policy'];
        $main_wallets = MainWallet::all();
        return view('visitor.privacy-and-policy', compact('privacy_and_policy', 'page_title', 'settings', 'main_wallets'));
    }
    public function ProductAndServices(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Privacy And Policy";
        $settings = SiteSettings::latest()->first();
        $privacy_and_policy = $settings['privacy_and_policy'];
        $main_wallets = MainWallet::all();
        return view('visitor.product-and-services', compact('privacy_and_policy', 'page_title', 'settings', 'main_wallets'));
    }
    public function quickWithdrawal(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        return view('admin.quickwithdrawal', compact('page_title', 'mode', 'user'));
    }
    
    public function quickWithdrawalMod(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website";
        $mode = 'dark';
        $user = Auth::user();
        return view('user.quickwithdrawal', compact('page_title', 'mode', 'user'));
    }
    
    public function forgotPass(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Forgot Password";
        
        return view('visitor.forgotpass', compact('page_title'));
    }
    public function propertyView(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Property Details";
        return view('visitor.property-view', compact('page_title'));
    }
    public function verifyToken(Request $request){
        $page_title = env('SITE_NAME') . "Investment Website | Verify Token";
        SiteSettings::where('id', 1)->increment('visit_count', 1);
        $settings = SiteSettings::latest()->first();
        $main_wallets = MainWallet::all();
        return view('visitor.verify-token', compact('page_title', 'settings', 'main_wallets'));
    }
}