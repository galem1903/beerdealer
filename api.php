<!DOCTYPE html>
<html>
<head>
    <title>Beer Search</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    if (isset($_POST['search'])) {
        $search = urlencode($_POST['search']);
        
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, 'https://beer-searching.glitch.me/search?vc=HEPL&q='. $search);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'beer-searching');
        
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        
        $data = json_decode($response, true);
        $beers = $data['data']['results']['items'];
        
        if (count($beers) > 0) {
            foreach ($beers as $beer) {
                $beer = $beer['beer'];
                echo "<h2>". $beer['name']. "</h2>";
                echo "<p>ID: ". $beer['id']. "</p>";
                echo "<p>Brewery: ". $beer['brewer']['name']. "</p>";
                echo "<p>Type: ". $beer['style']['name']. "</p>";
                echo "<p>Percentage: ". $beer['abv']. "</p>";
                echo "<p>Rating: ". $beer['averageQuickRating']. "</p>";
                echo "<img src='". $beer['imageUrl']. "' alt='". $beer['name']. "' />";
                    echo "<form action=\"/favorite_beers.php\" method=\"post\">";
                         echo "<input type=\"hidden\" name=\"user_id\" value=\"<?php echo $user_id;?>\">";
                         echo "<input type=\"hidden\" name=\"beer_id\" value=\"<?php echo $beer_id;?>\">";
                         echo "<button type=\"submit\">Ajouter à mes favoris</button>";
                    echo "</form>";
            }
        } else {
            echo "<p>No results found</p>";
        }
    }
   ?>
</body>
</html>