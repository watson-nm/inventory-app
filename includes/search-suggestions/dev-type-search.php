<?php
require_once('../../db.php');

function get_dev($conn, $term){
    $query = "SELECT DISTINCT dev_type FROM devices WHERE dev_type LIKE '%".$term."%' ORDER BY dev_type ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

if (isset($_GET['term'])) {
    $getDev = get_dev($conn, $_GET['term']);
    $devList = array();
    foreach($getDev as $dev){
        $devList[] = $dev['dev_type'];
    }
    echo json_encode($devList);
}
?>
