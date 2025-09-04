<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Priority order: Session > Cookie > Default
        $locale = Session::get('locale') 
                 ?? $request->cookie('locale') 
                 ?? config('app.locale');
        
        $availableLocales = config('app.available_locales', [
            'en' => 'English',
            'fr' => 'French', 
            'ar' => 'العربية'
        ]);
        
        if (array_key_exists($locale, $availableLocales)) {
            App::setLocale($locale);
            
            // Store in session if not already there (from cookie)
            if (!Session::has('locale')) {
                Session::put('locale', $locale);
            }
            
            // Set RTL direction for Arabic language
            if ($locale === 'ar') {
                Session::put('tp_dir', 'rtl');
            } else {
                Session::put('tp_dir', 'ltr');
            }
        }
        
        return $next($request);
    }
}
