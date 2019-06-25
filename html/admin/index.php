<?php

include('../includes/login_handler.php');
include('../includes/header.php');

$sql = "SELECT * FROM clinicas";
$rst = mysqli_query($conn, $sql);

$clinicas = array();

    while ($rstDB = mysqli_fetch_assoc($rst))
        $clinicas[] = $rstDB;

if (isset($_GET['excluir']) && isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM clinicas WHERE id = $id";
    $rst = mysqli_query($conn, $sql) or die (mysqli_error($conn));

    echo '<script>alert("entrada excluída")</script>';

    $url = 'http://'.$_SERVER['HTTP_HOST'].'/admin';
    print ("<script language='JavaScript'>self.location.href=\"$url\";</script>");

}

?>

<div class="container">

    <div class="row">

        <div class="admin-list-clinicas">

            <h1>Clínicas</h1>

            <table class="table table-striped">

                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>

                <tbody>

                    <?php foreach ($clinicas as $clinica) : ?>

                        <tr>
                            <th scope="row"><?php echo $clinica['id'] ?></th>
                            <td><?php echo $clinica['nome'] ?></td>

                            <td>
                                <a onclick="if(!confirm('Deseja realmente excluir esta clínica?')) { return false }" href="?excluir=true&id=<?php echo $clinica['id'] ?>"><span class="fas fa-trash-alt"></span></a>
                                <a href="edit_clinica.php?id=<?php echo $clinica['id'] ?>"><span class="fas fa-edit"></span></a>
                                <a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>?id=<?php echo $clinica['id'] ?>"><span class="fas fa-link"></span></a>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <a href="criar_clinica.php"><button>Criar clínica</button></a>

    </div>

</div>
