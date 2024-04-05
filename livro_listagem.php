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
  <title>LIVRO LISTAGEM</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

</head>
<style>
  #titAndButton {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
</style>

<body>
  <?php include("include/navbar.php") ?>
  <main>
    <div class="container">
      <div id="titAndButton">
        <h2>LIVRO < LISTAGEM </h2>
        <a href="livro_novo.php" class="btn btn-success">NOVO LIVRO</a>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Titulo</th>
              <th>Ano</th>
              <th>Genero</th>
              <th>id autor </th>
              <th>ISBN</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach (LivroRepository::listAll() as $livro) {
            ?>
              <tr>
                <td><?php echo $livro->getId(); ?></td>
                <td><?php echo $livro->getTitulo(); ?></td>
                <td><?php echo $livro->getAno(); ?></td>
                <td><?php echo $livro->getGenero(); ?></td>
                <td><?php echo $livro->getAutorId(); ?></td>
                <td><?php echo $livro->getIsbn(); ?></td>
                <div id="titAndButton">
                  <td>
                    <a href="livro_editar.php?id=<?php echo $livro->getId(); ?>" type="button" class="btn btn-primary">EDITAR</a>
                    <?php if(EmprestimoRepository::countByLivros($livro->getId())== 0){?>
                    <a href="livro_excluir.php?id=<?php echo $livro->getId();?>" type="button" class="btn btn-danger">DELETAR</a>
                    <?php } ?>
                  </td>
                </div>
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