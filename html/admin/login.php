<?php

include('../includes/header.php');

session_start();

if (isset($_POST['cmd']) && $_POST['cmd'] == 'fazer-login') {

    $sql = "SELECT * FROM users";
    $rst = mysqli_query($conn, $sql);

    $login = array();

    while ($rstDB = mysqli_fetch_assoc($rst))
        $login[] = $rstDB;

    $form = array(

        'login' => $_POST['login'],
        'password' => md5($_POST['password'])

    );

    if ($form['login'] == $login[0]['login']) {

        if ($form['password'] == $login[0]['password']) {

            $url = 'http://'.$_SERVER['HTTP_HOST'].'/admin';

            $_SESSION['login'] = $form['login'];
            print ("<script language='JavaScript'>self.location.href=\"$url\";</script>");

        }

    }

    echo '<script>alert("Login e/ou senha incorretos.")</script>';

}

?>

<div class="login-form">

    <form method="post">

        <input type="hidden" name="cmd" value="fazer-login" />

        <input type="text" name="login" id="login" value="admin" required placeholder="Login" />
        <input type="password" name="password" id="password" required placeholder="Senha" />

        <button class="review-button">Enviar</button>

    </form>

</div>
