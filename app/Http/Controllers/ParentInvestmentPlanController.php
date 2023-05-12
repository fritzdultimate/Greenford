<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParentInvestmentPlan;
use App\Models\ChildInvestmentPlan;
use App\Models\ParentInvestmentPlan;
use Illuminate\Http\Request;

class ParentInvestmentPlanController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParentInvestmentPlan $request, ParentInvestmentPlan $plan) {
        $plan->name = $request->name;
        $store_plan = $plan->save();
        $last_id = ParentInvestmentPlan::latest()->first();
        if($store_plan) {
            return response()->json(
                [
                'success' => [
                    'message' => ["Parent investment plan created successfully"],
                    'id' => $last_id->id
                    ]
                ], 201
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParentInvestmentPlan  $parentInvestmentPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentInvestmentPlan $plan) {
        $plan->where('id', $request->id)->update(['name' => $request->name]);

        return response()->json([
            'success' => [
                ['Parent investment plan updated successfully']
            ]
        ]);
    }

    public function getPlans(Request $request, ParentInvestmentPlan $parentPlans) {
        return $parentPlans->get();
    }

    public function showPlan(ParentInvestmentPlan $parentPlans, $id = null) {
        return $parentPlans->where('id', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParentInvestmentPlan  $parentInvestmentPlan
     * @return \Illuminate\Http\Response
     */
    //  , ParentInvestmentPlan $parentInvestmentPlan
    public function destroy(Request $request, ParentInvestmentPlan $parentInvestmentPlan) {
        $parentInvestmentPlan::where('id', $request->id)->delete();
        return response()->json(
                [
                'success' => [
                    'message' => ["Parent investment plan deleted successfully"]
                    ]
                ], 201
            );
    }
}
