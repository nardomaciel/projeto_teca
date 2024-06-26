<?php
include_once("include/factory.php");
if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit();
}
if(!isset($_GET['id'])){
    header("location: funcionario_listagem.php");
    exit();
}
if($_GET["id"] == '' || $_GET["id"] == NULL){
    header("location: funcionario_listagem.php");
    exit();
}
$funcionario = FuncionarioRepository::get($_GET["id"]);
if(!$funcionario){
    header("location: funcionario_listagem.php");
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
    <?php include("include/navbar.php"); ?>
    <div class="container">

        <h1>EDITAR FUNCIONARIO</h1>
        <a type="button" class="btn btn-warning" href="funcionario_listagem.php">VOLTAR</a>
        <div class="row mt-4">
            <div class="col-md-12">
                <form action="funcionario_editar_post.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control"  value="<?php echo $funcionario->getNome()?>" placeholder="nome funcionario" required maxlength="200">

                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control"  value="<?php echo $funcionario->getTelefone()?>" placeholder="(00) 00000-0000" required>
                        
                        <label for="cpf" class="form-label">Cpf</label>
                        <input type="text" name="cpf" id="cpf" class="form-control"  value="<?php echo $funcionario->getCpf()?>" placeholder="000.000.000-00" required>

                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"  value="<?php echo $funcionario->getEmail()?>" placeholder="name@email.com" required maxlength="200">
                        
                        <div class="mb-3">
                            <a href="funcionario_editar_senha.php?id=<?php echo($funcionario->getId());?>" class="btn btn-warning">editar senha</a>
                        </div>
                       
                    
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?php echo $funcionario->getId()?>">
                        <button type="submit" class="btn btn-info">EDITAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script>
       $(document).ready(function() {
            $('#cpf').mask('000.000.000-00', {reverse: true});
            $('#telefone').mask('(00) 00000-0000');
        });
    </script>
</body>
</html>