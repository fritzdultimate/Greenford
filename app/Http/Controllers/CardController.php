<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCardRequest;
use App\Models\CardDetails;
use App\Models\UserAccountData;
use App\Models\UserSettings;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

class CardController extends Controller {
    /**
     * store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AddCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function addCard(AddCardRequest $addCardRequest, CardDetails $cardDetails) {

        $validated = $addCardRequest->validated();
        if(strlen((string)$validated['pin']) != 4) {
            return response()->json(
                [
                    'errors' => ['message' => ['Pin must be 4 digits number']]
                ], 401
            );
        }
        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();

        if(!Schema::hasColumn('user_settings', 'pin')) {
            Schema::table('user_settings', function(Blueprint $table) {
                $table->string('pin');
            });
        }

        $pin = UserSettings::where('user_id', $user->id)->first()['pin'];
        if(!$pin) {
            return response()->json(
                [
                    'errors' => ['message' => ['Please setup your transaction pin!']]
                ], 401
            );
        }

        if($pin !== $addCardRequest->transaction_pin) {
            return response()->json(
                [
                    'errors' => ['message' => ['Wrong pin!']]
                ], 401
            );
        }

        if($validated['amount'] + 2 > $user_account->account_balance) {
            return response()->json(
                [
                    'errors' => ['message' => ['Insufficient fund']]
                ], 401
            );
        }
        $card_number = $validated['type'] == 'visa' ? 4 . rand(100000000000000, 123456789012345) : 5 . rand(100000000000000, 123456789012345);
        $len = strlen($card_number);
        $exp_date = addDaysToDate(date('Y-m-d H:i:s'), 3 * 365);
        $card_id = generateTransactionHash($cardDetails, 'card_id', 5);
        $card_cvv = rand(200, 500);
        // $classes = ['bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark', ''];

        $data = [
            'user_id' => $user->id,
            'balance' => $validated['amount'],
            'exp_date' => $exp_date,
            'card_id' => $card_id,
            'card_number' => $card_number,
            'card_cvv' => $card_cvv,
            'card_pin' => $validated['pin'],
            'card_color' => $validated['type'] == 'master' ? 'bg-secondary' : 'bg-info',
        ];

        $create_card = CardDetails::create($data);
        if($create_card) {
            $user_account->decrement('account_balance', $validated['amount'] + 2);
            // notify locker
            notify("You created a $addCardRequest->type card with $ $addCardRequest->amount valid till " . get_day_name($exp_date), 'Card Created', $user->id);
            // send email
            $details = [
                'subject' => "$addCardRequest->type card was created",
                'card_type' => $addCardRequest->type,
                'card_number' => "**** **** **** " .substr($card_number, -4, 4),
                'exp_date' => get_day_format($exp_date), 
                'funded_amount' => number_format($validated['amount'], 2),
                'date_created' => get_day_format(date("Y-m-d H:i:s")),
                'card_id' => $card_id,
                'sign' => '-',
                'color' => 'red',
                'view' => 'emails.user.cardcreated',
            ];

            $mailer = new \App\Mail\MailSender($details);
            Mail::to($user->email)->send($mailer);

            return response()->json(
                [
                    'success' => ['message' => ["Card create successfully!"]]
                ], 201
            );
        }
        return response()->json(
            [
                'errors' => ['message' => ["Something went wrong, we are fixing it!"]]
            ], 400
        );

    }

    public function deleteCard($cardId, CardDetails $cardDetails) {

        $user = Auth::user();
        $card = $cardDetails->where('card_id', $cardId)->first();
        if($card->user_id != $user->id) {
            return response()->json(
                [
                    'errors' => ['message' => ['You are not authourized to perform this action']]
                ], 401
            );
        }
        if(!$card) {
            return response()->json(
                [
                    'errors' => ['message' => ['Sorry, but action cannot be performed now']]
                ], 401
            );
        }
        $balance = $card->balance;
        $delete_card = $card->forceDelete();

        if($delete_card) {
            UserAccountData::where('user_id', $user->id)->increment('account_balance', $balance);
            return response()->json(
                [
                    'success' => ['message' => ['Card deleted successfully']]
                ], 200
            );

            // send email
        }

        return response()->json(
            [
                'errors' => ['message' => ['Something went wrong, we are working on it!']]
            ], 401
        );
    }

}
