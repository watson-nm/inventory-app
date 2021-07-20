<?php
require_once('../../db.php');

function get_name($conn, $term){
    $query = "SELECT * FROM assignees WHERE name LIKE '%".$term."%' ORDER BY name ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

if (isset($_GET['term'])) {
    $getName = get_name($conn, $_GET['term']);
    $nameList = array();
    foreach($getName as $name){
        $nameList[] = $name['name'];
    }
    echo json_encode($nameList);
}
?>
