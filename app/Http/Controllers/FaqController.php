<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $insert_faqs = Faq::insert([
            'question' => $request->question,
            'answer' => $request->answer,
            'priority' => $request->priority
        ]);

        if($insert_faqs) {
            $last_id = Faq::latest()->first();
            return response()->json(
                [
                    'success' => ['message' => ['Frequently asked question created'],'id' => $last_id->id]
                ], 201
            );
        }

        return response()->json(
            [
                'errors' => ['message' => ['error creating requently asked question']]
            ], 403
        );
    }

    public function update(Request $request) {
        $update_faqs = Faq::where('id', $request->id)->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'priority' => $request->priority
        ]);

        if($update_faqs) {
            return response()->json(
                [
                    'success' => ['message' => ['Frequently asked question updated']]
                ], 201
            );
        }

        return response()->json(
            [
                'errors' => ['message' => ['error updating requently asked question']]
            ], 403
        );
    }

}
