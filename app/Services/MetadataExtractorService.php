<?php

namespace App\Services;

use AshAllenDesign\FaviconFetcher\Facades\Favicon;
use Illuminate\Support\Uri;

class MetadataExtractorService
{

    public function getFaviconToURL(string $url): ?string
    {
        try {
            $favicon = Favicon::fetch($url);
            return $favicon ? $favicon->getFaviconUrl() : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getDomainToURL(string $url): string
    {
        $domain = Uri::of($url)->host();

        if (str_contains($domain, 'www.')) {
            $domain = str_replace('www.', '', $domain);
        }
        $domain_without_tld = substr($domain, 0, strrpos($domain, '.'));

        return $domain_without_tld;
    }
}
