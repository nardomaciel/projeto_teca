<?php
include_once("include/factory.php");
if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit();
}
if (!isset($_GET['id'])) {
    header("location: livro_listagem.php");
    exit();
}
if ($_GET["id"] == "" || $_GET["id"] == NULL) {
    header("location: livro_listagem.php");
    exit();
}
$livro = LivroRepository::get($_GET["id"]);
if (!$livro) {
    header("location: livro_listagem.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>EDITAR LIVRO</title>
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
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" name="titulo" class="form-control"  value="<?php echo $livro->getTitulo() ?>" required maxlength="200">

                        <label for="ano" class="form-label">Ano de lançamento</label>
                        <input type="text" name="ano" id="ano" class="form-control"  value="<?php echo $livro->getAno() ?>" required maxlength="100">

                        <label for="genero" class="form-label">Genero</label>
                        <input type="text" name="genero" id="genero" class="form-control"  value="<?php echo $livro->getGenero() ?>" required maxlength="13"> 

                        <label for="autor" class="form-label">id autor</label>
                        <select name="autor_id" id="autor" class="form-select form-select-lg mb-3" aria-label="Large select example" required>
                            <?php $autor = AutorRepository::listAll() ?>
                            <?php
                            foreach (AutorRepository::listAll() as $autor) {
                            ?>
                                <option value="<?php echo $autor->getId(); ?>" <?php if ($livro->getAutorId() == $autor->getId()) {echo 'selected';} ?>>
                                    <?php echo $autor->getNome() ?>
                                </option>
                            <?php } ?>
                        </select>

                        <label for="isbn" class="form-label">Isbn</label>
                        <input type="text" name="isbn" id="isbn" class="form-control"  value="<?php echo $livro->getIsbn() ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?php echo $livro->getId() ?>">
                        <button type="submit" class="btn btn-info">ENVIAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script>
       $(document).ready(function() {
            $('#ano').mask('0000', {reverse: true});
        });
    </script>
</body>

</livro