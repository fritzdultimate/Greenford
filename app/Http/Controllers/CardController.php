<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCardRequest;
use Illuminate\Support\Facades\Mail;

class CardController extends Controller {
    /**
     * store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AddCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function addCard(AddCardRequest $addCardRequest) {

        $validated = $addCardRequest->validated();
        if(strlen((string)$validated['pin']) != 4) {
            return response()->json(
                [
                    'errors' => ['message' => ['Pin must be 4 digits number']]
                ], 401
            );
        }
        return response()->json(
            [
                'success' => ['message' => ['Fund locked successfully']]
            ], 201
        );

    }

}
