<?php
require_once('../../db.php');

function get_location($conn, $term){
    $query = "SELECT DISTINCT location FROM devices WHERE location LIKE '%".$term."%' ORDER BY location ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

if (isset($_GET['term'])) {
    $getLocation = get_location($conn, $_GET['term']);
    $makeList = array();
    foreach($getLocation as $location){
        $locationList[] = $location['location'];
    }
    echo json_encode($locationList);
}
?>
