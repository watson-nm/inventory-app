<?php
require_once('../../db.php');

function get_make($conn, $term){
    $query = "SELECT DISTINCT make FROM devices WHERE make LIKE '%".$term."%' ORDER BY make ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

if (isset($_GET['term'])) {
    $getMake = get_make($conn, $_GET['term']);
    $makeList = array();
    foreach($getMake as $make){
        $makeList[] = $make['make'];
    }
    echo json_encode($makeList);
}
?>
