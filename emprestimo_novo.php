</html>
<?php
include_once("include/factory.php");


$emprestimo = Factory::emprestimo();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>NOVO EMPRESTIMO</title>
</head>

<body>

    <header>
        <?php include("include/navbar.php"); ?>
    </header>
    <div class="container">
        <h1>Empréstimo > Novo</h1>
        <br>
        <a href="emprestimo_listagem.php" class="btn btn-info">Voltar</a>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <form action="emprestimo_novo_post.php" method="POST">
                            <div class="mb-3">
                                <label for="livro_id" class="form-label">Livro:</label>
                        <select name="livro_id" id="livro_id" class="form-select form-select-lg mb-3" aria-label="Large select example" required>
                            <?php
                            foreach (LivroRepository::listAllWithoutEmprestimoActive() as $livro) {
                             
                            ?>
                                <option value="<?php echo $livro->getId(); ?>">
                                    <?php echo $livro->getTitulo() ?>
                                </option>
                            <?php } ?>
                        </select>

                        <br>
                        
                        

                        <label for="cliente" class="form-label">Cliente:</label>
                        <select name="cliente" id="cliente" class="form-select form-select-lg mb-3" aria-label="Large select example" required>
                            <?php
                            foreach (ClienteRepository::listAllWithoutEmprestimoActive() as $cliente) {
                                
                            ?>
                                <option value="<?php echo $cliente->getId(); ?>">
                                    <?php echo $cliente->getNome() ?>
                                </option>
                            <?php } ?>
                        </select>

                                <label for="data_vencimento" class="form-label" id="data_vencimento">Data de Vencimento</label>
                                <input type="text" name="data_vencimento" class="form-control" id="data_vencimento" value="<?php echo $emprestimo->getDataVencimento("d/m/Y") ?>" readonly>






                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="js/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#data_vencimento").mask("00/00/0000")
            
        });
    </script>
</body>

</html>