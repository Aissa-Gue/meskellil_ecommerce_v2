<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('email-description', 'Email from ' . config('app.name'))">
    <title>@yield('email-title', config('app.name'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #1b1b18;
            line-height: 1.6;
        }
        .email-wrapper {
            background-color: #f8f9fa;
            padding: 40px 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #BD844C;
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        .email-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #1b1b18 0%, #666 50%, #1b1b18 100%);
        }
        .email-logo {
            margin-bottom: 20px;
        }
        .email-logo img {
            max-width: 120px;
            height: auto;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .email-header p {
            margin: 10px 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .email-body {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #fff;
            font-weight: 500;
        }
        .message {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 25px;
            color: #555;
        }
        .primary-button {
            display: inline-block;
            background-color: #BD844C;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            margin: 20px 0;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .primary-button:hover {
            background-color: #2c2c28;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(27, 27, 24, 0.3);
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .alternative-link {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            border-left: 4px solid #1b1b18;
        }
        .alternative-link p {
            margin: 0 0 10px;
            font-size: 14px;
            color: #666;
        }
        .alternative-link a {
            color: #fff;
            font-size: 14px;
            word-break: break-all;
            font-weight: 500;
        }
        .footer {
            background-color: #BD844C;
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #1b1b18 0%, #666 50%, #1b1b18 100%);
        }
        .footer-logo {
            margin-bottom: 20px;
        }
        .footer-logo img {
            max-width: 100px;
            height: auto;
        }
        .footer-info {
            margin-bottom: 20px;
        }
        .footer-contact {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .footer-contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }
        .footer-contact-item svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }
        .footer-social {
            margin-bottom: 20px;
        }
        .footer-social a {
            display: inline-block;
            margin: 0 10px;
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: opacity 0.3s ease;
        }
        .footer-social a:hover {
            opacity: 0.7;
        }
        .footer p {
            margin: 0;
            font-size: 14px;
            opacity: 0.8;
            line-height: 1.5;
        }
        .footer .company-name {
            font-weight: 600;
            opacity: 1;
        }
        .footer-copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 20px;
            margin-top: 20px;
        }
        .notice-box {
            padding: 18px;
            border-radius: 8px;
            margin: 25px 0;
            font-size: 14px;
            border: 1px solid;
        }
        .notice-warning {
            background-color: #fff2f2;
            border-color: #f8d7da;
            color: #721c24;
        }
        .notice-info {
            background-color: #f0f9ff;
            border-color: #bfdbfe;
            color: #1e40af;
        }
        .notice-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }
        
        /* Responsive Design */
        @media only screen and (max-width: 600px) {
            .email-wrapper {
                padding: 20px 10px;
            }
            .email-container {
                border-radius: 8px;
            }
            .email-header,
            .email-body,
            .footer {
                padding: 25px 20px;
            }
            .footer-contact {
                flex-direction: column;
                gap: 15px;
            }
            .primary-button {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
        }
        
        /* Additional utility classes */
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .mb-20 { margin-bottom: 20px; }
        .mb-30 { margin-bottom: 30px; }
        .mt-20 { margin-top: 20px; }
        .mt-30 { margin-top: 30px; }
    </style>
    
    @yield('email-styles')
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <div class="email-logo">
                    <img src="{{ global_info('brand.logo.svg') }}" alt="{{ brand_info('name') ?: config('app.name') }} Logo">
                </div>
                <h1>{{ brand_info('name') ?: config('app.name') }}</h1>
                <p>@yield('email-header-subtitle', 'Email Notification')</p>
            </div>

            <!-- Body -->
            <div class="email-body">
                @yield('email-content')
            </div>

            <!-- Footer -->
            <div class="footer">
                <div class="footer-logo">
                    <img src="{{ global_info('brand.logo.png') }}" alt="{{ global_info('brand.name') ?: config('app.name') }} Logo">
                </div>
                
                <div class="footer-info">
                    <p><span class="company-name">{{ global_info('brand.name') }}</span></p>
                    <p>{{ global_info('brand.slug') }}</p>
                </div>

                <div class="footer-contact">
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 5C1 2.2 2.6 1 5 1H13C15.4 1 17 2.2 17 5V10.6C17 13.4 15.4 14.6 13 14.6H5" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M13 5.40039L10.496 7.40039C9.672 8.05639 8.32 8.05639 7.496 7.40039L5 5.40039" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                        <span>{{ global_info('contact.email') }}</span>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4h16v12H4z" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M4 8l8 4 8-4" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                        <span>{{ global_info('contact.phone_primary') }}</span>
                    </div>
                </div>

                <div class="footer-social">
                    <a href="#" target="_blank" title="Facebook"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" target="_blank" title="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" target="_blank" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                </div>
                
                <div class="footer-copyright">
                    <p>© {{ date('Y') }} {{ global_info('brand.name') }}. All rights reserved.</p>
                    <p>{{ global_info('addresses.main') }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
