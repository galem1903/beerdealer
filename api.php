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
        $beers = [
            0 => [
                'beer' => [
                    'name' => 'Jupiler',
                    "id" => '8042',
                    'brewer' => [
                        'name' => 'Brasserie Piedboeuf (AB InBev)'
                    ],
                    'style' => [
                        'name' => 'Pale Lager - International / Premium'
                    ],
                    'abv' => 5.199999809265137,
                    'averageQuickRating' => 2.5937307928703133,
                    'imageUrl' => 'https://res.cloudinary.com/ratebeer/image/upload/w_400,c_limit,d_Default_Beer_qqrv7k.png,f_auto/beer_8042'
                ]
            ]
        ];
        $beers = $data['data']['results']['items'];

        /*
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
                         echo "<input type=\"hidden\" name=\"user_id\" value=\"<?php echo 0;?>\">";
                         echo "<input type=\"hidden\" name=\"beer_id\" value=\"<?php echo 0;?>\">";
                         echo "<button type=\"submit\">Ajouter à mes favoris</button>";
                    echo "</form>";
            }
        } else {
            echo "";
        }
        */

        $test = 'dfd';

        if (isset($_POST['add_to_favorite'])) {
            require_once(__DIR__ . '/src/add_to_favorites.php');
        }
    }

    ?>

    <?php  ?>
    <main>
        <?= $test ?>
        <?php if (count($beers) > 0): ?>
            <form class="search-form" action="api.php" method="post" onsubmit="showLoader()"> <!-- Lien vers api.php -->
                <input type="text" name="search" placeholder="Rechercher une bière...">
                <input type="submit" value="Rechercher">
            </form>
            <section class="beer-list">
                <h2>Résulat pour la recherche: <?= $search ?></h2>
                <div class="items">
                    <?php foreach ($beers as $key => $beer): ?>
                        <article>
                            <form action="api.php" method="post" class="title">
                                <h3><?= $beer['beer']['name'] ?></h3>
                                <input type="hidden" name="search" value="<?= $search ?>">
                                <input type="hidden" name="add_to_favorite" value="<?= $key ?>">
                                <input type="submit" value="Like" class="like">
                            </form>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php else: ?>
            <p>No results found</p>
        <?php endif; ?>
    </main>
    <?php require_once(__DIR__ . '/src/partials/footer.php'); ?>
</body>
</html>