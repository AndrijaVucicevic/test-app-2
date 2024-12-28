<?php

namespace App\Filters;


use App\Interfaces\SearchFilterInterface;

class OrdersSearchFilter implements SearchFilterInterface
{
    public string $filterSearch;
    public string $mainKey;

    public function __construct()
    {
        $this->loadParameters();
    }

    public function loadParameters(): void
    {
        $this->filterSearch = request('filter_search', '');
        $this->mainKey = request('mainKey', '');
    }
}
