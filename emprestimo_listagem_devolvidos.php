<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EPRESTIMO LISTAGEM DEVOLVIDOS</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
</head>

<body>
  <?php include("include/navbar.php") ?>
  <main>
    <div class="container">
        <h2>Emprestimo > devolvidos</h2>
        <a href="emprestimo_listagem.php" class="btn btn-warning">VOLTAR</a>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Livro</th>
              <th>Cliente</th>
              <th>Vencimento</th>
              <th>Devolução</th>
            </tr>
          </thead>
          <tbody>
              <?php
              foreach(EmprestimoRepository::listaDevolvido() as $emprestimo){
              ?>
              <tr>
                <td><?php echo $emprestimo->getId(); ?></td>
                <td><?php 
                        $livro = LivroRepository::get($emprestimo->getLivroId());
                        echo $emprestimo->getLivroId()." - ". $livro->getTitulo(); 
                    ?>
                </td>
                <td>
                    <?php 
                        $cliente = ClienteRepository::get($emprestimo->getClienteId());
                        echo $emprestimo->getClienteId()." - ". $cliente->getNome(); 
                    ?>
                </td>
                <td><?php echo $emprestimo->dtDataVencimento("d/m/Y"); ?></td>
                <td><?php echo $emprestimo->getDataDevolucao("d/m/Y"); ?></td>
                

              </tr>
              <?php
                }
              ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
  
</body>

</html>