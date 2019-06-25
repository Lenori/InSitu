<?php

session_start();

$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$url = 'http://'.$_SERVER['HTTP_HOST'].'/admin/login.php?url='. $url;

if ($_SESSION['login'] == '' OR !$_SESSION['login'])
    print ("<script language='JavaScript'>self.location.href=\"$url\";</script>");