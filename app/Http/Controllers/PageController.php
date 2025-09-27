<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function ourStory()
    {
        $breadcrumbData = [
            'title' => __('header.our_story'),
            'bgColor' => '#EFF1F5',
            'breadcrumbs' => [
                [
                    'name' => __('header.home'),
                    'url' => route('home')
                ],
                [
                    'name' => __('header.our_story'),
                    'url' => null
                ]
            ]
        ];

        return view('pages.our-story', compact('breadcrumbData'));
    }

    public function privacyPolicy()
    {
        $breadcrumbData = [
            'title' => __('header.privacy_policy'),
            'bgColor' => '#EFF1F5',
            'breadcrumbs' => [
                [
                    'name' => __('header.home'),
                    'url' => route('home')
                ],
                [
                    'name' => __('header.privacy_policy'),
                    'url' => null
                ]
            ]
        ];

        return view('pages.privacy-policy', compact('breadcrumbData'));
    }

    public function termsConditions()
    {
        $breadcrumbData = [
            'title' => __('header.terms_conditions'),
            'bgColor' => '#EFF1F5',
            'breadcrumbs' => [
                [
                    'name' => __('header.home'),
                    'url' => route('home')
                ],
                [
                    'name' => __('header.terms_conditions'),
                    'url' => null
                ]
            ]
        ];

        return view('pages.terms-conditions', compact('breadcrumbData'));
    }
}
