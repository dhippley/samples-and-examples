<?php
include "./CommandPattern/Command.php";
include "./CommandPattern/Catalog.php";
include "./CommandPattern/Invoker.php";
include "./CommandPattern/SearchCommand.php";

$opts = getopt("t:p::");

$search_term = setSearchTerm($opts);
$catalog_path = setCatalogPath($opts);

if(!$catalog_path || !$search_term) exit;
$catalog = new Catalog($search_term, $catalog_path);
$invoker = new Invoker(new SearchCommand($catalog));
$output = $invoker->run();

foreach($output as $k => $v) {
    echo $v;
    echo PHP_EOL;
}

exit;

function setSearchTerm($opts) {
    return $opts["t"];
}

function setCatalogPath($opts) {

    if(!isset($opts["p"]) || $opts["p"] === '') {
        $path = getcwd().'/catalog';
    } else {
        $path = $opts["p"];
    }

    $has_catalog = function() use ($path) {
        return implode(end(explode("/", $path))) === 'catalog'; 
    };

    if(is_dir($path) && $has_catalog) {
        return $path;
    } else {
        echo "Unabled to Located Catalog From Path...";
        echo PHP_EOL;
        return false;
    }
}