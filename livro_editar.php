<?php
include_once("include/factory.php");
if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit();
}
if(!isset($_GET['id'])){
    header("location: livro_listagem.php?1");
    exit();
}
if($_GET["id"] == "" || $_GET["id"] == NULL){
    header("location: livro_listagem.php?2");
    exit();
}
$livro = LivroRepository::get($_GET["id"]);
if(!$livro){
    header("location: livro_listagem.php?3");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>NOVO LIVRE</title>
</head>
<style>
    #titAndButton {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>

<body>
    <?php include("include/navbar.php"); ?>
    <div class="container">

        <h1>EDITAR LIVRO</h1>
        <a type="button" class="btn btn-warning" href="livro_listagem.php">VOLTAR</a>
        <a type="button" class="btn btn-warning" href="livro_novo.php">NOVO</a>
        <div class="row mt-4">
            <div class="col-md-12">
                <form action="livro_editar_post.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Titulo</label>
                        <input type="text" name="titulo" class="form-control" name="id" value="<?php echo $livro->getTitulo()?>">
                        <label for="nome" class="form-label">Ano de lançamento</label>
                        <input type="text" name="nome" id="nome" class="form-control" name="id" value="<?php echo $livro->getAno()?>">
                        <label for="nome" class="form-label">Genero</label>
                        <input type="text" name="nome" id="nome" class="form-control" name="id" value="<?php echo $livro->getGenero()?>">
                        <label for="nome" class="form-label">Isbn</label>
                        <input type="text" name="nome" id="nome" class="form-control" name="id" value="<?php echo $livro->getIsbn()?>">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?php echo $livro->getId()?>">
                        <button type="submit" class="btn btn-info">ENVIAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</livro