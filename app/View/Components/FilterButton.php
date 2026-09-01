<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterButton extends Component
{
    public bool $isActive;
    public string $url;

    /**
     * Create a new component instance.
     */
    public function __construct(string $param, mixed $value)
    {

        $this->isActive = request($param) == $value;

        $this->url = $this->isActive
            ? request()->fullUrlWithQuery([$param => null])
            : request()->fullUrlWithQuery([$param => $value]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter-button');
    }
}
