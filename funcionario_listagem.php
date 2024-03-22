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
  <title>NOVO FUNCIONARIO</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    #titAndButton{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
  </style>
</head>
<body>
    <?php include("include/navbar.php"); ?>

  <div class="container">
    <div id="titAndButton">
        <h2>FUNCIONARIOS</h2>
        <a href="funcionario_novo.php" class="btn btn-success">NOVO FUNCIONARIO</a>
    </div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Cpf</th>
            <th>Telefone</th>
            <th>senha</th>
            <th>Email</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php 
                foreach(FuncionarioRepository::listAll() as $funcionario){
            ?>
              <tr>
                    <td><?php echo $funcionario->getID(); ?></td>
                    <td><?php echo $funcionario->getNome(); ?></td>
                    <td><?php echo $funcionario->getTelefone(); ?></td>
                    <td><?php echo $funcionario->getCpf(); ?></td> 
                    <td><?php echo $funcionario->getSenha(); ?></td> 
                    <td><?php echo $funcionario->getEmail(); ?></td>
                   
                    <br>
                <div>
                    <td>
                    <button type="button" class="btn btn-primary">EDITAR</button>
                    <button type="button" class="btn btn-danger">DELETAR</button>
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
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->
</body>
</html>