<?php

namespace App\Presenters;

use App\Models\Bookmark;
use App\Services\MetadataExtractorService;

class BookmarkPresenter
{

    public function __construct(protected Bookmark $bookmark, protected MetadataExtractorService $extractor) {}

    public function initialsURLName()
    {
        $domain = $this->extractor->getDomainToURL($this->bookmark->url);

        $domainArray = explode('.', $domain);
        $initialsArray = array_map(fn($word) => ucfirst($word[0]), $domainArray);
        $initials = array_slice($initialsArray, 0, 3);

        return implode("", $initials);
    }
}
