<?php
include_once("include/factory.php");

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}
if(!isset($_GET['id'])){
    header("location: emprestimo_listagem.php");
    exit();
}
if($_GET["id"] == "" || $_GET["id"] == null){
    header("location: emprestimo_listagem.php");
    exit();
}
$emprestimo = EmprestimoRepository::get($_GET["id"]);
if(!$emprestimo){
    header("location: emprestimo_listagem.php");
    exit();
}


$emprestimo_novo = Factory::emprestimo();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <title>RENOVAR EMPRESTIMO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>

<body>

    <header>
        <?php include("include/navbar.php"); ?>
    </header>
    <div class="container">
        <h1>Empréstimo > Renovar</h1>
        <br>
        <div id="botaonovo">
            <a href="emprestimo_listagem.php" class="btn btn-info">Voltar</a>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">

                <form action="emprestimo_renovar_post.php" method="POST">
                    <div class="mb-3">
                        
                    <label for="livro_id" class="form-label">Livro:</label>
                    <br>
                    <input type="text" name="livro_id" class="form-control" id="livro_id" value="<?php $livro = LivroRepository::get($emprestimo->getLivroId());
                    echo $emprestimo->getLivroId() . " - " . $livro->getTitulo(); ?>" disabled>

                    <br>
                    <label for="cliente" class="form-label">Cliente:</label>
                    <br>
                    <input type="text" name="cliente_id" class="form-control" id="cliente_id" value="<?php $cliente = ClienteRepository::get($emprestimo->getClienteId());
                                echo $emprestimo->getClienteId() . " - " . $cliente->getNome(); ?>" disabled>
                    <br>
                    <label for="nome" class="form-label" >Data de Vencimento</label>
                    <input type="text" name="data_vencimento" class="form-control" id="data_vencimento" value="<?php echo $emprestimo_novo->getDataVencimento("d/m/Y"); ?>" readonly>


                    </div>

                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?php echo $emprestimo->getId(); ?>">
                        <button type="submit" class="btn btn-success">Renovar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    

    <script src="js/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#data_renovacao").mask("00/00/0000")
        });
    </script>
</body>

</html>