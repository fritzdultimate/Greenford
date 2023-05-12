<?php

namespace App\Http\Controllers;

use App\Models\SiteSettings;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller {
    public function storeSocialHandles(Request $request) {
        $settings = SiteSettings::first();

        if(!$settings) {
            SiteSettings::insert([
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'telegram' => $request->telegram,
                'medium' => $request->medium
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Social handles inserted']]
                ], 201
            );
        } else {
            SiteSettings::where('id', 1)->update([
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'telegram' => $request->telegram,
                'medium' => $request->medium
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Social handles updated']]
                ], 201
            );
        }
    }

    public function storeAboutUs(Request $request) {
        $settings = SiteSettings::first();

        if(!$settings) {
            SiteSettings::insert([
                'site_about_us' => $request->about_us,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['About us inserted']]
                ], 201
            );
        } else {
            SiteSettings::where('id', 1)->update([
                'site_about_us' => $request->about_us,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['About us updated']]
                ], 201
            );
        }
    }

    public function storeTermsAndConditions(Request $request) {
        $settings = SiteSettings::first();

        if(!$settings) {
            SiteSettings::insert([
                'terms_and_conditions' => $request->terms_and_conditions,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Terms and conditions inserted']]
                ], 201
            );
        } else {
            SiteSettings::where('id', 1)->update([
                'terms_and_conditions' => $request->terms_and_conditions,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Terms and conditions updated']]
                ], 201
            );
        }
    }

    public function storePrivacyAndPolicy(Request $request) {
        $settings = SiteSettings::first();

        if(!$settings) {
            SiteSettings::insert([
                'privacy_and_policy' => $request->privacy_and_policy,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Privacy and policy inserted']]
                ], 201
            );
        } else {
            SiteSettings::where('id', 1)->update([
                'privacy_and_policy' => $request->privacy_and_policy,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Privacy and policy updated']]
                ], 201
            );
        }
    }

    public function storeHowItWorks(Request $request) {
        $settings = SiteSettings::first();

        if(!$settings) {
            SiteSettings::insert([
                'how_it_works' => $request->how_it_works,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['How it works inserted']]
                ], 201
            );
        } else {
            SiteSettings::where('id', 1)->update([
                'how_it_works' => $request->how_it_works,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['How it works updated']]
                ], 201
            );
        }
    }

    public function storeMeetOurTraders(Request $request) {
        $settings = SiteSettings::first();

        if(!$settings) {
            SiteSettings::insert([
                'meet_our_traders' => $request->meet_our_traders,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Meet our traders inserted']]
                ], 201
            );
        } else {
            SiteSettings::where('id', 1)->update([
                'meet_our_traders' => $request->meet_our_traders,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Meet our traders updated']]
                ], 201
            );
        }
    }

    public function storeDetails(Request $request) {
        $settings = SiteSettings::first();

        if(!$settings) {
            SiteSettings::insert([
                'whatsapp_number' => $request->whatsapp_number,
                'site_address' => $request->site_address,
                'site_name' => $request->site_name,
                'site_logo_url' => $request->site_logo_url,
                'site_email' => $request->site_email,
                // 'site_logo_url' => $request->site_logo_url,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Site details inserted']]
                ], 201
            );
        } else {
            SiteSettings::where('id', 1)->update([
                'whatsapp_number' => $request->whatsapp_number,
                'site_address' => $request->site_address,
                'site_name' => $request->site_name,
                'site_logo_url' => $request->site_logo_url,
                'site_email' => $request->site_email,
                // 'site_logo_url' => $request->site_logo_url,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Site details updated']]
                ], 201
            );
        }
    }

    public function enableSocialHandles(Request $request) {
        $settings = SiteSettings::first();

        if(!$settings) {
            SiteSettings::insert([
                'social_handles_active' => $request->social_handles_active,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Social handle status updated']]
                ], 201
            );
        } else {
            SiteSettings::where('id', 1)->update([
                'social_handles_active' => $request->social_handles_active,
            ]);

            return response()->json(
                [
                    'success' => ['message' => ['Social handle status updated']]
                ], 201
            );
        }
    }
}
