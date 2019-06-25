<?php

$conn = mysqli_connect(

    "35.198.63.166",
    "root",
    "SkbiU4xn3bPx#p&iesJ*22b4",
    "insituDB"

);

if (mysqli_connect_errno())
    echo "Falha na conex&atilde;o ao banco de dados: " . mysqli_connect_error();

mysqli_set_charset($conn, "utf8");
date_default_timezone_set("America/Sao_Paulo");

?>