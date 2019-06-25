<?php

include('db_conn.php');

$sql = "SELECT * FROM clinicas";
$rst = mysqli_query($conn, $sql);
$clinicas = array();

while ($rstDB = mysqli_fetch_assoc($rst))
    $clinicas[] = $rstDB;

$OAuthAPI = array(

    'google' => '1071118269009-241kht97h70f804tvl9pm01jmdu5h5o0.apps.googleusercontent.com',
    'facebook' => '442747476274204'

)

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de Review</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/mobile-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="<?php echo $OAuthAPI['google'] ?>">

</head>

<body>

<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>