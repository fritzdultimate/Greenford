<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserWalletRequest;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWalletController extends Controller {
    public function store(StoreUserWalletRequest $request, UserWallet $userWallet) {
        $request->validated();
        
        $check_for_match = UserWallet::where(['user_id' => Auth::id(), 'main_wallet_id' => $request->main_wallet_id])->first();
        
        if($check_for_match) {
            return response()->json(
            [
            'errors' => [
                'message' => ["The choosen wallet already exists"],
                ]
            ], 403
        );
        }

        $userWallet->currency_address = $request->currency_address;
        $userWallet->main_wallet_id = $request->main_wallet_id;
        $userWallet->user_id = Auth::id();
        if(!empty($request->has_memo)) {
            $userWallet->has_memo = $request->has_memo;
            $userWallet->memo_token = $request->memo_token;
        }
        $store_userWallet = $userWallet->save();

        $last_id = UserWallet::latest()->first();

        if($store_userWallet) {
            return response()->json(
                [
                'success' => [
                    'message' => ["Your wallet was created successfully"],
                    'id' => $last_id->id
                    ]
                ], 201
            );
        }

        return response()->json(
            [
            'errors' => [
                'message' => ["Error creating the wallet"],
                'id' => $last_id->id
                ]
            ], 403
        );
    }

    public function update(Request $request, UserWallet $userWallet) {

        $update_userWallet = $userWallet->where('id', $request->id)->update([
            'memo_token' => $request->memo_token,
            'currency_address' => $request->currency_address,
            'has_memo' => $request->has_memo ? 1 : 0
        ]);

        if($update_userWallet) {
            return response()->json(
                [
                'success' => ['message' => ["Your wallet was updated successfully"]]
                ], 201
            );
        }

        return response()->json(
            [
            'errors' => ['message' => ["Wallet not updated"]]
            ], 403
        );
        
    }
}
