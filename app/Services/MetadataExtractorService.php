<?php

namespace App\Services;

use AshAllenDesign\FaviconFetcher\Facades\Favicon;

class MetadataExtractorService
{

    public function getFaviconToURL(string $url): string | null
    {
        $favicon = Favicon::fetch($url);
        return !empty($favicon) ? $favicon->getFaviconUrl() : $favicon;
    }

    public function getTitleToURL(string $url) {}
}
