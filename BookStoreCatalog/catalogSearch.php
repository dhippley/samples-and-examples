<?php

$catalog_path = setCatalogPath($path='');
$search_term = handleArgs($argv);

if(!$catalog_path) return false;
if(!$search_term) return false;

start($search_term, $catalog_path);

function start($term, $catalog_path) {

    $dir = new RecursiveDirectoryIterator($catalog_path, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($dir);

    foreach($files as $file) {
        $file_path = $file->getPath()."/".$file->getFileName();

        $file_contains_term = function ($term) use ($file_path) {
            return str_contains(file_get_contents($file_path, 1), $term);
        };

        if($file_contains_term($term)) {
            echo $file->getFileName();
            echo PHP_EOL;
        }
     }

     return true;
}

function handleArgs($args) {
    if(sizeof($args) > 2 || sizeof($args) < 1) {
        echo "Too Many or Not Enough Arguments Supplied...";
        echo PHP_EOL;
        return false;
    }

    return $args[1];
}

function setCatalogPath($path) {

    $has_catalog = function() use ($path) {
        return implode(end(explode("/", $path))) === 'catalog'; 
    };

    if(!isset($path) || $path === '') {
        $path = getcwd().'/catalog';
    }

    if(is_dir($path) && $has_catalog) {
        return $path;
    } else {
        echo "Unabled to Located Catalog From Path...";
        echo PHP_EOL;
        return false;
    }
}
