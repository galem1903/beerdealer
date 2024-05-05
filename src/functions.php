<?php
// Define functions here
function displayBrewery($brewery, $breweries) {
    // Return the brewery name
    return $brewery['name'];
}

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

function getBeers($beers) {
    // Return an array of beers
    return $beers;
}
?>