<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // $user_id = Auth::id();
        // if(!isset($request->star)) {
        //     $request->star = '5';
        // }

        if(!isset($request->review)) {
            $request->review = 'An empty review';
        }

        // $request->star = $request->star < 1 ? '1' : ($request->star > 5 ? '5' : $request->star); 

        $insert_review = Reviews::insert([
            'user' => $request->user,
            'occupation' => $request->occupation,
            'plan' => $request->plan,
            'active' => $request->active,
            'review' => $request->review,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if($insert_review) {
             $last_id = Reviews::latest()->first();
            return response()->json(
                [
                    'success' => ['message' => ['Your review has been created'], 'id' => $last_id->id]
                ], 201
            );
        }

        return response()->json(
            [
                'errors' => ['message' => ['Error creating review']]
            ], 401
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reviews $reviews) {
        $update_review = Reviews::where('id', $request->id)->update([
            'user' => $request->user,
            'occupation' => $request->occupation,
            'plan' => $request->plan,
            'active' => $request->active,
            'review' => $request->review,
        ]);

        if($update_review) {
            return response()->json(
                [
                    'success' => ['message' => ['review has been updated']]
                ], 201
            );
        }

        return response()->json(
            [
                'errors' => ['message' => ['Error updating your review']]
            ], 401
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Reviews $reviews) {
        $delete_review = Reviews::where('id', $request->id)->delete();

        if($delete_review) {
            return response()->json(
                [
                    'success' => ['message' => ['Your review has been trashed']]
                ], 201
            );
        }

        return response()->json(
            [
                'errors' => ['message' => ['Error deleting your review']]
            ], 401
        );
    }

    public function delete(Request $request) {
        $review = Reviews::onlyTrashed()->where('id', $request->id)->first();

        if($review) {
            $delete_permanently = Reviews::where('id', $request->id)->forceDelete();

            if($delete_permanently) {
                return response()->json(
                    [
                        'success' => ['message' => 'Review permanently deleted']
                    ], 201
                );
            }

            return response()->json(
                [
                    'success' => ['message' => 'Error deleting review']
                ], 401
            );
        }

        return response()->json(
            [
                'success' => ['message' => 'Unknown review']
            ], 201
        );
    }

    public function recover(Request $request) {
        $review = Reviews::onlyTrashed()->where('id', $request->id)->first();

        if($review) {
            $recover_review = Reviews::where('id', $request->id)->restore();

            if($recover_review) {
                return response()->json(
                    [
                        'success' => ['message' => 'Review restored']
                    ], 201
                );
            }

            return response()->json(
                [
                    'success' => ['message' => 'Error restoring review']
                ], 401
            );
        }

        return response()->json(
            [
                'success' => ['message' => 'Unknown review']
            ], 201
        );
    }
}
