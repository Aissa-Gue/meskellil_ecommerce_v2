<?php

if (!function_exists('global_info')) {
    /**
     * Get contact information from the config file
     * 
     * @param string|null $key Dot notation key to get specific value (e.g., 'social_media.tiktok.url')
     * @param mixed $default Default value if key is not found
     * @return mixed
     */
    function global_info($key = null, $default = null)
    {
        static $contactData = null;
        
        if ($contactData === null) {
            $configPath = config_path('global-meskellil-info.json');
            
            if (!file_exists($configPath)) {
                return $default;
            }
            
            $contactData = json_decode(file_get_contents($configPath), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $default;
            }
        }
        
        if ($key === null) {
            return $contactData;
        }
        
        return data_get($contactData, $key, $default);
    }
}

if (!function_exists('social_media')) {
    /**
     * Get social media information
     * 
     * @param string|null $platform Platform name (facebook, instagram, tiktok, youtube)
     * @param string|null $property Property to get (url, followers)
     * @return mixed
     */
    function social_media($platform = null, $property = null)
    {
        if ($platform === null) {
            return global_info('social_media');
        }
        
        if ($property === null) {
            return global_info("social_media.{$platform}");
        }
        
        return global_info("social_media.{$platform}.{$property}");
    }
}

if (!function_exists('contact_info')) {
    /**
     * Get contact email
     * 
     * @return string|null
     */
    function contact_info()
    {
        return global_info('contact');
    }
}

if (!function_exists('brand_info')) {
    /**
     * Get brand information
     * 
     * @param string|null $key Specific brand property (name, slug, images.svg, etc.)
     * @return mixed
     */
    function brand_info($key = null)
    {
        if ($key === null) {
            return global_info('brand');
        }
        
        return global_info("brand.{$key}");
    }
}

if (!function_exists('address_info')) {
    /**
     * Get address information
     * 
     * @param string|null $location 'main', 'location_1', 'location_2'
     * @param string|null $property 'address' or 'maps_url'
     * @return mixed
     */
    function address_info($location = null, $property = null)
    {
        if ($location === null) {
            return global_info('addresses');
        }
        
        if ($property === null) {
            return global_info("addresses.{$location}");
        }
        
        return global_info("addresses.{$location}.{$property}");
    }
}
