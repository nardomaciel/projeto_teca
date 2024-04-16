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
  <title>FUNCIONARIO LISTAGEM</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    #titAndButton {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
  </style>
</head>

<body>
  <?php include("include/navbar.php"); ?>

  <div class="container ">
    <div id="titAndButton">
      <h2>FUNCIONARIO < LISTAGEM</h2>
          <a href="funcionario_novo.php" class="btn btn-success">NOVO FUNCIONARIO</a>
          <a href="index.php" class="btn btn-warning">VOLTAR</a>
    </div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Cpf</th>
            <th>Telefone</th>

            <th>Email</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach (FuncionarioRepository::listAll() as $funcionario) {
            $user = Auth::getUser();
          ?>
            <tr>
              <td><?php echo $funcionario->getID(); ?></td>
              <td><?php echo $funcionario->getNome(); ?></td>
              <td><?php echo $funcionario->getTelefone(); ?></td>
              <td><?php echo $funcionario->getCpf(); ?></td>
              <td><?php echo $funcionario->getEmail(); ?></td>

              <div class="row mt-2">
                <div id="titAndButton">
                  <td>
                    <div class="mb-3">
                      <a href="funcionario_editar.php?id=<?php echo $funcionario->getId(); ?>" type="button" class="btn btn-primary">EDITAR</a>
                    </div>
                    <?php if (
                      EmprestimoRepository::countByInclusaoFuncionario($funcionario->getId()) == 0 && EmprestimoRepository::countByAlteracaoFuncionario($funcionario->getId()) == 0 &&
                      EmprestimoRepository::countByDevolucaoFuncionario($funcionario->getId()) == 0 &&
                      EmprestimoRepository::countByRenovacaoFuncionario($funcionario->getId()) == 0 &&
                      ClienteRepository::countByInclusaoFuncionario($funcionario->getId()) ==
                      0 &&
                      ClienteRepository::countByAlteracaoFuncionario($funcionario->getId()) == 0 &&
                      AutorRepository::countByInclusaoFuncionario($funcionario->getId()) ==
                      0 &&
                      AutorRepository::countByAlteracaoFuncionario($funcionario->getId()) ==
                      0 &&
                      LivroRepository::countByInclusaoFuncionario($funcionario->getId()) ==
                      0 &&
                      LivroRepository::countByAlteracaoFuncionario($funcionario->getId()) == 0
                    ) { ?>

                      <div class="mb-3">
                        <a href="funcionario_excluir.php?id=<?php echo $funcionario->getId(); ?>" type="button" class="btn btn-danger">DELETAR</a>

                      </div>
                  </td>
                </div>
            </tr>
          <?php
                    }
          ?>
        <?php
          }
        ?>





        </tbody>
      </table>

    </div>
  </div>
</body>

</html>