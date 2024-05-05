<?php
function searchBeers($searchTerm, $beers) {
    // Search for beers that match the search term
    $results = array();
    foreach ($beers as $beer) {
        if (strpos(strtolower($beer['name']), strtolower($searchTerm))!== false) {
            $results[] = $beer;
        }
    }
    return $results;
}
?>