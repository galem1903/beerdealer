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

function getMostLikedBeers($beers) {
    // Trier les bières en fonction du nombre de likes
    usort($beers, function($a, $b) {
        return $b['likes'] - $a['likes'];
    });

    // Renvoyer les 10 bières les plus populaires
    return array_slice($beers, 0, 10);
}
?>