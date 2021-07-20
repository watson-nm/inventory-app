<?php
require_once('../../db.php');

function get_section($conn, $term){
    $query = "SELECT DISTINCT section FROM assignees WHERE section LIKE '%".$term."%' ORDER BY section ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

if (isset($_GET['term'])) {
    $getSection = get_section($conn, $_GET['term']);
    $sectionList = array();
    foreach($getSection as $section){
        $sectionList[] = $section['section'];
    }
    echo json_encode($sectionList);
}
?>
