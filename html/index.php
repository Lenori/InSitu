<?php

include('./includes/header.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM clinicas WHERE id = '$id'";
    $rst = mysqli_query($conn, $sql);
    $clinica = array();

    while ($rstDB = mysqli_fetch_assoc($rst))
        $clinica[] = $rstDB;

}

$colors = array(

    'body-bg' => '#0e668e',
    'button-text' => '#FFFFFF',
    'button-bg' => '#043b54',
    'close-button-text' => '#FFFFFF',
    'close-button-bg' => '#c73628',
    'h1-text' => '#FFFFFF'

);

$links = array(

    'google' => $clinica[0]['google'],
    'facebook' => $clinica[0]['facebook']

);

if (isset($_POST['cmd']) && $_POST['cmd'] == 'enviar-review') {

    $form = array(

        'nome' => $_POST['nome'],
        'estrelas' => $_POST['estrelas'],
        'msg' => $_POST['mensagem']

    );

    $sql = "INSERT INTO reviews (
             
             nome,
             estrelas,
             mensagem,
             clinica
             
            ) values (
                
            '". $form['nome'] ."',          
            '". $form['estrelas'] ."',          
            '". $form['msg'] ."',          
            '". $id ."'          

            )";

    $rst = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    echo '<script>alert("Avaliação enviada com sucesso!")</script>';

}

?>

<div class="container">

    <div class="row">

        <?php if (isset($_GET['id'])) : ?>

            <style type="text/css">

                body {
                    background-color: <?php echo $colors['body-bg'] ?>;
                }

                .review-header h1 {
                    color: <?php echo $colors['h1-text'] ?>;
                }

                .review-button {
                    color: <?php echo $colors['button-text'] ?>;
                    background-color: <?php echo $colors['button-bg'] ?>;
                }

                .review-close {
                    color: <?php echo $colors['close-button-text'] ?> !important;
                    background-color: <?php echo $colors['close-button-bg'] ?> !important;
                }

                ::placeholder {
                    color: <?php echo $colors['button-text'] ?>;
                    opacity: 1;
                }

                :-ms-input-placeholder {
                    color: <?php echo $colors['button-text'] ?>;
                }

                ::-ms-input-placeholder {
                    color: <?php echo $colors['button-text'] ?>;
                }

                .review-form input, .review-form textarea {
                    background-color: <?php echo $colors['button-bg'] ?>;
                    color: <?php echo $colors['button-text'] ?>;
                }

                .form-voltar {
                    color: <?php echo $colors['button-text'] ?>;
                }

            </style>

            <div class="review-header">

                <img src="/logos/<?php echo $clinica[0]['logo'] ?>" alt="review-logo" />

                <h1>Faça uma avaliação da nossa clínica!</h1>

            </div>

            <div class="review-links">

                <p data-url="https://search.google.com/local/writereview?placeid=<?php echo $links['google'] ?>" class="open-iframe review-button">

                    Login com Google

                </p>

                <p data-url="https://www.facebook.com/login/?next=https%3A%2F%2Fwww.facebook.com%2F<?php echo $links['facebook'] ?>%2Freviews%2F" class="open-iframe review-button">

                    Login com Facebook

                </p>

                <p class="open-form review-button">

                    Criar uma conta

                </p>

            </div>

            <div class="review-close">

                <p id="close-iframe" class="review-close review-button">

                    Fechar

                </p>

            </div>

            <div class="review-form">

                <form method="post">

                    <input type="hidden" name="cmd" value="enviar-review" />

                    <input type="text" name="nome" id="nome" required placeholder="Nome" />
                    <input type="hidden" name="estrelas" id="estrelas" value="1" />

                    <div class="review-stars">

                        <span data-star="1" class="review-star star-unclicked fas fa-star"></span>
                        <span data-star="2" class="review-star star-unclicked fas fa-star"></span>
                        <span data-star="3" class="review-star star-unclicked fas fa-star"></span>
                        <span data-star="4" class="review-star star-unclicked fas fa-star"></span>
                        <span data-star="5" class="review-star star-unclicked fas fa-star"></span>

                    </div>

                    <textarea style="height: 300px" name="mensagem" id="mensagem" required placeholder="Mensagem"></textarea>

                    <button class="review-button">Enviar</button>

                    <p class="form-voltar">Voltar</p>

                </form>

            </div>

        <?php else : ?>

        Escolha uma clínica para continuar:

        <br />
        <br />

        <?php foreach ($clinicas as $clinica) : ?>

            <a href="?id=<?php echo $clinica['id'] ?>"><?php echo $clinica['nome'] ?></a> <br />

        <?php endforeach; ?>

        <?php endif; ?>

    </div>

</div>

<?php

include('./includes/footer.php');

?>
