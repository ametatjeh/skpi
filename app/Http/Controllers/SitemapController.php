<?php
/**
 * Sitemap Generator Controller
 * Generates dynamic XML sitemap for SEO
 */

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $content = '<?xml version="1.0" encoding="UTF-8"?>';
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Homepage
        $content .= $this->addUrl(url('/'), now()->toDateString(), 'daily', '1.0');
        
        // Login pages (public) - with try-catch for safety
        try {
            if (\Route::has('mahasiswa.login')) {
                $content .= $this->addUrl(route('mahasiswa.login'), now()->toDateString(), 'monthly', '0.8');
            }
        } catch (\Exception $e) {}
        
        // Certificate verification (public)
        $content .= $this->addUrl(url('/verify'), now()->toDateString(), 'weekly', '0.9');
        
        // Login hub
        $content .= $this->addUrl(url('/login'), now()->toDateString(), 'monthly', '0.7');
        
        $content .= '</urlset>';
        
        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
    
    private function addUrl($loc, $lastmod, $changefreq, $priority)
    {
        return sprintf(
            '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%s</priority></url>',
            htmlspecialchars($loc),
            $lastmod,
            $changefreq,
            $priority
        );
    }
}
