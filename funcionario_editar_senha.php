<?php
include_once("include/factory.php");
if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit();
}
if(!isset($_GET['id'])){
    header("location: funcionario_listagem.php?0");
    exit();
}
if($_GET["id"] == "" || $_GET["id"] == NULL){
    header("location: funcionario_listagem.php?2");
    exit();
}
$funcionario = FuncionarioRepository::get($_GET["id"]);
if(!$funcionario){
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
    <title>EDITAR FUNCIONARIO</title>
</head>
<style>
    #titAndButton {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>

<body>
    <?php include("include/navbar.php");?>
    <div class="container">

        <h1>EDITAR SENHA FUNCIONARIO</h1>
        <a type="button" class="btn btn-warning" href="funcionario_listagem.php">VOLTAR</a>
        <div class="row mt-4">
            <div class="col-md-12">
                <form action="funcionario_editar_senha_post.php" method="POST">
                    <div class="mb-3">

                        <label for="senha" class="form-label" id="senha">Digite a nova senha</label>
                        <input type="text" name="senha" class="form-control" id="senha" placeholder="nova senha">

                        <label for="repSenha" class="form-label" id="repSenha">Confirmar senha</label>
                        <input type="text" name="repSenha" class="form-control" id="repSenha" placeholder="confirmar senha">

                    
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
</html>