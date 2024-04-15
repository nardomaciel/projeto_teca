<?php
include_once("include/factory.php");
if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit();
}
if(!isset($_GET['id'])){
    header("location: cliente_listagem.php?1");
    exit();
}
if($_GET["id"] == "" || $_GET["id"] == NULL){
    header("location: cliente_listagem.php?2");
    exit();
}
$cliente = ClienteRepository::get($_GET["id"]);
if(!$cliente){
    header("location: cliente_listagem.php?3");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>EDITAR CLIENTE</title>
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

        <h3>EDITAR < CLIENTE</h3>
        <a type="button" class="btn btn-warning" href="cliente_listagem.php">VOLTAR</a>
        <a type="button" class="btn btn-warning" href="cliente_novo.php">NOVO</a>
        <div class="row mt-4">
            <div class="col-md-12">
                <form action="cliente_editar_post.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" name="id" value="<?php echo $cliente->getNome()?>"placeholder="digite o nome do cliente" required>

                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" name="id" value="<?php echo $cliente->getTelefone()?>" placeholder="(00) 00000-0000">

                        <label for="nome" class="form-label">Email</label>
                        <input type="text" name="email" id="nome" class="form-control" name="id" value="<?php echo $cliente->getEmail()?>" placeholder="name@email.com">

                        <label for="cpf" class="form-label">Cpf</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" name="id" value="<?php echo $cliente->getCpf()?>" placeholder="000.000.000-00">
                        
                        <label for="rg" class="form-label">Rg</label>
                        <input type="text" name="rg" id="rg" class="form-control" name="id" value="<?php echo $cliente->getRg()?>" placeholder="00.000.000-0" required>

                        <label for="data_nascimento" class="form-label">Data de nascimento</label>
                        <input type="text" name="data_nascimento" id="data_nascimento" class="form-control data_nascimento" value="<?php echo $cliente->getDataNascimento()?>" placeholder="dd/mm/aaaa">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?php echo $cliente->getId()?>">
                        <button type="submit" class="btn btn-info">ENVIAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src = "https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src = "js/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
        $('.data_nascimento').mask('00/00/0000');
        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#rg').mask('00.000.000-0', {reverse: true});
        $('#telefone').mask('(00) 00000-0000');
        });
        
    </script>
</body>
</html>