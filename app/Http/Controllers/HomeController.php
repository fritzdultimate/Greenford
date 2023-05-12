<?php

namespace App\Http\Controllers;

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
use App\Models\Properties;
use App\Models\UserDoc;
use Illuminate\Http\Request;
use App\Models\SiteSettings;
use App\Models\UserAccountData;
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

    public function dashboard(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Dashboard";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $transactions = Transactions::where('user_id', $user['id'])->latest(5);
        $user_account = UserAccountData::where('user_id', Auth::id())->first();
        return view('user.index', compact('page_title', 'mode', 'user', 'transactions', 'user_account'));
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

    public function wallets(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Deposit History";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $user_wallets = UserWallet::where('user_id', Auth::id())->get();
        $user_owned_wallet_ids = [];
        foreach($user_wallets as $wallet) {
            array_push($user_owned_wallet_ids, $wallet->main_wallet_id);
        }
        $main_wallets = MainWallet::whereNotIn('id', $user_owned_wallet_ids)->get();
        return view('user.wallets', compact('page_title', 'mode', 'user', 'main_wallets', 'user_wallets'));
    }

    public function reinvest(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Reinvest";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $plans = ChildInvestmentPlan::all();
        $wallets = UserWallet::where('user_id', $user['id'])->get();
        return view('user.reinvest', compact('page_title', 'mode', 'user', 'plans', 'wallets'));
    }

    public function reinvestments(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Reinvestment History";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $reinvestments = Deposit::where([
            ['reinvestment', '=', 1],
            ['user_id', '=', $user['id']]
        ])->get();
        return view('user.reinvestments', compact('page_title', 'mode', 'user', 'reinvestments'));
    }

    public function withdrawal(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Withdrawal";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $wallets = UserWallet::where('user_id', $user['id'])->get();
        return view('user.withdrawal', compact('page_title', 'mode', 'user', 'wallets'));
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
        $transactions = Transactions::where('user_id', $user['id'])->orderBy('id', 'DESC')->get();
        return view('user.transactions', compact('page_title', 'mode', 'user', 'transactions'));
    }

    public function referrals(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Referrals";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        $referrals = User::where('referrer', $user['name'])->get();
        return view('user.referrals', compact('page_title', 'mode', 'user', 'referrals'));
    }

    public function security(Request $request){
        $page_title = env('SITE_NAME') . " Investment Website | Dashboard";
        $mode = 'dark';
        $user = Auth::user();
        if($user->browsing_as){
            $user = User::find($user->browsing_as);
        }
        return view('user.security', compact('page_title', 'mode', 'user'));
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