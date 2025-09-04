<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale');
        
        $availableLocales = ['en', 'fr', 'ar'];
        
        if (in_array($locale, $availableLocales)) {
            // Store in session
            Session::put('locale', $locale);
            
            // Also store in cookie for persistence across sessions
            $cookie = cookie('locale', $locale, 60 * 24 * 365); // 1 year
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'locale' => $locale,
                    'message' => 'Language switched successfully'
                ])->cookie($cookie);
            }
            
            return Redirect::back()->cookie($cookie);
        }
        
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid locale'
            ], 400);
        }
        
        return Redirect::back();
    }
}
