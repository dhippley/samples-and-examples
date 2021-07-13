<?php

class Catalog
{
    private $search_term;
    private $catalog_path;

    public function __construct($search_term, $catalog_path)
    {
        $this->search_term = $search_term;
        $this->catalog_path = $catalog_path;
    }

    public function searchAll()
    {
        $dir = new RecursiveDirectoryIterator($this->catalog_path, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($dir);
        $results = array();

        foreach($files as $file) {
            $file_path = $file->getPath()."/".$file->getFileName();
    
            $file_contains_term = function ($search_term) use ($file_path) {
                return str_contains(file_get_contents($file_path, 1), $search_term);
            };
    
            if($file_contains_term($this->search_term)) {
                $results[] = $file->getFileName();
            }
         }

         return $results;
    }

}