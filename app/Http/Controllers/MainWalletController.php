<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMainWalletRequest;
use App\Models\MainWallet;
use Illuminate\Http\Request;

class MainWalletController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMainWalletRequest $request, MainWallet $mainWallet) {
        $validated = $request->validated();

        $mainWallet->currency = $request->currency;
        $mainWallet->currency_symbol = $request->currency_symbol;
        $mainWallet->currency_address = $request->currency_address;
        if(!empty($request->has_memo)) {
            $mainWallet->has_memo = $request->has_memo;
            $mainWallet->memo_token = $request->memo_token;
        }

        $store_mainWallet = $mainWallet->save();

        $last_id = MainWallet::latest()->first();

        if($store_mainWallet) {
            return response()->json(
                [
                'success' => [
                    'message' => ["Main Wallet created successfully"],
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

    public function update(Request $request, MainWallet $mainWallet) {

        $update_adminWallet = $mainWallet->where('id', $request->id)->update([
            'currency' => $request->currency,
            'currency_symbol' => $request->currency_symbol,
            'memo_token' => $request->memo_token,
            'currency_address' => $request->currency_address,
            'has_memo' => $request->has_memo ? 1 : 0
        ]);

        if($update_adminWallet) {
            return response()->json(
                [
                'success' => ['message' => ["Main Wallet updated successfully"]]
                ], 201
            );
        }

        return response()->json(
            [
            'errors' => ['message' => ["Main Wallet not updated"]]
            ], 403
        );
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainWallet  $mainWallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainWallet $mainWallet, Request $request) {
        $result = MainWallet::where('id', $request->id)->delete();
        if($result){
            return response()->json(
                [
                'success' => ['message' => ["Wallet deleted successfully"]]
                ], 201
            );
        } else {
            return response()->json(
                [
                'errors' => ['message' => ["Something went wrong"]]
                ], 403
            );
        }
    }

    public function delete(Request $request) {
        $wallet = MainWallet::where('id', $request->id)->first();

        if($wallet) {
            $delete_permanently = MainWallet::where('id', $request->id)->delete();

            if($delete_permanently) {
               
                return response()->json(
                    [
                        'success' => ['message' => ['Wallet permanently deleted']]
                    ], 201
                );
            }

            return response()->json(
                [
                    'errors' => ['message' => ['Error deleting wallet']]
                ], 401
            );
        }

        return response()->json(
            [
                'errors' => ['message' => ['Unknown wallet']]
            ], 401
        );
    }

    public function recover(Request $request) {
        $wallet = MainWallet::onlyTrashed()->where('id', $request->id)->first();

        if($wallet) {
            $recover_wallet = MainWallet::where('id', $request->id)->restore();

            if($recover_wallet) {
                return response()->json(
                    [
                        'success' => ['message' => 'Wallet restored']
                    ], 201
                );
            }

            return response()->json(
                [
                    'errors' => ['message' => 'Error restoring wallet']
                ], 401
            );
        }

        return response()->json(
            [
                'error' => ['message' => 'Unknown wallet']
            ], 401
        );
    }

    /**
     * Deactivate the specified resource from storage.
     *
     * @param  \App\Models\MainWallet  $mainWallet
     * @return \Illuminate\Http\Response
     */
    public function deactivate(MainWallet $mainWallet, Request $request) {
        $result = $mainWallet->where('id', $request->id)->update(['active' => 0]);
        if($result){
            return response()->json(
                [
                'success' => ['message' => ["Wallet deactivated successfully"]]
                ], 201
            );
        } else {
            return response()->json(
                [
                'errors' => ['message' => ["Something went wrong"]]
                ], 403
            );
        }
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  \App\Models\MainWallet  $mainWallet
     * @return \Illuminate\Http\Response
     */
    public function activate(MainWallet $mainWallet, Request $request) {
       $result = $mainWallet->where('id', $request->id)->update(['active' => 1]);
        if($result){
            return response()->json(
                [
                'success' => ['message' => ["Wallet activated successfully"]]
                ], 201
            );
        } else {
            return response()->json(
                [
                'errors' => ['message' => ["Something went wrong"]]
                ], 403
            );
        }
    }
}
