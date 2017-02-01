<?php
include_once('database/connection.php');
include_once('database/restaurant.php');

function cmp($a, $b)
{
    if ($a['distance'] == $b['distance']) {
        return 0;
    }
    return ($a['distance'] < $b['distance']) ? -1 : 1;
}

$names = getAllRestaurantsName($db);

$search_string = $_POST['search_string'];

foreach($names as &$name){
    $name['distance'] = levenshtein($search_string, $name['name']);
}

usort($names, "cmp");

header('Content-Type: application/json');
echo json_encode($names);

?>