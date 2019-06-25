<?php

include('../includes/login_handler.php');
include('../includes/header.php');

$id = $_GET['id'];

$sql = "SELECT * FROM clinicas WHERE id = $id";
$rst = mysqli_query($conn, $sql);

$clinicas = array();

while ($rstDB = mysqli_fetch_assoc($rst))
    $clinicas[] = $rstDB;

if (isset($_POST['cmd']) && $_POST['cmd'] == 'editar-clinica') {

    $mudarLogo = '';

    if (file_exists($_FILES['logo']['tmp_name'])) {

        $tmpname = $_FILES['logo']['tmp_name'];
        $logo = $_FILES['logo']['name'];
        $dir = '../logos/';

        move_uploaded_file($tmpname, $dir . $logo);

        $mudarLogo = ", logo = '". $logo ."'";

    }

    $form = array(

        'nome' => $_POST['nome'],
        'google' => $_POST['google'],
        'facebook' => $_POST['facebook'],

    );

    $sql = "UPDATE clinicas SET
                nome = '". $form['nome'] ."',
                google = '". $form['google'] ."',
                facebook = '". $form['facebook'] ."'
                $mudarLogo
            WHERE id = $id";

    $rst = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    echo '<script>alert("entrada atualizada")</script>';

    $url = 'http://'.$_SERVER['HTTP_HOST'].'/admin';
    print ("<script language='JavaScript'>self.location.href=\"$url\";</script>");

}

?>

<div class="container">

    <div class="row">

        <div class="admin-edit-clinica">

            <h1>Editar clínica <?php echo $clinicas[0]['nome'] ?></h1>

            <form class="edit-clinica" method="post" enctype="multipart/form-data">

                <input type="hidden" name="cmd" value="editar-clinica" />

                <label for="nome">Nome</label>
                <input required type="text" name="nome" id="nome" placeholder="Nome" value="<?php echo $clinicas[0]['nome'] ?>" />

                <label for="google">Google ID</label>
                <input required type="text" name="google" id="google" placeholder="Google ID" value="<?php echo $clinicas[0]['google'] ?>" />

                <label for="facebook">Facebook Slug</label>
                <input required type="text" name="facebook" id="facebook" placeholder="Facebook Slug" value="<?php echo $clinicas[0]['facebook'] ?>" />

                <label for="logo">Logo</label>
                <input type="file" name="logo" accept="image/*">

                <button>Enviar</button>

            </form>

        </div>

    </div>

</div>
