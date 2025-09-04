<?php

namespace App\Helpers;

class LocaleHelper
{
    /**
     * Get available locales with fallback
     *
     * @return array
     */
    public static function getAvailableLocales()
    {
        return config('app.available_locales', [
            'en' => 'English',
            'fr' => 'French', 
            'ar' => 'العربية'
        ]);
    }

    /**
     * Get current locale display name
     *
     * @return string
     */
    public static function getCurrentLocaleName()
    {
        $currentLocale = app()->getLocale();
        $availableLocales = self::getAvailableLocales();
        
        return $availableLocales[$currentLocale] ?? 'English';
    }
}
