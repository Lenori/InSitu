<?php

include('../includes/db_conn.php');
include('api_errors.php');

if (!isset($_GET['id']))
    echo $api_errors['no_id'];

else {

    $id = $_GET['id'];

    $sql = "SELECT * FROM reviews WHERE clinica = $id";
    $rst = $rst = mysqli_query($conn, $sql) or die(mysqli_error());

    $reviews = array();

    while ($rstDB = mysqli_fetch_assoc($rst))
        $reviews[] = $rstDB;

    header('Content-Type: application/json');

    echo json_encode($reviews, JSON_PRETTY_PRINT);

}