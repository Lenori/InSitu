<?php

include('../includes/login_handler.php');
include('../includes/header.php');

$id = $_GET['id'];

if (isset($_POST['cmd']) && $_POST['cmd'] == 'criar-clinica') {

    if (file_exists($_FILES['logo']['tmp_name'])) {

        $tmpname = $_FILES['logo']['tmp_name'];
        $logo = $_FILES['logo']['name'];
        $dir = '../logos/';

        move_uploaded_file($tmpname, $dir . $logo);

    }

    $form = array(

        'nome' => $_POST['nome'],
        'google' => $_POST['google'],
        'facebook' => $_POST['facebook'],

    );

    $sql = "INSERT INTO clinicas (
             
             nome,
             google,
             facebook,
             logo
             
            ) values (
                
            '". $form['nome'] ."',          
            '". $form['google'] ."',          
            '". $form['facebook'] ."',          
            '". $logo ."'          

            )";

    $rst = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    echo '<script>alert("entrada criada")</script>';

    $url = 'http://'.$_SERVER['HTTP_HOST'].'/admin';
    print ("<script language='JavaScript'>self.location.href=\"$url\";</script>");

}

?>

<div class="container">

    <div class="row">

        <div class="admin-edit-clinica">

            <h1>Criar clínica</h1>

            <form class="edit-clinica" method="post" enctype="multipart/form-data">

                <input type="hidden" name="cmd" value="criar-clinica" />

                <label for="nome">Nome</label>
                <input required type="text" name="nome" id="nome" placeholder="Nome" />

                <label for="google">Google ID</label>
                <input required type="text" name="google" id="google" placeholder="Google ID" />

                <label for="facebook">Facebook Slug</label>
                <input required type="text" name="facebook" id="facebook" placeholder="Facebook Slug" />

                <label for="logo">Logo</label>
                <input required type="file" name="logo" accept="image/*">

                <button>Enviar</button>

            </form>

        </div>

    </div>

</div>
