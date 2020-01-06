<?php
include('../db/config.php');

if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = mysqli_query($conn,"SELECT itr_no, firstname, lastname FROM `itr` WHERE `itr_no` LIKE '%{$query}%' OR `firstname` LIKE '%{$query}%' OR `lastname` LIKE '%{$query}%'");
	$array = array();
    while ($row = mysqli_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['lastname'].', '.$row['itr_no'],
            'value' => $row['itr_no'].' - '.$row['firstname'].' '.$row['lastname'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}

if (isset($_REQUEST['itemquery'])) {
    $query = $_REQUEST['itemquery'];
    $sql = mysqli_query($conn,"SELECT item_id, name, type FROM `item` WHERE `item_id` LIKE '%{$query}%' OR `name` LIKE '%{$query}%' OR `type` LIKE '%{$query}%'");
    $array = array();
    while ($row = mysqli_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['name'].', '.$row['item_id'],
            'value' => $row['name'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}

?>