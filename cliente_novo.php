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
                        <input type="text" name="nome" id="nome" class="form-control"  placeholder="nome"required  maxlength="200">

                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(99) 99999-9999" required>

                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="name@email.com" required  maxlength="200"> 

                        <label for="cpf" class="form-label">Cpf</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="000.000.000-00" >

                        <label for="rg" class="form-label">Rg</label>
                        <input type="text" name="rg" id="rg" class="form-control" placeholder="00.000.000-0">

                        <label for="data_nascimento" class="form-label">Data de nascimento</label>
                        <input type="text" name="data_nascimento" id="data_nascimento" class="form-control data_nascimento" placeholder="dd/mm/aaaa" required>
                        
                    </div>
                    <div class="mb-3">
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
            $('.data_nascimento').mask('00/00/0000');
            $('#cpf').mask('000.000.000-00', {reverse: true});
            $('#rg').mask('00.000.000-0', {reverse: true});
            $('#telefone').mask('(00) 00000-0000');
        });
    </script>
</body>

</html>