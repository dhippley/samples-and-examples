<?php declare(strict_types=1);

class SearchCommand implements Command
{
    public function __construct(private Catalog $results)
    {

    }

    public function execute()
    {
        return $this->results->searchAll();
    }
}