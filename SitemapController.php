<?php

namespace App\Http\Controllers;

use App\Models\Post;

class SitemapController extends Controller
{
    public function index()
    {
        public function generate()
        {
            
            $xml = '';
            $xml .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd"
            xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
            $staticUrls = [
                '/',
                '/about-us',
                '/contact-us',
                '/benefits-for-employees',
                '/benefits-for-employers',
                '/privacy-policy',
            ];
    
            foreach ($staticUrls as $url) {
                $xml .= '<url>' . "\n";
                $xml .= '<loc>' . url($url) . '</loc>' . "\n";
                $xml .= '<changefreq>daily</changefreq>' . "\n";
                $xml .= '<priority>1.0</priority>' . "\n";
                $xml .= '</url>' . "\n";
            }
    
            $jobs = Job::all();
            foreach ($jobs as $job) {
                $xml .= '<url>' . "\n";
                $xml .= '<loc>' . route('get.jobs', $job) . '</loc>' . "\n";
                $xml .= '<lastmod>' . $job->updated_at->toIso8601String() . '</lastmod>' . "\n";
                $xml .= '<changefreq>weekly</changefreq>' . "\n";
                $xml .= '<priority>0.7</priority>' . "\n";
                $xml .= '</url>' . "\n";
            }
    
            $xml .= '</urlset>';
    
            return response($xml)->header('Content-Type', 'text/xml');
        }
    }
}
