<?php
include_once("include/factory.php");
if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>NOVO CLIENTE</title>
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

        <h1>Novo cliente</h1>
        <a href="cliente_listagem.php" class="btn btn-warning">VOLTAR</a>
        <div class="row mt-4">
            <div class="col-md-12">
                <form action="cliente_novo_post.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" >
                        <label for="nome" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="nome" class="form-control" >
                        <label for="nome" class="form-label">Email</label>
                        <input type="text" name="email" id="nome" class="form-control" >
                        <label for="nome" class="form-label">Cpf</label>
                        <input type="text" name="cpf" id="nome" class="form-control" >
                        <label for="nome" class="form-label">Rg</label>
                        <input type="text" name="rg" id="nome" class="form-control" >
                        <label for="nome" class="form-label">Data de nascimento</label>
                        <input type="date" name="data_nascimento" id="nome" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info">ENVIAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>