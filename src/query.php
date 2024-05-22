<?php
$sql = "SELECT beers.name, COUNT(user_beer.liked) as likes
        FROM beers 
        JOIN user_beer ON beers.beer_id = user_beer.beer_id 
        WHERE user_beer.liked = 1 
        GROUP BY beers.name
        ORDER BY likes DESC";

$conn = mysqli_connect("localhost", "ee67ed30eled", "r5|e5e?0ed", "rbleaebler20");
$result = mysqli_query($conn, $sql);

$beers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $beers[] = $row;
}

mysqli_close($conn);
?>