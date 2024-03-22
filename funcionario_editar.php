<?php
include_once("include/factory.php");
if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit();
}
if(!isset($_GET['id'])){
    header("location: funcionario_listagem.php?1");
    exit();
}
if($_GET["id"] == "" || $_GET["id"] == NULL){
    header("location: funcionario_listagem.php?2");
    exit();
}
$autor = FuncionarioRepository::get($_GET["id"]);
if(!$autor){
    header("location: funcionario_listagem.php?3");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>NOVO FUNCIONARIO</title>
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

        <h1>EDITAR FUNCIONARIO</h1>
        <a type="button" class="btn btn-warning" href="funcionario_listagem.php">VOLTAR</a>
        <a type="button" class="btn btn-warning" href="funcionario_novo.php">NOVO</a>
        <div class="row mt-4">
            <div class="col-md-12">
                <form action="funcionario_editar_post.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" name="id" value="<?php echo $funcionario->getNome()?>">
                        <label for="nome" class="form-label">Cpf</label>
                        <input type="text" name="cpf" id="nome" class="form-control" name="id" value="<?php echo $funcionario->getCpf()?>">
                        <label for="nome" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="nome" class="form-control" name="id" value="<?php echo $funcionario->getTelefone()?>">
                        <label for="nome" class="form-label">Senha</label>
                        <input type="passuord" name="senha" id="nome" class="form-control" name="id" value="<?php echo $funcionario->getTelefone()?>">
                        <label for="nome" class="form-label">Email</label>
                        <input type="text" name="email" id="nome" class="form-control" name="id" value="<?php echo $funcionario->getEmail()?>">
                        
                       
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?php echo $funcionario->getId()?>">
                        <button type="submit" class="btn btn-info">ENVIAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</cliente