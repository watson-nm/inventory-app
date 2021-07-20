<?php
require_once('../../db.php');

function get_model($conn, $term){
    $query = "SELECT DISTINCT model FROM devices WHERE model LIKE '%".$term."%' ORDER BY model ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

if (isset($_GET['term'])) {
    $getModel = get_model($conn, $_GET['term']);
    $modelList = array();
    foreach($getModel as $model){
        $modelList[] = $model['model'];
    }
    echo json_encode($modelList);
}
?>
