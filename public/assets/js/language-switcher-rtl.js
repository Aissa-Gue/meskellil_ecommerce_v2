$(document).ready(function() {
    // Get saved language from localStorage or default to current locale
    var savedLocale = localStorage.getItem('preferred_language');
    var currentLocale = savedLocale || $('html').attr('lang') || 'en';
    
    // Apply saved language if different from current
    if (savedLocale && savedLocale !== $('html').attr('lang')) {
        switchLanguage(savedLocale, false); // Don't reload on initial load
    }
    
    if (currentLocale === 'ar') {
        document.documentElement.setAttribute("dir", 'rtl');
        $("[href*='bootstrap.css']:not([href*='bootstrap-rtl.css'])").attr("href", function(i, href) {
            return href.replace('bootstrap.css', 'bootstrap-rtl.css');
        });
    }
    
    // Language switching function
    function switchLanguage(locale, reload = true) {
        var langText = $(`.tp-header-lang-list li[data-lang="${locale}"], .tp-lang-list li[data-lang="${locale}"]`).text();
        
        // Store language preference in localStorage
        localStorage.setItem('preferred_language', locale);
        
        // Handle RTL for Arabic
        if (locale === 'ar') {
            document.documentElement.setAttribute("dir", 'rtl');
            $("[href*='bootstrap.css']:not([href*='bootstrap-rtl.css'])").attr("href", function(i, href) {
                return href.replace('bootstrap.css', 'bootstrap-rtl.css');
            });
        } else {
            document.documentElement.setAttribute("dir", 'ltr');
            $("[href*='bootstrap-rtl.css']").attr("href", function(i, href) {
                return href.replace('bootstrap-rtl.css', 'bootstrap.css');
            });
        }
        
        // Update toggle text if found
        if (langText) {
            $('.tp-header-lang-toggle, .tp-lang-toggle').text(langText);
        }
        
        // Submit language change to server
        if (reload) {
            $.post('/language/switch', {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'locale': locale
            }).done(function() {
                location.reload();
            }).fail(function() {
                // If server request fails, still reload to apply client-side changes
                location.reload();
            });
        }
    }
    
    // Language selection handler
    $(document).on('click', '.tp-header-lang-list li[data-lang], .tp-lang-list li[data-lang]', function(e) {
        e.preventDefault();
        
        var locale = $(this).attr('data-lang');
        switchLanguage(locale, true);
    });
    
    // Function to get current language from localStorage
    window.getCurrentLanguage = function() {
        return localStorage.getItem('preferred_language') || 'en';
    };
    
    // Function to set language programmatically
    window.setLanguage = function(locale) {
        switchLanguage(locale, true);
    };
});
